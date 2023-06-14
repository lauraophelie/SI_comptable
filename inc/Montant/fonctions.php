<?php 

    function dbconnect__() {
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
    //----->donnee de test fotsiny
    // create table test(
    //     id serial primary key,
    //     produit VARCHAR(30),
    //     quantite int,
    //     prix_unitaire float
    // );
    
    // insert into test(produit,quantite,prix_unitaire) values('riz',10,3000);
    // insert into test(produit,quantite,prix_unitaire) values('manioc',20,4000);
    
    function getAll() {
        $connexion = dbconnect__();
        $sql = "SELECT * FROM test";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function montant_HT($quantite, $prix_unitaire) {
        return $quantite*$prix_unitaire;
    }

    function getTVA() {
        $connexion = dbconnect__();
        $sql = "SELECT tva FROM TVA";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    } 

    function calcul_TVA($total, $tva){
        $TVA = $total* ($tva/100);
        if($TVA < 0) {
            return "il y a une erreur";
        }else {
            return $TVA;
        }
    }

    function calcul_TTC($total_HT,$tva) {
        $total = $total_HT + $tva;
        if($total < 0) {
            return "il y a une erreur";
        }else {
            return $total;
        }
    }
    
    function net_a_payer($TTC,$avance) {
        $net_a_payer = $TTC - $avance;
        if($net_a_payer < 0 && $net_a_payer == 0) {
            return "il y a une erreur";
        }else {
            return $net_a_payer;
        }
    }

?>