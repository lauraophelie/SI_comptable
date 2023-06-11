<?php 
    session_start();
    include("./fonctions.php");
    if(!isset($_SESSION['societe'])){
        header("Location: ../../pages/societe/inscription_step1.php?error=Session expire, remplir de nouveau");
        exit();
    }
    if(isset( $_POST['capital'])){
        $_SESSION['societe']['capital']=$_POST['capital'];
    }
    if(isset($_POST['date_debut'])){
        $_SESSION['societe']['date_debut']=$_POST['date_debut'];
    }
    if(isset($_POST['devise_tenu'])){
        $_SESSION['societe']['devise_tenu']=$_POST['devise_tenu'];
    }
    if(isset( $_POST['capital']) && isset($_POST['date_debut'])&& isset($_POST['devise_tenu'])) {
        $capital = validate($_POST['capital']);
        $date_debut = validate($_POST['date_debut']);
        $devise_tenu = validate($_POST['devise_tenu']);

        if(!isset($capital) || empty($capital) || !isset($date_debut) || empty($date_debut)|| !isset($devise_tenu) || empty($devise_tenu)) {
            header("Location: ../../pages/societe/inscription_step2.php?error=Veuillez remplir tous les champs");
            exit();
        } else {
            header("Location: ../../pages/societe/inscription_step3.php");
            exit();
        }
    } else {
        header("Location: ../../pages/login/login.php");
        exit();
    }
?>