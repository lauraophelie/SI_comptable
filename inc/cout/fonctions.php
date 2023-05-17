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

    function findAll(){
        $connexion = db_connect();
        $sql="SELECT * from ecriture_journal where compte_general like '6%' and compte_general not like '68%'";
        $stmt=$connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function findAll_unite(){
        $connexion = db_connect();
        $sql="SELECT distinct(unite) from unite";
        $stmt=$connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function find_unite_compte_6($libelle){
        $connexion = db_connect();
        $sql="SELECT unite from unite_compte_6 where libelle=:libelle";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':libelle',$libelle);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function save_unite_compte_6($libelle,$unite){
        try{
            $connexion = db_connect();
            $sql="INSERT INTO unite_compte_6 values (:libelle,:unite)";
            $stmt = $connexion ->prepare($sql);
            $stmt->bindParam(':libelle',$libelle);
            $stmt->bindParam(':unite',$unite);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erreur lors de l'insertion :".$e->getMessage();
            return false;
        }
    }

    function get_all_centre(){
        $connexion = db_connect();
        $sql="SELECT * from centre";
        $stmt=$connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_pourcentage_variable_compte6($compte) {
        $connexion = db_connect();
        $sql="SELECT variable from pourcentage_compte_6 where id_compte_6 = :compte6";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':compte6', $compte);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['variable'];
    }

    function get_pourcentage_fixe_compte6($compte){
        $connexion = db_connect();
        $sql="SELECT fixe from pourcentage_compte_6 where id_compte_6 = :compte6";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':compte6', $compte);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['fixe'];
    }

    function get_id_centre($centre) {
        $connexion = db_connect();
        $sql = "SELECT id from centre where designation=:centre";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':centre', $centre);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    function get_pourcentage_centre($compte,$id_centre) {
        $connexion = db_connect();
        $sql ="SELECT pourcentage from compte_6_centre where id_compte_6=:compte AND id_centre=:centre";
        // echo $sql;
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':compte',$compte);
        $stmt->bindParam(':centre',$id_centre);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pourcentage'];
    }
?>