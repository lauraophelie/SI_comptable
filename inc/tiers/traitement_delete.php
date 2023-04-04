<?php
    include("./fonctions.php");
    $id = $_GET['id'];
    $num = $_GET['num'];
    $delete = delete($id);
    $verifEcriture = verifEcriture($num);
    
    if($verifEcriture == true) {
        header('Location: ../../pages/page.php?page=tiers/affichage_tiers&num_page=1&error=Le compte n\'a pas pû être supprimé');
        exit();
    } else {
        if($delete == true) {
            header('Location: ../../pages/page.php?page=tiers/affichage_tiers&num_page=1&message=Le compte a été supprimé avec succès !');
            exit();
        } else {
            header("Location: ../../pages/page.php?page=tiers/affichage_tiers&num_page=1&erreur=Une erreur s'est produite lors de la suppression du compte !");
            exit();
        }
    }
?>