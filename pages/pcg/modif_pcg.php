<?php
    require("../../inc/pcg/fonctions.php");
    $compte = $_GET['compte'];
    $modif = find_by_compte($compte);

    $max_length = "Le nombre de caractères ne doit pas dépasser 5";
    $min_length = "Le nombre de caractères doit être égal à 5";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/parsley.css">
    <title> PCG - Modification </title>
</head>
<body>
    <form action="../../inc/pcg/traitement_update.php" method="post" data-parsley-validate="">
        <h1> Modifier le compte : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" name="id" value="<?php echo $compte; ?>" hidden/>
        <p>
            <label for="numero"> N° de compte : </label>
            <input type="text" name="numero" value="<?php echo $modif['numero']; ?>" required="" 
            data-parsley-maxlength="5" data-parsley-maxlength-message="<?php echo $max_length; ?>"
            data-parsley-minlength="5" data-parsley-minlength-message="<?php echo $min_length; ?>"/>
        </p>
        <p>
            <label for="designation"> Désignation du compte : </label>
            <input type="text" name="designation" value="<?php echo $modif['designation']; ?>" required=""/>
        </p>
        <p>
            <button type="submit"> Modifier </button>
        </p>
    </form>

    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>