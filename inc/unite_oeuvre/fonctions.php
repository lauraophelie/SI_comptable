<?php

/// connexion à la base de données
    function db__connect() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';
    
            try {
                $connexion = new PDO('pgsql:host='.$PARAM_hote.'.;port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
                return $connexion;
            }
            catch(Exception $e) {
                echo 'Erreur : '.$e-> getMessage().'<br />';
                echo 'N° : '.$e-> getCode();
            }
    }

    function find_all_uo() {
        $connexion = db__connect();
        $sql = "SELECT * FROM unite_oeuvre ORDER BY id ASC";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function find_uo_by_id($id) {
        $connexion = db__connect();
        $sql = "SELECT * FROM unite_oeuvre WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function insert_uo($designation) {
        try {
            $connexion = db__connect();
            $sql = "INSERT INTO unite_oeuvre(designation) VALUES(:designation)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':designation', $designation);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }

    function delete_uo($id) {
        try {
            $connexion = db__connect();
            $sql = "DELETE FROM unite_oeuvre WHERE id = :id";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return false;
        }
    }

    function update_uo($id, $designation) {
        try {
            $connexion = db__connect();
            $sql = "UPDATE unite_oeuvre SET designation = :designation WHERE id = :id";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':designation', $designation);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la modification : " . $e->getMessage();
            return false;
        }
    }
?>