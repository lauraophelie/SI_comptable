<?php 
    session_start();
    include("./fonctions.php");
    if(!isset($_SESSION['societe'])){
        $_SESSION['societe'] = array();
    }
    if(isset( $_POST['nom_societe'])){
        $_SESSION['societe']['nom_societe']=$_POST['nom_societe'];
    }
    if(isset($_POST['objet'])){
        $_SESSION['societe']['objet']=$_POST['objet'];
    }
    if(isset($_POST['date_creation'])){
        $_SESSION['societe']['date_creation']=$_POST['date_creation'];
    }
    if(isset($_POST['adresse'])){
        $_SESSION['societe']['adresse']=$_POST['adresse'];
    }
    if(isset( $_POST['nom_societe']) && isset($_POST['objet'])&& isset($_POST['date_creation'])&& isset($_POST['adresse'])) {
        $nom_societe = validate($_POST['nom_societe']);
        $objet = validate($_POST['objet']);
        $adresse = validate($_POST['adresse']);
        $date_creation = validate($_POST['date_creation']);

        if(!isset($nom_societe) || empty($nom_societe) || !isset($objet) || empty($objet)|| !isset($date_creation) || empty($date_creation)|| !isset($adresse) || empty($adresse)) {
            header("Location: ../../pages/societe/inscription_step1.php?error=Veuillez remplir tous les champs");
            exit();
        } else {
            header("Location: ../../pages/societe/inscription_step2.php");
            exit();
        }

    } else {
        header("Location: ../../pages/login/login.php");
        exit();
    }
?>