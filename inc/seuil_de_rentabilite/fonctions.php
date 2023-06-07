<?php
    function db_connect() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';
            try {
                $connexion = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
                echo "success";
                return $connexion;
            }catch(Exception $e) {
                echo 'Erreur : '.$e-> getMessage().'<br />';
                echo 'N° : '.$e-> getCode();
            }
    }

    function getDebutCompta($id_societe){
        try {
            $connexion = db_connect();
            $sql = "select date_debut_exercice from comptabilite where societe = :societe order by date_debut_exercice desc limit 1";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':societe', $id_societe);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultat["date_debut_exercice"];
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getSum($societe, $id_produit){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = db_connect();
            $sql1 = "SELECT sum(valeur*fixe) as cout_fixe, sum(valeur*variable) as cout_variable from v_prix_suppletive
                        where date_ecriture < date_debut_exercice
                        AND societe = :societe
                        AND id_produit = :produit";
                        
            $sql2 = "SELECT sum(valeur*fixe) as cout_fixe, sum(valeur*variable) as cout_variable from v_prix
                        where date_ecriture < date_debut_exercice
                        AND societe = :societe
                        AND id_produit = :produit";

            $stmt1 = $connexion->prepare($sql1);
            $stmt1->bindParam(':societe', $societe);
            $stmt1->bindParam(':id_produit', $id_produit);
            $stmt1->bindParam(':debut_exercice', $date_debut);
            $stmt1->execute();
            $resultat1 = $stmt1->fetch(PDO::FETCH_ASSOC);

            $stmt2 = $connexion->prepare($sql2);
            $stmt2->bindParam(':societe', $societe);
            $stmt2->bindParam(':id_produit', $id_produit);
            $stmt2->bindParam(':debut_exercice', $date_debut);
            $stmt2->execute();
            $resultat2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            $resultat = array();
            $resultat['fixe'] = $resultat1['cout_fixe'] + $resultat2['cout_fixe'];
            $resultat['variable'] = $resultat1['cout_variable'] + $resultat2['cout_variable'];
            return $resultat;

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getAllChargeSuppl($societe, $idproduit){
        try {
            $connexion = db_connect();
            $sql = "SELECT nom_charge, valeur*fixe as cout_fixe, valeur*variable as cout_variable from v_prix_suppletive
                        where date_ecriture < date_debut_exercice
                        AND societe = :societe
                        AND id_produit = :produit";            
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':societe', $societe);
            $stmt->bindParam(':produit', $idproduit);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function findProduitByNum($id) {
        $connexion = db_connect();
        $sql = "SELECT * from produit where id= :id";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    function getSeuil($societe, $idproduit, $prix){
        $sum = getSum($societe, $idproduit);
        $produit = findProduitByNum($idproduit);
        $result =  $sum['fixe']/($prix-($sum['variavle']/$produit['nombre']));
        return $result;
    }
?>