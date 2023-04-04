<?php
    include("./fonctions.php");
    $code = $_POST['code'];
    $designation = $_POST['designation'];

    if(!isset($code)&&!isset($designation) || empty($code)&& empty($designation)) {
        header('Location: ../../pages/journal/ajout_journal.php?error=Les champs ne peuvent pas être vides');
        exit();
    }
    if(empty($code) || !isset($code) || empty($designation) || !isset($designation)) {
        header('Location: ../../pages/page.php?page=journal/ajout_journal&error=Veuillez remplir ce champs');
        exit();
    }
    $insert = save($code, $designation);
    if($insert == true) {
        header('Location: ../../pages/page.php?page=journal/ajout_journal&message=Insertion terminée avec succès !');
        exit();
    } else {
        header('Location: ../../pages/page.php?page=journal/ajout_journal&error=Une erreur s\' est produite, veuillez réessayer !');
        exit();
    }
?>