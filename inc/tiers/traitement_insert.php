<?php
    include("./fonctions.php");
    $numero = $_POST['num'];
    $designation = $_POST['designation'];
    $libelle = findByNumero($numero);
    $num = getNum($designation);

        if($num == true){
            header('Location: ../../pages/tiers/tiers.php?error=Cette dEsignation existe déjà');
            exit();
        }else{
            $insert= save($designation,$libelle['designation']);
            header('Location: ../../pages/tiers/affichage_tiers.php');
            exit();
        }
?>