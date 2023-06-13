<?php
    function dbconnect() {
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
        $result = array();

        return $result;
    }

    function getLast($id_societe){
        $connexion = dbconnect();
        $sql = "SELECT * FROM gen_id_facture WHERE societe = :id";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":id",$id_societe);
        $statmn -> execute();
        $result = $statmn -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // générer nouvel ID pas mm mois/année
    function newGen($id_societe){
        $connexion = dbconnect();
        $sql = "UPDATE gen_id_facture SET date_fact = NOW(), last_index = 1 WHERE societe = :id";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":id",$id_societe);
        $statmn = $connexion -> prepare($sql);
        $statmn -> execute();
    }

    // générer nouvel ID mm mois/année
    function updateGen($id_societe){
        $connexion = dbconnect();
        $sql = "UPDATE gen_id_facture SET last_index = last_index+1 WHERE societe = :id";
        $statmn = $connexion -> prepare($sql);
        $statmn -> bindParam(":id",$id_societe);
        $statmn -> execute();
    }

    function generate($id){
        $last = getLast($id);
        $lastDate = new DateTime($last['date_fact'],new DateTimeZone('Indian/Antananarivo'));
        //echo $lastDate ->format('Y-m-d H:i:s');
        //echo $last['abreviation'];
        
        $today = new DateTime('now',new DateTimeZone('Indian/Antananarivo'));
        $lastMois = $lastDate -> format('m');
        $thisMois = $today -> format('m');
        $lastYear = $lastDate -> format('Y');
        $thisYear = $today -> format('Y');
        if($lastYear<$thisYear || $lastMois<$thisMois){
            //newGen($id);
            return $last['abreviation']."/".$thisMois."/".$thisYear."/001";
        }
        else{
            $newIndex = $last['last_index']+1;
            $nombreFormatte = sprintf("%03d", $newIndex);
            //updateGen($id);
            return $last['abreviation']."/".$thisMois."/".$thisYear."/".$nombreFormatte;
        }
    }
?>