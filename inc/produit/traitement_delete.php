<?php
    include("./fonctions.php");
    $id = $_GET['id'];
    $delete = delete_produit($id);
   
        if($delete == true) {
            header('Location: ../../pages/produit/affichage_produit.php?message=Le compte a ete supprime avec succes !');
            exit();
        } else {
            header("Location: ../../pages/produit/affichage_produit.php?erreur=Une erreur s'est produite lors de la suppression du compte !");
            exit();
        }
    
?>