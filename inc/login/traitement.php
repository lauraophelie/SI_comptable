<?php
    session_start();
    include("fonctions.php");

    if(isset( $_POST['nom']) && isset($_POST['mdp'])) {

        $nom = validate($_POST['nom']);
        $mdp = validate($_POST['mdp']);
        $passe = getMDP($nom);

        if(!isset($mdp) || empty($mdp) || !isset($nom) || empty($nom)) {
            header("Location: ../../pages/login/login.php?error=Les champs ne peuvent pas être vide");
            exit();
        }

        if($passe == $mdp){   
            $_SESSION['nom'] = $nom; 
            header("Location: ../../pages/accueil/accueil.php ");
            exit();
        } else {
            header("Location: ../../pages/login/login.php?erreur=mot de passe incorrect");
            exit();
        }

    } else {
        header("Location: ../../pages/login/login.php");
        exit();
    }
?>