<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $numero = $_POST['numero'];
    $designation = $_POST['designation'];

    if(!isset($numero) && !isset($designation) || empty($numero) && empty($designation)) {
        header("Location: ../../pages/pcg/modif_pcg.php?error=Les champs ne peuvent pas être vides !&compte=".$id);
        exit();
    }
    if(!isset($numero) || empty($numero) || empty($designation) || !isset($designation)) {
        header("Location: ../../pages/pcg/modif_pcg.php?error=Veuillez remplir ce champs&compte=".$id);
        exit();
    }
    if(strlen($numero) < 5) {
        header("Location: ../../pages/pcg/modif_pcg.php?error=Le nombre de caratères doit être de 5&compte=".$id);
        exit();
    }
    if(strlen($numero) > 5) {
        header("Location: ../../pages/pcg/modif_pcg.php?error=Le nombre de caractères ne doit pas dépasser 5&compte=".$id);
        exit();
    }
    $modif = update($id, $numero, $designation);
    if($modif == true) {
        header("Location: ../../pages/pcg/affichage_pcg.php?message=Modification terminée avec succès !");
        exit();
    } else {
        header("Location: ../../pages/pcg/affichage_pcg.php?error=Une erreur s'est produite lors de la modification !");
        exit();
    }
?>