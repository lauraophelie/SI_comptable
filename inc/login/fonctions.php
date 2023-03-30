<?php
    function db_connect() {
        $PARAM_hote = 'localhost';
        $PARAM_nom_bd = 'gestion_compta';
        $PARAM_utilisateur = 'gestion_compta';
        $PARAM_mot_passe = 'compta';
        $PARAM_port = '5432';
        try {
            $connexion = new PDO('pgsql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
            return $connexion;
        }catch(Exception $e) {
            echo 'Erreur : '.$e-> getMessage().'<br />';
            echo 'N° : '.$e-> getCode();
        }   
    }

    function validate($data){
        $connexion = db_connect();
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function getMDP($nom) {
        $connexion = db_connect();
        $sql = "select mot_de_passe from societe where nom='%s'";
        $sql = sprintf($sql, $nom);
        echo $sql;
        $value = $connexion->prepare($sql);
        $value -> execute();
        $result = $value->fetch(PDO::FETCH_ASSOC);
        if($result) {
            return $result['mot_de_passe'];
        }
    }
?>