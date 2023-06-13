<?php
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

    function save_produit($designation) {
        try{
            $connexion = db__connect();
            $sql="INSERT INTO produit(designation) values (:designation)";
            $stmt = $connexion ->prepare($sql);
            $stmt->bindParam(':designation',$designation);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erreur lors de l'insertion :".$e->getMessage();
            return false;
        }
    }

    function verifProduit($designation){
        $connexion = db__connect();
        $sql="SELECT designation from produit where designation = :designation";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':designation',$designation);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return true; 
        } else {
            return false; 
        }
    }

    function findAll(){
        $connexion = db__connect();
        $sql="SELECT * from v_produits ORDER BY id ASC";
        $stmt=$connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function update_produit($id, $designation, $prix_unitaire, $unite_oeuvre){
        try{
            $connecion = db__connect();
            $sql = "UPDATE produit SET designation = :designation, prix_unitaire = :prix_unitaire, unite_oeuvre = :unite_oeuvre where id=:id";
            $stmt = $connecion->prepare($sql);
            $stmt->bindParam(':designation', $designation);
            $stmt->bindParam(':prix_unitaire', $prix_unitaire);
            $stmt->bindParam(':unite_oeuvre', $unite_oeuvre);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erreur lors de la modification :".$e->getMessage();
            return false;
        }
    }

    function delete_produit($id) {
        try{
            $connexion = db__connect();
            $sql = "DELETE from produit where id= :id";
            $stmt = $connexion -> prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e) {
            echo "Une erreur s'est produite lors de la suppression " .$e->getMessage();
            return false;
        }
    }

    function findProduitByNum($id) {
        $connexion = db__connect();
        $sql = "SELECT * from produit where id= :id";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

?>