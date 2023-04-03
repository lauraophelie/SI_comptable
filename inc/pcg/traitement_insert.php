<?php
    include("./fonctions.php");
    $numero = $_POST['numero'];
    $designation = $_POST['designation'];

    if(!isset($numero)&&!isset($designation) || empty($numero)&& empty($designation)) {
        header('Location: ../../pages/page.php?page=pcg/ajout_pcg&error=Les champs ne peuvent pas être vides');
        exit();
    }
    if(empty($numero) || !isset($numero) || empty($designation) || !isset($designation)) {
        header('Location: ../../pages/page.php?page=pcg/ajout_pcg&error=Veuillez remplir ce champs');
        exit();
    }
    if(strlen($numero) < 5) {
        header('Location: ../../pages/page.php?page=pcg/ajout_pcg&error=Le nombre caractères du numéro de compte doit être égal à 5');
        exit();
    } else if(strlen($numero) > 5) {
        header('Location: ../../pages/page.php?page=pcg/ajout_pcg&error=Le nombre caractères du numéro de compte ne doit pas dépasser 5');
        exit();
    }
    $insert = save($numero, $designation);
    if($insert == true) {
        header('Location: ../../pages/page.php?page=pcg/ajout_pcg&message=Insertion terminée avec succès !');
        exit();
    } else {
        header('Location: ../../pages/page.php?page=pcg/ajout_pcg&error=Une erreur s\'est produite lors de l\'insertion !');
        exit();
    }
?>