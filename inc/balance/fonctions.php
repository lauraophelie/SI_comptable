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

    /*function treatmentSolde($listes){
        //liste ['']
        $debit = 0;
        $credit = 0;
        foreach($listes as $liste){

        }
    }*/
?>