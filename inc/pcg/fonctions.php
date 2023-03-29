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

// plan comptable général

    function find_all() {
        $connexion = db_connect();
        $sql = "SELECT * FROM pcg2005 ORDER BY numero ASC";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function save($numero, $designation) {
        try {
            $connexion = db_connect();
            $sql = "INSERT INTO pcg2005 (numero, designation) VALUES (:numero, :designation)";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':designation', $designation);
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

    function delete($numero) {
        try {
            $connexion = db_connect();
            $sql = "DELETE FROM pcg2005 WHERE numero = :numero";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':numero', $numero);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error : ". $e->getMesssage();
            return false;
        }
    }

    function find_by_compte($compte) {
        $connexion = db_connect();
        $sql = "SELECT * FROM pcg2005 WHERE numero=:compte";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':compte', $compte);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }   
    
    function get_all_types() {
        
        $type[0]['type'] = 'csv';
        $type[0]['libelle'] = 'CSV';

        $type[1]['type'] = 'xlsx';
        $type[1]['libelle'] = 'Excel (XLSX)';

        $type[2]['type'] = 'xls';
        $type[2]['libelle'] = 'Excel (XLS)';

        $type[3]['type'] = 'ods';
        $type[3]['libelle'] = 'Open Document (ODS)';

        return $type;
    }

?>