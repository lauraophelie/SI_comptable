<?php
    function dbconnect() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';
        try {
            $connexion = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
            return $connexion;
        }catch(Exception $e) {
            echo 'Erreur : '.$e-> getMessage().'<br />';
            echo 'N° : '.$e-> getCode();
        }
    }

    function getGrandLivre($compte,$debut,$societe){
        try {
            $connexion = dbconnect();
            $sql = "select * from ecriture_journal where compte_general like :compte and date_ecriture > :debut and societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':compte', $compte);
            $stmt->bindParam(':debut', $debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getTotal($compte, $debut, $societe){
        try {
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from ecriture_journal where compte_general like :compte and date_ecriture > :debut and societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':compte', $compte);
            $stmt->bindParam(':debut', $debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result['debit'] = $resultat[0]['deb'];
            $result['credit'] = $resultat[0]['cred'];
            $result['total'] = $result['debit']-$result['credit'];
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getDebutCompta($id_societe){
        try {
            $connexion = dbconnect();
            $sql = "select date_debut_exercice from comptabilite where societe = :societe order by date_debut_exercice desc limit 1";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':societe', $id_societe);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultat[0]["date_debut_exercice"];
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
?>