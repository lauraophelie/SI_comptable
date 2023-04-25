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

    function compte70($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '70%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde70($societe_id,$date_exercice,$date_fin){
        $resultat = compte70($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte71($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '71%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde71($societe_id,$date_exercice,$date_fin){
        $resultat = compte71($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte60($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '60%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde60($societe_id,$date_exercice,$date_fin){
        $resultat = compte60($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte61_62($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '61%' or numero like '62%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde61_62($societe_id,$date_exercice,$date_fin){
        $resultat = compte61_62($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte64($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '64%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde64($societe_id,$date_exercice,$date_fin){
        $resultat = compte64($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte63($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '63%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde63($societe_id,$date_exercice,$date_fin){
        $resultat = compte63($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte75($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '75%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde75($societe_id,$date_exercice,$date_fin){
        $resultat = compte75($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte65($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '65%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde65($societe_id,$date_exercice,$date_fin){
        $resultat = compte65($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte68($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '68%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde68($societe_id,$date_exercice,$date_fin){
        $resultat = compte68($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte78($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '78%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde78($societe_id,$date_exercice,$date_fin){
        $resultat = compte78($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte76($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '76%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde76($societe_id,$date_exercice,$date_fin){
        $resultat = compte76($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte66($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '66%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde66($societe_id,$date_exercice,$date_fin){
        $resultat = compte66($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte695($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '695%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde695($societe_id,$date_exercice,$date_fin){
        $resultat = compte695($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte692($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '692%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde692($societe_id,$date_exercice,$date_fin){
        $resultat = compte692($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte77($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '77%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde77($societe_id,$date_exercice,$date_fin){
        $resultat = compte77($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }

    function compte67($societe_id,$date_exercice,$date_fin) {
        $connexion = db_connect();
        $sql = "SELECT sum(total_debit) as total_debit,sum(total_credit) as total_credit from solde
        where societe=:societe and numero like '67%'
        and date_ecriture >= :date_exercice and date_ecriture < :date_fin";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':societe', $societe_id);
        $stmt->bindParam(':date_exercice', $date_exercice);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function solde67($societe_id,$date_exercice,$date_fin){
        $resultat = compte67($societe_id,$date_exercice,$date_fin);
        $debit = $resultat['total_debit'];
        $credit = $resultat['total_credit'];
        if($debit > $credit) return $debit - $credit;
        else if($credit > $debit) return $credit - $debit;
        else return 0;
    }
?>