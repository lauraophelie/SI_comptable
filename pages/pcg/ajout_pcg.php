<?php
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
    <title> PCG - Ajout de compte </title>
</head>
<body>
    <form action="../../inc/pcg/traitement_insert.php" method="post" data-parsley-validate="">
        <h1> Ajouter un compte </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
            if(isset($_GET['message'])) {
                echo '<p style="color: green">'.$_GET['message'].'</p>';
            }
        ?>
            <p>
                <label for="numero"> N° de compte : </label>
                <input type="text" name="numero" required="" 
                    data-parsley-maxlength="5" data-parsley-maxlength-message="<?php echo $max_length; ?>"
                    data-parsley-minlength="5" data-parsley-minlength-message="<?php echo $min_length; ?>"/>
            </p>
            <p>
                <label for="designation"> Désignation : </label>
                <input type="text" name="designation" required=""/>
            </p>
            <button type="submit"> Ajouter </button>
    </form>

    <h1> Importer un fichier excel : </h1>
    <?php
        if(isset($_GET['upload_error'])) {
            echo '<p style="color: red">'.$_GET['upload_error'].'</p>';
        }
        if(isset($_GET['upload_message'])) {
            echo '<p style="color: green">'.$_GET['upload_message'].'</p>';
        }
    ?>
    <form action="../../inc/pcg/traitement_upload.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="excel"> Fichier excel : </label>
            <input type="file" name="excel"/>
        </p>
        <button type="submit"> Importer </button>
    </form>

    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>