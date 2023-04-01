<?php
    session_start();
    $nom = $_SESSION['nom'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Page d'acceuil </title>
</head>
<body>
    <h1> Page d'accueil : </h1>
    <p>
        <a href="../pcg/affichage_pcg.php"> PCG </a>
    </p>  
    <p>
        <a href="../journal/affichage_journaux.php"> Journaux </a>
    </p>
    <p>
        <a href="../ecritures/listes_ecritures.php?societe=<?php echo $nom; ?>"> Ecritures </a>
    </p>
</body>
</html>