<?php
    function dbconnect() {
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

    function getGrandLivre($compte,$debut,$societe){
        try {
            $connexion = dbconnect();
            $sql = "select * from ecriture_journal where compte_general = :compte and date_ecriture > :debut and societe = :societe";
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

    function findSociete($societe) {
        $connexion = dbconnect();
        $sql = "SELECT * FROM societe WHERE nom = :nom";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':nom', $societe);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getTotal($compte, $debut, $societe){
        try {
            $connexion = dbconnect();
            $sql = "select count(debit) as deb, count(credit) as cred from ecriture_journal where compte_general = :compte and date_ecriture > :debut and societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':compte', $compte);
            $stmt->bindParam(':debut', $debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result['debit'] = $resultat['deb'];
            $result['credit'] = $resultat['cred'];
            $result['total'] = $result['debit'] - $result['credits'];
            return $result;

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getDebutCompta($id_societe) {
        try {
            $connexion = dbconnect();
            $sql = "SELECT date_debut_exercice FROM comptabilite WHERE societe = :societe ORDER BY date_debut_exercice DESC LIMIT 1";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':societe', $id_societe);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $resultat['date_debut_exercice'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
?>