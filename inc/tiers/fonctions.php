<?php
    function db_connect() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';

        try {
            $connexion = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
            return $connexion;
        } catch(Exception $e) {
            echo 'Erreur : '.$e-> getMessage().'<br />';
            echo 'N° : '.$e-> getCode();
        }   
    }
    
    function getTiers() {
        $connexion = db_connect();
        $sql = "SELECT num FROM compte_tiers";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function findByNumero($numero) {
        $connexion = db_connect();
        $sql = "SELECT * FROM tiers WHERE numero=:numero";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getNum($numero) {
        $connexion = db_connect();
        $sql = "SELECT numero FROM tiers WHERE numero = :numero";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['numero']){
            return true;
        } else {
            return false;
        }
    }

    function find_all() {
        $connexion = db_connect();
        $sql = "SELECT * FROM tiers ORDER BY numero ASC";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } 

    function findByNum($id){
        $connexion = db_connect();
        $sql = "SELECT * from tiers where id= :id";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    function save($type_tiers, $numero, $designation) {
        try {
            $connexion = db_connect();
            $sql = "INSERT INTO tiers(type_tiers, numero, designation) VALUES(:type_tiers, :numero, :designation)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':type_tiers', $type_tiers);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':designation', $designation);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }

    function update($numero, $designation, $id){
        try{
            $connexion = db_connect();
            $sql = "UPDATE tiers SET numero=:numero , designation = :designation where id= :id";
            $stmt = $connexion -> prepare($sql);
            $stmt->bindParam(':numero',$numero);
            $stmt->bindParam(':designation',$designation);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return true;
        }catch (PDOException $e) {
            echo "Une erreur s'est produite lors de la modification : " . $e->getMessage();
            return false;
        }
    }

    function delete($id) {
        try{
            $connexion = db_connect();
            $sql = "DELETE from tiers where id= :id";
            $stmt = $connexion -> prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e) {
            echo "Une erreur s'est produite lors de la suppression " .$e->getMessage();
            return false;
        }
    }

    function verifEcriture($numero) {
        $connexion = db_connect();
        $sql = "SELECT compte_tiers from ecriture_journal where compte_tiers= :numero";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->execute();
        
        $resultat = $stmt ->fetch(PDO::FETCH_ASSOC);
        if($resultat['compte_tiers']){
            return true;
        }else{
            return false;
        }
    }

    function findAllPagination($debut, $total) {
        $connexion = db_connect();
        $sql = "SELECT * FROM tiers ORDER BY numero ASC LIMIT :total OFFSET :debut";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':debut', $debut);
        $stmt->bindParam(':total', $total);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
?>