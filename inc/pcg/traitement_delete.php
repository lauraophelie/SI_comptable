<?php
    include("./fonctions.php");
    $compte = $_GET['compte'];
    $del = delete($compte);
    if($del == true) {
        header("Location: ../../pages/pcg/affichage_pcg.php?message=Compte supprimé avec succès !");
        exit();
    } else {
        header("Location: ../../pages/pcg/affichage_pcg.php?error=Une erreur s'est produite lors de la suppresion du compte !");
        exit();
    }
?>