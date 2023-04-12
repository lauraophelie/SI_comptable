<?php
    function db_connect() {
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

/// devises : table -> devise 

    function find_all() {
        $connexion = db_connect();
        $sql = "SELECT  * FROM devise";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function insert_new_devise($devise) {
        try {
            $connexion = db_connect();
            $sql = "INSERT INTO devise(devise) VALUES(:devise)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':devise', $devise);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }

/// taux devise : vue -> v_taux_devise; table -> taux_devise

    function find_all_taux() {
        $connexion = db_connect();
        $sql = "SELECT * FROM v_taux_devise ORDER BY date_taux";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function find_recent_taux($devise) {
        $connexion = db_connect();
        $sql = "SELECT * FROM v_taux_devise WHERE devise=:devise ORDER BY date_taux DESC LIMIT 1";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':devise', $devise);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function find_all_recent_taux() {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT ON (devise) * FROM v_taux_devise ORDER BY devise, date_taux DESC";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }    

    function find_by_devise($devise, $date_taux) {
        $connexion = db_connect();
        $sql = "SELECT * FROM v_taux_devise WHERE devise=:devise AND date_taux=:date_taux";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':devise', $devise);
        $stmt->bindParam(':date_taux', $date_taux);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function insert_taux($devise, $taux, $date_taux) {
        try {
            $connexion = db_connect();
            $sql = "INSERT INTO taux_devise(devise, taux, date_taux) VALUES(:devise, :taux, :date_taux)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':devise', $devise);
            $stmt->bindParam(':taux', $taux);
            $stmt->bindParam(':date_taux', $date_taux);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }

?>