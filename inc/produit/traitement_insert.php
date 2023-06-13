<?php
    include("./fonctions.php");
    include("../ecritures/fonctions.php");

    $designation = $_POST['designation'];

    if(!isset($designation) || empty($designation)) {
        header('Location: ../../pages/page.php?page=produit/form_insert&error=Les champs ne peuvent pas être vides');
        exit();
    }  
    
    $produit = verifProduit($designation);
    if($produit== true){
        header('Location: ../../pages/page.php?page=produit/form_insert&error=Ce produit existe déjà');
        exit();
    }else{
        $insert = save_produit($designation);
        if($insert == true) {
            reset_cles_rep_produit_centre();
            header('Location: ../../pages/page.php?page=produit/affichage_produit&message=Insertion terminée avec succès !');
            exit();
        } else {
            header('Location: ../../pages/page.php?page=produit/affichage_produit&error=Une erreur s\'est produite lors de l\'insertion !');
            exit();
        }
    }
?>