<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $numero = $_POST['num'];
    $designation = $_POST['designation'];
    $libelle = findByNumero($numero);
    $num = getNum($designation);

    $modif = update($designation,$libelle['designation'],$id);
    if($modif == true) {
        header('Location: ../../pages/tiers/affichage_tiers.php');
        exit();
    }else{
        header("Location: ../../pages/tiers/affichage_tiers.php?error=Une erreur s'est produite lors de la modifications du compte");
        exit();
    }
?>