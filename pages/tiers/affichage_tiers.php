<?php
    require("../../inc/tiers/fonction.php");
    $tiers = find_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> tiers </title>
</head>
<body>
    <?php 
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
        if(isset($_GET['erreur'])) {
            echo '<p style="color: red">'.$_GET['erreur'].'</p>';
        }
        if(isset($_GET['message'])) {
            echo '<p style="color: red">'.$_GET['message'].'</p>';
        }
    ?>
    <table>
        <tr>
            <th> N° de compte </th>
            <th> Désignation </th>
            <th> </th>
            <th> </th>
        </tr>
        <?php for($i=0;$i<count($tiers);$i++) { ?>
            <tr>
                <td> <?php echo $tiers[$i]['numero']; ?> </td>
                <td> <?php echo $tiers[$i]['designation']; ?> </td>
                <td>
                    <a href="./modif_tiers.php?id=<?php echo $tiers[$i]['id'] ?>"> Modifier </a>
                </td>
                <td>
                    <a href="../../inc/tiers/traitement_delete.php?id=<?php echo $tiers[$i]['id'];?>&num=<?php echo $tiers[$i]['numero']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <p>
        <a href="../tiers/tiers.php"> Ajouter un compte </a>
    </p>
</body>
</html>