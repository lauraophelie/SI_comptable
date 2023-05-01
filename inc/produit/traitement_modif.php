<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $designation = $_POST['designation'];

    $produit = update($id,$designation);
    if($produit == true) {
        header('Location: ../../pages/produit/affichage_produit.php');
        exit();
    }else{
        header("Location: ../../pages/produit/affichage_produit.php?error=Une erreur s'est produite lors de la modifications du compte");
        exit();
    }
?>