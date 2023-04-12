<?php
    include("./fonctions.php");
    $devise = $_POST['devise'];
    $taux = $_POST['taux'];

    $check = check_devise($devise);
    if($check == true) {
        header("Location: ../../pages/page=devise/affichage_devise&devise=".$devise."&taux=".$taux."&error=La devise ".$devise. " existe déjà");
        exit();
    } else {
        if(!isset($devise) && !isset($taux) || empty($devise) && empty($taux)) {
            header("Location: ../../pages/page=devise/affichage_devise&error=Veuillez remplir les champs");
            exit();
        }
        if(!isset($taux) || !isset($devise)) {
            header("Location: ../../pages/page=devise/affichage_devise&error=Veuillez remplir ce champs&devise=".$devise."&taux=".$taux);
            exit();
        }
        if(!is_numeric($taux)) {
            header("Location: ../../pages/page=devise/affichage_devise&devise=".$devise."&taux=".$taux."&error=Le taux est invalide, veuillez entrer un nombre");
            exit();
        }
        $new_devise = insert_new_devise($devise);
        if($new_devise == true) {
            $insert_taux = insert_taux($devise, $taux, null);
            if($insert_taux == true) {
                header("Location: ../../pages/page=devise/affichage_devise&message=Insertion terminée avec succès");
                exit();
            } else {
                header("Location: ../../pages/page=devise/affichage_devise&error=Une erreur s'est produite lors de l'insertion");
                exit();
            }
        } else {
            header("Location: ../../pages/page=devise/affichage_devise&error=Une erreur s'est produite lors de l'insertion");
            exit();
        }
    }
?>