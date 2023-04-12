<?php
    include("./fonctions.php");

    $devise = $_POST['devise'];
    $taux = $_POST['taux'];
    $date_taux = $_POST['date_taux'];

    $find = find_by_devise($devise, $date_taux);

    if($taux == $find['taux'] && $date_taux == $find['date_taux']) {
        header("Location: ../../pages/page.php?page=devise/affichage_devise");
        exit();
    }
    if(isset($taux) || empty($taux)) {
        header("Location: ../../pages/page.php?page=devise/maj_taux_devise&devise=".$devise."&date_taux=".$date_taux."&error=Veuillez indiquer le taux");
        exit();
    }
    $save = insert_taux($devise, $taux, $date_taux);
    if($save == true) {
        header("Location: ../../pages/page.php?page=devise/affichage_devise&message=Mise à jour terminée avec succès");
        exit();
    } else {
        header("Location: ../../pages/page.php?page=devise/affichage_devise&error=Une erreur s'est produite lors de la mise à jour");
        exit();
    }
?>