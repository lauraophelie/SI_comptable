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
    function get_sum_produits() {
        $connexion = dbconnect();
        $sql = "select sum(debit) as total_debit, sum(credit) as total_credit from v_balance where numero LIKE '7%'";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function get_sum_charges() {
        $connexion = dbconnect();
        $sql = "select sum(debit) as total_debit, sum(credit) as total_credit from v_balance where numero LIKE '6%'";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
?>