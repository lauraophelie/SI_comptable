<?php
    session_start();
    include("fonctions.php");
    if(isset( $_POST['nom']) && isset($_POST['mdp'])) {
        $nom = validate($_POST['nom']);
        $mdp = validate($_POST['mdp']);

        $passe = getMDP($nom);

        if(empty($mdp) || empty($nom)) {
            header("Location: ../../pages/login/login.php?error=Les champs ne peuvent pas etre vide");
            exit();
        }else if($passe == $mdp){    
            header("Location: ../../pages/accueil/accueil.php ");
        }else{
            header("Location: ../../pages/login/login.php?erreur=mot de passe incorrect");
            exit();
        }
    }else{
        header("Location: ../../pages/login/login.php");
        exit();
    }

?>