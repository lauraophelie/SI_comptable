<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $designation = $_POST['designation'];

    $centre = update($id,$designation);
    if($centre == true) {
        header('Location: ../../pages/centre/affichage_centre.php');
        exit();
    }else{
        header("Location: ../../pages/centre/affichage_centre.php?error=Une erreur s'est produite lors de la modifications du compte");
        exit();
    }
?>