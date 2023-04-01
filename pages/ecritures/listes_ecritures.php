<?php
    require("../../inc/journal/fonctions.php");
    require("../../inc/ecritures/fonctions.php");

    $journaux = find_all();
    $societe = $_GET['societe'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ecritures </title>
</head>
<body>
    <h1> Ecritures </h1>
    <?php foreach($journaux as $journal) { ?>
        <h2> 
            <?php echo $journal['designation']; ?>
        </h2>
        <p>
            <a href="./ecriture.php?societe=<?php echo $societe; ?>&journal=<?php echo $journal['id']; ?>&designation=<?php echo $journal['designation']; ?>"> Nouvelle écriture </a>
        </p>
    <?php } ?>
</body>
</html>