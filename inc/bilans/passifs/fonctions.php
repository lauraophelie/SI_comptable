<?php

    include("../../ecritures/fonctions.php");

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
    function get_sum_produits($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT SUM(debit) AS total_debit, SUM(credit) AS total_credit FROM ecriture_journal WHERE(compte_general LIKE '7%' AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }
    function get_sum_charges($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT SUM(debit) AS total_debit, SUM(credit) AS total_credit FROM ecriture_journal WHERE(compte_general LIKE '6%' AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function get_solde_capital($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT DISTINCT numero, designation as libelle, societe, SUM(debit) as total_debits, SUM(credit) as total_credits
                FROM v_balance
                WHERE (numero = '10100' AND societe = :societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)
                GROUP BY numero, libelle, societe
                ORDER BY numero";
        $stmt = $connexion ->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    function get_capital($societe_id, $date_exercice, $date_fin) {
        $societe_compta = find_societe_comptabilite($societe_id);
        $soldes = get_solde_capital($societe_compta, $date_exercice, $date_fin);
        
        $total_credits = $societe_compta['capital'] + $soldes['total_credits'];
        $total_debits = $soldes['total_debits'];
        
        $capital = 0;

        if($total_debits > $total_credits) {
            $capital = $total_debits - $total_credits;
        } else if($total_credits > $total_debits) {
            $capital = $total_credits - $total_debits;
        } else {
            $capital = 0;
        }
        return $capital;
    }
    
?>