<?php
    include("fonctions.php");
    $libelle = $_POST['libelle'];
    $unite = $_POST['unite'];
    if(!isset($libelle) || empty($libelle)) {
        header('Location: ../../pages/cout/ajout_unite.php?error=Les champs ne peuvent pas être vides');
        exit();
    }else{  
    
        $insert = save_unite_compte_6($libelle,$unite);
        if($insert == true) {
            header('Location: ../../pages/cout/affichage_cout_centre.php?message=Insertion terminee avec succes !');
            exit();
        } else {
            header('Location: ../../pages/cout/affichage_cout_centre.php?error=Une erreur s\'est produite lors de l\'insertion !');
            exit();
        }
    }
?>