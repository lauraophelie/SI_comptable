<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $designation = $_POST['designation'];
    $prix = $_POST['prix'];
    $unite = $_POST['unite'];
    
    $id_unite = getID_unite($unite)['id'];

    $produit = update_product($id,$designation,$prix,$id_unite);
    if($produit == true) {
        header('Location: ../../pages/page.php?page=produit/affichage_produit');
        exit();
    }else{
        header("Location: ../../pages/page.php?page=produit/affichage_produit&error=Une erreur s'est produite lors de la modifications du compte");
        exit();
    }
?>