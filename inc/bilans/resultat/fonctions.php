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

    //get soldes

    function get_solde($societe_id,$date_exercice,$date_fin,$num1) {
        $connexion = db_connect();
        $sql = "SELECT*from solde 
        WHERE (numero LIKE :num AND societe= :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->bindParam(':num',$num);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function get_sum_solde($societe_id,$date_exercice,$date_fin,$num) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit),sum(total_credit) from solde 
        WHERE (numero LIKE :num AND societe= :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->bindParam(':num',$num);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function get2_sum_solde($societe_id,$date_exercice,$date_fin,$num,$num2){
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit),sum(total_credit) from solde 
        WHERE (numero LIKE :num OR :num2 AND societe= :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->bindParam(':num',$num);
        $stmt->bindParam(':num2',$num2);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    function soldes_resultat($societe_id,$date_exercice,$date_fin,$num){
        $resultat = get_sum_solde($societe_id,$date_exercice,$date_fin,$num);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];

        if($debit > $credit) return $debit - $credit;
        else if($credit < $debit) return $credit - $debit;
        else return 0;
    }

    function soldes2_resultat($societe_id,$date_exercice,$date_fin,$num,$num2){
        $resultat = get2_sum_solde($societe_id,$date_exercice,$date_fin,$num,$num2);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];

        if($debit > $credit) return $debit - $credit;
        else if($credit < $debit) return $credit - $debit;
        else return 0;
    }
?>