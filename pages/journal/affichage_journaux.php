<?php
    require("../../inc/journal/fonctions.php");
    $journaux = find_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Affichage journaux </title>
</head>
<body>
    <h1> Type de journaux : </h1>
    <?php 
        if(isset($_GET['message'])) {
            echo '<p style="color: green">'.$_GET['message'].'</p>';
        }
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
    ?>
    <table>
        <tr>
            <th> Code journal </th>
            <th> Signification </th>
            <th> </th>
            <th> </th>
        </tr>
        <?php foreach($journaux as $journal) { ?>
            <tr>
                <td> <?php echo $journal['id']; ?> </td>
                <td> <?php echo $journal['designation']; ?> </td>
                <td>
                    <a href="./modif_journal.php?journal=<?php echo $journal['id']; ?>"> Modifier </a>
                </td>
                <td>
                    <a href="../../inc/journal/traitement_delete.php?journal=<?php echo $journal['designation']; ?>"> Supprimer </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="./ajout_journal.php"> Ajouter un journal </a>
</body>
</html>