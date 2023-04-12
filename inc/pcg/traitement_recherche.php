<?php
    include("./fonctions.php");
    $recherche = $_GET['recherche_compte'];
    $find = find_all_by_recherche($recherche);

    if(empty($find) || $find == null) {
        header("Location: ../../pages/page.php?page=pcg/resultat_recherche&vide=Aucun résultat ne correspond à votre recherche&recherche_compte=".$recherche);
        exit();
    } else {
        header("Location: ../../pages/page.php?page=pcg/resultat_recherche&recherche_compte=".$recherche);
        exit();
    }
?>