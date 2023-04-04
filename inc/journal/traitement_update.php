<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $code = $_POST['code'];
    $designation = $_POST['designation'];

    if(!isset($code) && !isset($designation) || empty($code) && empty($designation)) {
        header("Location: ../../pages/page.php?page=journal/modif_journal&error=Les champs ne peuvent pas être vides !&code=".$id);
        exit();
    }
    if(!isset($code) || empty($code) || empty($designation) || !isset($designation)) {
        header("Location: ../../pages/page.php?page=journal/modif_journal&error=Veuillez remplir ce champs&code=".$id);
        exit();
    }
    $modification = update($id, $code, $designation);
    
    if($modification == true) {
        header("Location: ../../pages/page.php?page=journal/affichage_journaux&message=Modification terminée avec succès !");
        exit();
    } else {
        header("Location: ../../pages/page.php?page=journal/affichage_journaux&error=Une erreur s'est produite lors de la modification, veuillez réessayer !");
        exit();
    }
?>