<?php
    require("../connexion.php");

    function getGrandLivre($compte,$debut,$societe){
        try {
            $connexion = dbconnect();
            $sql = "select * from ecriture where compte_general = :compte and date_ecriture > :debut and societe = :societe";
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
            $sql = "select count(debit) as deb, count(credit) as cred from ecriture where compte_general = :compte and date_ecriture > :debut and societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':compte', $compte);
            $stmt->bindParam(':debut', $debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result['debit'] = $resultat['deb'];
            $result['credit'] = $resultat['cred'];
            $result['total'] = $result['debit']-$result['credits'];
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getDebutCompta($societe){
        
    }
?>