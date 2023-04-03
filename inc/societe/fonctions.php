<?php
    require('../connexion.php');

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

    function update($id, $numero, $designation) {
        try {
            $connexion = db_connect();
            $sql = "UPDATE pcg2005 SET numero = :numero, designation = :designation WHERE id = :id";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':designation', $designation);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }

    
?>