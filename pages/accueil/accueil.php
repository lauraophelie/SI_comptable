<?php
    session_start();
    $nom = $_SESSION['nom'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accueil/accueil_style.css">
    <link rel="stylesheet" href="../../assets/icons/fontawesome-5/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Page d'acceuil </title>
</head>
<body>
    <div class="landing-header">
        <h1>
            <?php echo $nom; ?>
        </h1>
    </div>

    <div class="landing-search">
        <input type="text" name="recherche" id="landing-search" placeholder="Effectuez une recherche"/>
        <button>
            <i class="fas fa-search"> </i>
        </button>
    </div>

    <div id="ligne-vide"> </div>

    <div class="landing-content">

        <div class="landing-content-box">
            <h1> Informations sur la société </h1>
        </div>

        <a href="../page.php?page=pcg/affichage_pcg&num_page=1">
            <div class="landing-content-box">
                <h1> Plan Comptable </h1>
            </div>
        </a>

        <a href="../page.php?page=journal/affichage_journaux">
            <div class="landing-content-box">
                <h1> Journaux </h1>
            </div>
        </a>

        <a href="../page.php?page=ecritures/listes_ecritures&societe=<?php echo $nom; ?>">
            <div class="landing-content-box">
                <h1> Ecritures </h1>
            </div>
        </a>

        <div class="landing-content-box">
            <h1> Grand livre </h1>
        </div>

        <div class="landing-content-box">
            <h1> Balance </h1>
        </div>

        <div class="landing-content-box">
            <h1> Devise(s) </h1>
        </div>

    </div>
</body>
</html>