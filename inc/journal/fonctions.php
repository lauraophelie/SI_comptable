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
// code journal

    function find_all() {
        $connexion = db_connect();
        $sql = "SELECT * FROM code_journal";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function save($id, $designation) {
        $connexion = db_connect();
        $sql = "INSERT INTO code_journal(id, designation) VALUES (:id, :designation)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $numero);
        $stmt->bindParam(':designation', $designation);
        $stmt->execute();
    }

    function update($id, $code, $designation) {
        $connexion = db_connect();
        $sql = "UPDATE pcg2005 SET id = :code, designation = :designation WHERE id = :id";
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function delete($id) {
        $connexion = db_connect();
        $sql = "DELETE FROM code_journal WHERE id = :id";
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function find_by_code($id) {
        $connexion = db_connect();
        $sql = "SELECT * FROM code_journal WHERE id=:id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    

?>