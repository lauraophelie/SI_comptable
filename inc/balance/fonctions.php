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
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultat[0]["date_debut_exercice"];
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

    function getSomme($debut, $societe){
        try {
            $connexion = dbconnect();
            $sql = "select sum(debit) as deb, sum(credit) as cred from v_balance where date_ecriture > :debut and societe = :societe";
            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':debut', $debut);
            $stmt->bindParam(':societe', $societe);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function treatmentSolde($listes){
        //liste [numero,desognation,deb,cred]
        $debit = 0;
        $credit = 0;
        $new_liste = array();
        $j = 0;
        for($i=0; $i>count($listes);$i++){
            $new_liste[$j]['numero']=$listes[$i]['numero'];
            if($listes[$i]['deb']>$listes[$i]['cred']){
                $new_liste[$j]['mvt']=$listes[$i];
                $new_liste[$j]['deb']=$listes[$i]['deb']-$listes[$i]['cred'];
                $new_liste[$j]['cred']=0;
                $debit += $new_liste[$j]['deb'];
            }
            if($listes[$i]['deb']<$listes[$i]['cred']){
                $new_liste[$j]=$listes[$i];
                $new_liste[$j]['deb']=0;
                $new_liste[$j]['cred']=$listes[$i]['cred']-$listes[$i]['deb'];
                $credit += $new_liste[$j]['cred'];
            }
            $j++;
        }
        $result['debit']=$debit;
        $result['credit']=$credit;
        $result['liste']=$new_liste;
        if($debit!=$credit){
            $result['solvable']=false;
        } else {
            $result['solvable']=true;
        }
        return $result;
    }
?>