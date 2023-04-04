<?php
    session_start();
    include("./fonctions.php");

    if(isset( $_POST['nom']) && isset($_POST['mdp'])) {

        $nom = validate($_POST['nom']);
        $mdp = validate($_POST['mdp']);
        $societe = get_societe($nom);
        $passe = $societe['mot_de_passe'];

        if(!isset($mdp) || empty($mdp) || !isset($nom) || empty($nom)) {
            header("Location: ../../pages/login/login.php?error=Veuillez remplir tous les champs&nom=".$nom);
            exit();
        }
        if(get_societe($nom) == false) {
            header("Location: ../../pages/login/login.php?not_exist=Nom de société introuvable, veuillez réessayer&nom=".$nom);
            exit();
        }
        if($passe == $mdp){   
            $_SESSION['nom'] = $nom;
            $_SESSION['id_societe'] = $societe['id'];
            header("Location: ../../pages/accueil/accueil.php ");
            exit();
        } else {
            header("Location: ../../pages/login/login.php?erreur=Mot de passe incorrect, veuillez réessayer&nom=".$nom);
            exit();
        }

    } else {
        header("Location: ../../pages/login/login.php");
        exit();
    }
?>
