<?php
    include("fonctions.php");
    $designation = $_POST['designation'];

    if(!isset($designation) || empty($designation)) {
        header('Location: ../../pages/centre/form_insert.php?error=Les champs ne peuvent pas être vides');
        exit();
    }  
    
    $centre = verifcentre($designation);
    if($centre== true){
        header('Location: ../../pages/centre/form_insert.php?error=Ce centre existe deja');
        exit();
    }else{
        $insert = save($designation);
        if($insert == true) {
            header('Location: ../../pages/centre/affichage_centre.php?message=Insertion terminee avec succes !');
            exit();
        } else {
            header('Location: ../../pages/centre/affichage_centre.php?error=Une erreur s\'est produite lors de l\'insertion !');
            exit();
        }
    }
?>