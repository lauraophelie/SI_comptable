<?php
    function dbconnect_base() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';

        try {
            $connexion = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
            return $connexion;
        } catch(Exception $e) {
            echo 'Erreur : '.$e-> getMessage().'<br />';
            echo 'N° : '.$e-> getCode();
        }   
    }

    function liste_factures() {
        $connexion = dbconnect_base();
        $sql="SELECT * from v_facture ORDER BY id ASC";
        $stmt=$connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getLast($id_societe){
        $connexion = dbconnect_base();
        $sql = "SELECT * FROM gen_id_facture WHERE societe = :id";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":id",$id_societe);
        $statmn -> execute();
        $result = $statmn -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // générer nouvel ID pas mm mois/année
    function newGen($id_societe){
        $connexion = dbconnect_base();
        $sql = "UPDATE gen_id_facture SET date_fact = NOW(), last_index = 1 WHERE societe = :id";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":id",$id_societe);
        $statmn = $connexion -> prepare($sql);
        $statmn -> execute();
    }

    // générer nouvel ID mm mois/année
    function updateGen($id_societe){
        $connexion = dbconnect_base();
        $sql = "UPDATE gen_id_facture SET last_index = last_index+1 WHERE societe = :id";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":id",$id_societe);
        $statmn -> execute();
    }

    function generate($id){
        $last = getLast($id);
        $lastDate = new DateTime($last['date_fact'],new DateTimeZone('Indian/Antananarivo'));
        $today = new DateTime('now',new DateTimeZone('Indian/Antananarivo'));
        $lastMois = $lastDate -> format('m');
        $thisMois = $today -> format('m');
        $lastYear = $lastDate -> format('Y');
        $thisYear = $today -> format('Y');
        if($lastYear<$thisYear || $lastMois<$thisMois){
            newGen($id);
            return $last['abreviation']."/".$thisMois."/".$thisYear."/001";
        }
        else{
            $newIndex = $last['last_index']+1;
            $nombreFormatte = sprintf("%03d", $newIndex);
            updateGen($id);
            return $last['abreviation']."/".$thisMois."/".$thisYear."/".$nombreFormatte;
        }
    }

    function insert_facture($id, $date_fact, $societe, $tiers, $total_ttc, $tva, $reference, $objet, $avance, $net_a_payer) {
        $conn = dbconnect_base();
        $sql = "INSERT INTO facture (id, date_fact, societe, tiers, total_ttc, tva, reference, objet, avance, net_a_payer) VALUES ('%s', '%s', %d, %d, %f, %f, '%s', '%s', %f, %f)";
        $query = sprintf($sql,
            $id,
            $date_fact,
            $societe,
            $tiers,
            $total_ttc,
            $tva,
            $reference,
            $objet,
            $avance,
            $net_a_payer
        );
        echo $query;
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }

    function ecriture($journal, $societe, $date_ecriture, $numero_piece, $cg, $ct, $libelle, $debit, $credit) {
        $conn = dbconnect_base();
        $sql = "INSERT INTO ecriture_journal (journal, societe, date_ecriture, numero_piece, compte_general, compte_tiers, libelle, debit, credit) 
        VALUES ('%s', %d, '%s', '%s', '%s', '%s', '%s', %f, %f)";
        $query = sprintf($sql,
            $journal,
            $societe,
            $date_ecriture,
            $numero_piece,
            $cg,
            $ct,
            $libelle,
            $debit,
            $credit
        );
        echo $query;
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }  

    function generer_ecriture($societe, $date_ecriture, $numero_piece, $libelle, $tiers, $total_ht, $total_tva, $total_ttc) {
        $e1 = ecriture('VL', $societe, 'now()', $numero_piece, '70700', null, $libelle, 0, $total_ht);
        echo $e1;
        $e2 = ecriture('VL', $societe, 'now()', $numero_piece, '44570', null, $libelle, 0, $total_tva);
        echo $e2;
        $e3 = ecriture('VL', $societe, 'now()', $numero_piece, '41100', $tiers, $libelle, $total_ttc, 0);
        echo $e3;
    }

    function insert_details_facture($produit, $quantite, $prix_unitaire, $montant_ht, $montant_ttc, $id_facture) {
        
    }

    function FindByNom($nom) {
        $connexion = dbconnect_base();
        $sql = "SELECT * from v_facture where nom_tiers=:nom";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    function FindByQuantite($quantite) {
        $connexion = dbconnect_base();
        $sql = "SELECT * from v_details where quantite=:quantite";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    function FindByQuantiteInterval($quantite1,$quantite2) {
        $connexion = dbconnect_base();
        $sql = "SELECT * FROM v_details WHERE quantite BETWEEN :quantite1 AND :quantite2";
        $stmt = $connexion -> prepare($sql);
        $stmt->bindParam(':quantite1', $quantite1);
        $stmt->bindParam(':quantite2', $quantite2);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }
    function searchDateFacture($date){
        $connexion = dbconnect_base();
        $sql = "SELECT * FROM v_facture WHERE date_fact like :date";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":date",$date);
        $statmn -> execute();
        $result = $statmn -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function searchFacDateEntre($date1, $date2){
        $connexion = dbconnect_base();
        $sql = "SELECT * FROM v_facture WHERE date_fact > :min AND date_fact < :max";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":min",$date1);
        $statmn -> bindParam(":max",$date2);
        $statmn -> execute();
        $result = $statmn -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
?>