<?php
    require_once("./fonctions.php");
    header('Content-Type: text/html; charset=utf-8');

    $sessionData = json_decode($_POST['data'], true);
    
    var_dump(json_encode($sessionData));
    echo "Données de session enregistrées avec succès";
?>
