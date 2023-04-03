<?php
    include("./fonctions.php");
    $compte = $_GET['compte'];
    $del = delete($compte);
    if($del == true) {
        header("Location: ../../pages/page.php?page=pcg/affichage_pcg&num_page=1&message=Compte supprimé avec succès !");
        exit();
    } else {
        header("Location: ../../pages/page.php?page=pcg/affichage_pcg&num_page=1error=Une erreur s'est produite lors de la suppresion du compte !");
        exit();
    }
?>