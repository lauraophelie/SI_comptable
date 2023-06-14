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
    <link rel="stylesheet" href="../assets/css/produit.css">
    <link rel="stylesheet" href="../assets/css/devise.css">
    <link rel="stylesheet" href="../assets/css/styles/style.css">
    <link rel="stylesheet" href="../assets/css/styles/formulaire.css">
    <link rel="stylesheet" href="../assets/css/styles/tableaux_pcg_journaux.css">
    <link rel="stylesheet" href="../assets/icons/fontawesome-5/css/all.css">
    <link rel="stylesheet" href="../assets/css/parsley.css">
    <link rel="stylesheet" href="../assets/css/ecritures/ecritures.css">
    <link rel="stylesheet" href="../assets/css/ecritures/ajout_ecriture.css">
    <link rel="stylesheet" href="../assets/dashboard/dashboard.css">
    <link rel="stylesheet" href="../assets/css/menu/main_menu.css">
    <link rel="stylesheet" href="../assets/css/menu/menu_compta.css">
    <link rel="stylesheet" href="../assets/css/couts/couts.css">
    <link rel="stylesheet" href="../assets/css/facture/affichage_facture.css">

    <title> <?php echo $titre[$page]; ?> </title>
</head>
<body>
    <div class="page-menu">
        <div id="societe">
            <h1>
                <?php echo $_SESSION['nom']; ?>
            </h1>
        </div>
        <div class="main-menu-element <?php if($page === "dashboard/dashboard.php" || strpos($page, "dashboard/") !== false) echo "active-link"; ?>">
            <a href="./page.php?page=dashboard/dashboard">
                <p> 
                    <i class="fas fa-home"> </i>
                    <label for=""> Dashboard </label>
                </p>
            </a>
        </div>
        <div class="main-menu-element <?php if($page === "societe/info.php" || strpos($page, "societe/") !== false) echo "active"; ?>">
                <a href="./page.php?page=societe/info">
                    <p> 
                        <i class="fas fa-user"> </i> 
                        <label for=""> Société </label>
                    </p>
                </a>
        </div>
        <div class="main-menu-element">
            <a href="./page.php?page=dashboard/menu_analytique">
                <p> 
                    <i class="fas fa-chart-bar"> </i>
                    <label for=""> Analytique </label>
                </p>
            </a>
        </div>
        <div class="main-menu-element">
            <a href="./page.php?page=dashboard/menu_general">
                <p> 
                    <i class="fas fa-wallet"> </i>
                    <label for=""> Général </label>
                </p>
            </a>
        </div>
        <div class="main-menu-element">
            <a href="./page.php?page=factures/liste_factures">
                <p> 
                    <i class="fas fa-receipt"> </i>
                    <label for=""> Facture </label>
                </p>
            </a>
        </div>
        <div class="main-menu-element">
            <a href="./page.php?page=dashboard/menu_general">
                <p> 
                    <i class="fas fa-weight-hanging"> </i>
                    <label for=""> Charges supplétives </label>
                </p>
            </a>
        </div>
        <div class="main-menu-element">
            <a href="./deconnexion.php">
                <p> 
                    <i class="fas fa-sign-out-alt"> </i>
                    <label for=""> Déconnecter </label>
                </p>
            </a>
        </div>
    </div>
    <div class="page-content">
        <?php
            include($page);
        ?>
    </div>
    <div class="footer" style="height: 200px"> </div>
    <script src="../assets/js/jquery.js"> </script>
    <script src="../assets/js/parsley.js"> </script>
</body>
</html>