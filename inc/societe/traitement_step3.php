<?php 
    session_start();
    include("./fonctions.php");
    if(!isset($_SESSION['societe'])){
        header("Location: ../../pages/societe/inscription_step1.php?error=Session expire, remplir de nouveau");
    }
    if(isset( $_POST['mot_de_passe'])){
        $_SESSION['societe']['mot_de_passe']=$_POST['mot_de_passe'];
    }
    if(isset( $_POST['re_mot_de_passe']) && isset($_SESSION['societe']['mot_de_passe'])) {
        $mdp = validate($_SESSION['societe']['mot_de_passe']);
        $mdp1 = validate($_POST['re_mot_de_passe']);

        if(empty($mdp) || empty($mdp1)|| $mdp != $mdp1) {
            header("Location: ../../pages/societe/inscription_step3.php?error=Vérifier les mots de passe");
            exit();
        } else {
            $nom = $_SESSION['societe']['nom_societe'];
            $objet = $_SESSION['societe']['objet'];
            $date_creation = $_SESSION['societe']['date_creation'];
            save($nom, $objet, $date_creation, $mdp);
            $id_soc = lastID();
            $capital = $_SESSION['societe']['capital'];
            $date_debut = $_SESSION['societe']['date_debut'];
            $tenu = $_SESSION['societe']['devise_tenu'];
            saveCompta($id_soc,$capital,$date_debut,$tenu);
            setAdresse($id_soc);
            setIdent($id_soc);
            header("Location: ../../pages/page.php?page=dashboard/dashboard");
            exit();
        }

    } else {
        header("Location: ../../pages/login/login.php");
        exit();
    }
?>