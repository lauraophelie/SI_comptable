<?php
    include("./fonctions.php");
    include("../ecritures/fonctions.php");

    $designation = $_POST['designation'];
    $prix = $_POST['prix'];
    $unite = $_POST['unite'];

    if(!isset($designation) || empty($designation)) {
        header('Location: ../../pages/page.php?page=produit/form_insert&error=Les champs ne peuvent pas être vides');
        exit();
    }  

    if(!isset($prix) || empty($prix)) {
        header('Location: ../../pages/page.php?page=produit/form_insert&error=Les champs ne peuvent pas être vides');
        exit();
    }

    if(!isset($unite) || empty($unite)) {
        header('Location: ../../pages/page.php?page=produit/form_insert&error=Les champs ne peuvent pas être vides');
        exit();
    } 

    if($prix <= 0) {
        header('Location: ../../pages/page.php?page=produit/form_insert&error=Le prix ne peut pas etre negatif ou nul.');
        exit();
    } 

    $produit = verifProduit($designation);
    if($produit== true){
        header('Location: ../../pages/page.php?page=produit/form_insert&error=Ce produit existe déjà');
        exit();
    }else{
        $id_unite = getID_unite($unite)['id'];
        $insert = save_product($designation,$prix,$id_unite);
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