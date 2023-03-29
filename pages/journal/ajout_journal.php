<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/parsley.css">
    <title> Journal - Ajout </title>
</head>
<body>
    <form action="../../inc/journal/traitement_insert.php" method="post" data-parsley-validate="">
        <h1> Ajouter un journal </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
            if(isset($_GET['message'])) {
                echo '<p style="color: green">'.$_GET['message'].'</p>';
            }
        ?>
            <p>
                <label for="numero"> Code journal : </label>
                <input type="text" name="code" required=""/>
            </p>
            <p>
                <label for="designation"> Signification : </label>
                <input type="text" name="designation" required=""/>
            </p>
            <button type="submit"> Ajouter </button>
    </form>

    <form action="../../inc/journal/traitement_upload.php" method="post" enctype="multipart/form-data">
        <h1> Importer un fichier : </h1>
        <?php
            if(isset($_GET['upload_error'])) {
                echo '<p style="color: red">'.$_GET['upload_error'].'</p>';
            }
            if(isset($_GET['upload_message'])) {
                echo '<p style="color: green">'.$_GET['upload_message'].'</p>';
            }
        ?>
        <p>
            <label for="excel"> Fichier : </label>
            <input type="file" name="excel"/>
        </p>
        <button type="submit"> Importer </button>
    </form>

    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>