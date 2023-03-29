<?php
    require("../../inc/journal/fonctions.php");
    $journal = $_GET['journal'];
    $modif = find_by_code($journal);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Journal - Modification de journal </title>
</head>
<body>
<form action="../../inc/journal/traitement_update.php" method="post" data-parsley-validate="">
        <h1> Modifier le journal : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" name="id" value="<?php echo $journal; ?>" hidden/>
        <p>
            <label for="numero"> Code du journal : </label>
            <input type="text" name="code" value="<?php echo $modif['id']; ?>" required=""/>
        </p>
        <p>
            <label for="designation"> Signification : </label>
            <input type="text" name="designation" value="<?php echo $modif['designation']; ?>" required=""/>
        </p>
        <p>
            <button type="submit"> Modifier </button>
        </p>
    </form>

</body>
</html>