<?php
    require("../../inc/pcg/fonctions.php");
    $comptes = find_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Plan comptable de la société </title>
</head>
<body>
    <h1> Plan comptable général </h1>
    <table>
        <tr>
            <th> N° de compte </th>
            <th> Désignation </th>
        </tr>
        <?php foreach($comptes as $compte) { ?>
            <tr>
                <td> <?php echo $compte['numero']; ?> </td>
                <td> <?php echo $compte['designation']; ?> </td>
            </tr>
        <?php } ?>
    </table>
    <a href="./ajout_pcg.php"> Ajouter un compte </a>
    <a href="./export_pcg.php"> Exporter </a>
</body>
</html>