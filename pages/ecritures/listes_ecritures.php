<?php
    require("../../inc/journal/fonctions.php");
    require("../../inc/ecritures/fonctions.php");

    $journaux = find_all();
    $societe = $_GET['societe'];
    $id_societe = find_societe($societe);
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
        <table border="1">
            <tr>
                <th> Date </th>
                <th> N° de pièce </th>
                <th> Compte général </th>
                <th> Compte tiers </th>
                <th> Libelle </th>
                <th> Débit </th>
                <th> Crédit </th>
            </tr>
            <?php 
                $ecritures = get_all_by_journal($journal['id'], $id_societe['id']);
                foreach($ecritures as $ecriture) { ?>
                    <tr>
                        <td> <?php echo $ecriture['date_ecriture']; ?> </td>
                        <td> <?php echo $ecriture['numero_piece']; ?> </td>
                        <td> <?php echo $ecriture['compte_general']; ?> </td>
                        <td> <?php echo $ecriture['compte_tiers']; ?> </td>
                        <td> <?php echo $ecriture['libelle']; ?> </td>
                        <td> <?php echo $ecriture['debit']; ?> </td>
                        <td> <?php echo $ecriture['credit']; ?> </td>
                    </tr>
            <?php } ?>
        </table>
        <p>
            <a href="./ecriture.php?societe=<?php echo $societe; ?>&id_societe=<?php echo $id_societe['id']; ?>&journal=<?php echo $journal['id']; ?>&designation=<?php echo $journal['designation']; ?>"> Nouvelle écriture </a>
        </p>
    <?php } ?>
</body>
</html>