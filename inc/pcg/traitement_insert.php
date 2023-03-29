<?php
    include("./fonctions.php");
    $numero = $_POST['numero'];
    $designation = $_POST['designation'];

    if(!isset($numero)&&!isset($designation) || empty($numero)&& empty($designation)) {
        header('Location: ../../pages/pcg/ajout_pcg.php?error=Les champs ne peuvent pas être vides');
        exit();
    }
    if(empty($numero) || !isset($numero) || empty($designation) || !isset($designation)) {
        header('Location: ../../pages/pcg/ajout_pcg.php?error=Veuillez remplir ce champs');
        exit();
    }
    if(strlen($numero) < 5) {
        header('Location: ../../pages/pcg/ajout_pcg.php?error=Le nombre caractères doit être égal à 5');
        exit();
    } else if(strlen($numero) > 5) {
        header('Location: ../../pages/pcg/ajout_pcg.php?error=Le nombre caractères ne doit pas dépasser 5');
        exit();
    }
    $insert = save($numero, $designation);
    if($insert == true) {
        header('Location: ../../pages/pcg/ajout_pcg.php?message=Insertion terminée avec succès !');
        exit();
    } else {
        header('Location: ../../pages/pcg/ajout_pcg.php?error=Une erreur s\'est produite lors de l\'insertion !');
        exit();
    }
?>