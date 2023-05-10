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

    function getDebutCompta($id_societe){
        try {
            $connexion = dbconnect();
            $sql = "select date_debut_exercice from comptabilite where societe = :societe order by date_debut_exercice desc limit 1";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':societe', $id_societe);
            $stmt->execute();
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultat[0]["date_debut_exercice"];
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
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

    function findAllChargeSuppletif($id_societe){
        $connexion = dbConnect();
        $sql="SELECT * from charge_suppletif where societe = :societe";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':societe',$id_societe);
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

    function getSumVariableSuppletive($id_societe){
        $connexion = dbConnect();
        $debut = getDebutCompta($id_societe);
        $sql="SELECT sum(valeur*variable) as prix_variable from v_prix where date_ecriture > :date_debut_exercice AND societe = :societe";
        $stmt=$connexion->prepare($sql);
        $stmt->bindParam(':societe',$id_societe);
        $stmt->bindParam(':date_debut_exercice',$debut);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
?>