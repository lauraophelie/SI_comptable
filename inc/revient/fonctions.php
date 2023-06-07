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

    function get_sum_charges($societe_id, $date_exercice, $date_fin) {
        $connexion = db_connect();
        $sql = "SELECT SUM(debit) AS total_debit, SUM(credit) AS total_credit FROM ecriture_journal WHERE(compte_general LIKE '6%' AND societe=:societe AND date_ecriture >= :date_exercice AND date_ecriture < :date_fin)";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function get_volume_production() {
        
    }
?>