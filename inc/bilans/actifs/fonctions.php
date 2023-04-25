<?php
    function dbconnect() {
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
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultat["date_debut_exercice"];
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function getAllSolde($debut, $societe){
        try {
            $connexion = dbconnect();
            $sql = "select numero, designation, sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe group by numero, designation";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getTresor($societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like '5%'";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getClient($societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like '4%' and deb > cred";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getImmoInco($societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like '20%'";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getImmoCo($societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like '21%'";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getImmoBio($societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like '22%'";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getImmoEnCours($societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like '23%'";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getImmoFin($societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like '25%'";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function getInfo($compte, $societe){
        try {
            $date_debut = getDebutCompta($societe);
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe and numero like :numero%";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $date_debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->bindParam(':numero', $compte);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result!=null){
                return $result;
            }
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

?>