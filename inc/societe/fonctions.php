<?php
    require('../connexion.php');

    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function find_all() {
        $connexion = db_connect();
        $sql = "SELECT * FROM societe ORDER BY id ASC";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function save($nom, $objet, $date_creation, $mdp) {
        try {
            $connexion = db_connect();
            $sql = "INSERT INTO societe (nom, objet, date_creation, mot_de_passe) VALUES (:nom, :objet, :date_creation,:mdp)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':objet', $objet);
            $stmt->bindParam(':date_creation', $date_creation);
            $stmt->bindParam(':mdp', $mdp);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }
    function addScanNRCS($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE identification_societe SET scan_nrcs = :filename WHERE societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }
    function addScanNS($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE identification_societe SET scan_ns = :filename WHERE societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }
    function addScanNIF($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE identification_societe SET scan_nif = :filename WHERE societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }
    function addLogo($filename,$societe) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE societe SET logo = :filename WHERE id = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }

    
?>