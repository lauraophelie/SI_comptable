<?php
    include("./titres.php");
    session_start();

    if($_GET['page'] === "pcg/affichage_pcg&num_page=1") {

        if(isset($_GET['num_page'])) $page .= "&num_page=".$_GET['num_page'];

    } else {
        $page = $_GET['page'].".php";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/styles/style.css">
    <link rel="stylesheet" href="../assets/css/styles/formulaire.css">
    <link rel="stylesheet" href="../assets/css/styles/tableaux_pcg_journaux.css">
    <link rel="stylesheet" href="../assets/icons/fontawesome-5/css/all.css">
    <link rel="stylesheet" href="../assets/css/parsley.css">
    <link rel="stylesheet" href="../assets/css/ecritures/ecritures.css">
    <link rel="stylesheet" href="../assets/css/ecritures/ajout_ecriture.css">
    <title> <?php echo $titre[$page]; ?> </title>
</head>
<body>
    <div class="page-menu">
        <div id="societe">
            <h1>
                <?php echo $_SESSION['nom']; ?>
            </h1>
        </div>
        <div id="liste-liens">

            <div class="liste-element">
                <a href="accueil/accueil.php">
                    <p> Accueil </p>
                </a>
            </div>

            <div class="liste-element
                <?php if($page === "societe/info.php" || strpos($page, "societe/") !== false) echo "active"; ?>
            "> 
                <a href="./page.php?page=societe/info">
                    <p> Informations sur la société </p>
                </a>
            </div>

            <div class="liste-element
                <?php if($page === "pcg/affichage_pcg" || strpos($page, "pcg/") !== false) echo "active"; ?>
            "> 
                <a href="./page.php?page=pcg/affichage_pcg&num_page=1">
                    <p> Plan comptable </p>
                </a>
            </div>
            <div class="liste-element
            <?php if($page === "devise/devises" || strpos($page, "devise/") !== false) echo "active"; ?>
            "> 
                <a href="./page.php?page=devise/devises">
                    <p> Devise </p>
                </a>
            </div>
            
            <div class="liste-element
                <?php if($page === "journal/affichage_journaux" || strpos($page, "journal/") !== false) echo "active"; ?>
            "> 
                <a href="./page.php?page=journal/affichage_journaux">
                    <p> Journal </p>
                </a>
            </div>
            
            <div class="liste-element 
                <?php if($page == "ecritures/listes_ecritures" || strpos($page, "ecritures/") !== false) echo "active"; ?>
            ">
                <a href="./page.php?page=ecritures/listes_ecritures">
                    <p> Ecritures </p>
                </a>
            </div>
            <div class="liste-element 
                <?php if($page == "grandlivre/grandlivre" || strpos($page, "grandlivre/") !== false) echo "active"; ?>
            ">
                <a href="./page.php?page=grandlivre/grandlivre">
                    <p> Grand livre </p>
                </a>
            </div>
            <div class="liste-element 
                <?php if($page == "balance/balance" || strpos($page, "balance/") !== false) echo "active"; ?>
                ">
                <a href="./page.php?page=balance/balance">
                    <p> Balance </p>
                </a>
            </div>
        </div>
    </div>
    <div class="page-content">
        <?php
            include($page);
        ?>
    </div>
    <script src="../assets/js/jquery.js"> </script>
    <script src="../assets/js/parsley.js"> </script>
</body>
</html>