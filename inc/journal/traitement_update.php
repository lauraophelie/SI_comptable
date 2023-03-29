<?php
    include("./fonctions.php");
    $id = $_POST['id'];
    $code = $_POST['code'];
    $designation = $_POST['designation'];

    if(!isset($code) && !isset($designation) || empty($code) && empty($designation)) {
        header("Location: ../../pages/pcg/modif_pcg.php?error=Les champs ne peuvent pas être vides !&compte=".$id);
        exit();
    }
    if(!isset($code) || empty($code) || empty($designation) || !isset($designation)) {
        header("Location: ../../pages/pcg/modif_pcg.php?error=Veuillez remplir ce champs&compte=".$id);
        exit();
    }
    $modification = update($id, $code, $designation);
    
    if($modification == true) {
        header("Location: ../../pages/journal/affichage_journaux.php?message=Modification terminée avec succès !");
        exit();
    } else {
        header("Location: ../../pages/journal/affichage_journaux.php?error=Une erreur s'est produite lors de la modification, veuillez réessayer !");
        exit();
    }
?>