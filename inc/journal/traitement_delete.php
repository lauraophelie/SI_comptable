<?php
    include("./fonctions.php");
    $journal = $_GET['journal'];
    $del = delete($journal);
    if($del == true) {
        header("Location: ../../pages/page.php?page=journal/affichage_journaux&message=Journal supprimé avec succès");
        exit();
    } else {
        header("Location: ../../pages/page.php?page=journal/affichage_journaux&error=Le journal n'a pas pû être supprimé, une erreur s'est produite");
        exit();
    }
?>