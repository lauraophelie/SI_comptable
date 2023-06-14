<?php
    include("./fonctions.php");
    $id = $_GET['id'];
    $delete = delete_produit($id);
   
        if($delete == true) {
            header('Location: ../../pages/page.php?page=produit/affichage_produit&message=Le compte a ete supprime avec succes !');
            exit();
        } else {
            header("Location: ../../pages/page.php?page=produit/affichage_produit&erreur=Une erreur s'est produite lors de la suppression du compte !");
            exit();
        }
    
?>