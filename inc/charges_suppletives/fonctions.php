<?php
    function dbConnect() {
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

    function saveChargeSuppletif($idSociete,$designation) {
        try{
            $connexion = dbConnect();
            $sql="INSERT INTO charge_suppletif(societe, designation) VALUES(:id, :designation) ";
            $stmt = $connexion ->prepare($sql);
            $stmt->bindParam(':id',$idSociete);
            $stmt->bindParam(':designation',$designation);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erreur lors de l'insertion :".$e->getMessage();
            return false;
        }
    }

    function findAllChargeSuppletif(){
        $connexion = dbConnect();
        $sql="SELECT * from charge_suppletif";
        $stmt=$connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function updateChargeSuppletif($id,$designation){
        try{
            $connecion = db_connect();
            $sql = "UPDATE charge_suppletif SET designation = :designation where id=:id";
            $stmt = $connecion->prepare($sql);
            $stmt->bindParam(':designation',$designation);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erreur lors de la modification :".$e->getMessage();
            return false;
        }
    }

    function delete($id) {
        try{
            $connexion = db_connect();
            $sql = "DELETE from charge_suppletif where id= :id";
            $stmt = $connexion -> prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e) {
            echo "Une erreur s'est produite lors de la suppression " .$e->getMessage();
            return false;
        }
    }

    function findByNum($id) {
        $connexion = db_connect();
        $sql = "SELECT * from charge_suppletif where id= :id";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    function getDetailChargeSuppletif($id){
        $connexion = dbConnect();
        $sql="SELECT * from charge_suppletif join ecriture_charge_suppletive on charge_suppletive.id = id_charge_suppletive join details_ecriture_charge_suppletive on id_ecriture = ecriture_charge_suppletive.id where id = :id";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getSumVariableSuppletive(){
        
    }
?>