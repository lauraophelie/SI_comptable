<?php
    include("fonctions.php");
    $designation = $_POST['designation'];

    if(!isset($designation) || empty($designation)) {
        header('Location: ../../pages/produit/form_insert.php?error=Les champs ne peuvent pas être vides');
        exit();
    }  
    
    $produit = verifProduit($designation);
    if($produit== true){
        header('Location: ../../pages/produit/form_insert.php?error=Ce produit existe deja');
        exit();
    }else{
        $insert = save($designation);
        if($insert == true) {
            header('Location: ../../pages/produit/affichage_produit.php?message=Insertion terminee avec succes !');
            exit();
        } else {
            header('Location: ../../pages/produit/affichage_produit.php?error=Une erreur s\'est produite lors de l\'insertion !');
            exit();
        }
    }
?>