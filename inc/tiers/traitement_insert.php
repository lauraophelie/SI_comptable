<?php
    include("./fonctions.php");

    $type_tiers = $_POST['type_tiers'];
    $numero = $_POST['num'];
    $designation = $_POST['designation'];
    $num = getNum($numero);

        if($num == true){
            header('Location: ../../pages/page.php?page=tiers/tiers&error=Ce numéro existe déjà');
            exit();
        } else {
            $insert = save($type_tiers, $numero, $designation);
            if($insert == true) {
                header('Location: ../../pages/page.php?page=tiers/affichage_tiers&num_page=1&message=Insertion terminée avec succès !');
                exit();
            } else {
                header('Location: ../../pages/page.php?page=tiers/tiers&error=Une erreur s\' produite lors de l\'insertion');
                exit();
            }
        }
?>