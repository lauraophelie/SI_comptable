<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $numero = $_POST['numero'];
    $designation = $_POST['designation'];

    if(!isset($numero) && !isset($designation) || empty($numero) && empty($designation)) {
        header("Location: ../../pages/page.php?page=pcg/modif_pcg&error=Les champs ne peuvent pas être vides !&compte=".$id);
        exit();
    }
    if(!isset($numero) || empty($numero) || empty($designation) || !isset($designation)) {
        header("Location: ../../pages/page.php?page=pcg/modif_pcg&error=Veuillez remplir ce champs&compte=".$id);
        exit();
    }
    if(strlen($numero) < 5) {
        header("Location: ../../pages/page.php?page=pcg/modif_pcg&error=Le nombre de caratères doit être de 5&compte=".$id);
        exit();
    }
    if(strlen($numero) > 5) {
        header("Location: ../../pages/page.php?page=pcg/modif_pcg&error=Le nombre de caractères ne doit pas dépasser 5&compte=".$id);
        exit();
    }
    $modif = update($id, $numero, $designation);
    if($modif == true) {
        header("Location: ../../pages/page.php?page=pcg/affichage_pcg&num_page=1&message=Modification terminee avec succes !");
        exit();
    } else {
        header("Location: ../../pages/page.php?page=pcg/modif_pcg&num_page=1&error=Une erreur s'est produite lors de la modification !");
        exit();
    }
?>