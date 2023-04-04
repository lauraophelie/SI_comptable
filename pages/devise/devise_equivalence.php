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
    <form action="../../inc/devise/insert.php" method="post" data-parsley-validate="">
        <h1> Ajouter un compte </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
            <p>
                <label for="devise"> Nom de la devise : </label>
                <input type="text" name="devise" required="" />
            </p>
            <p>
                <label for="taux"> Taux de la devise : </label>
                <input type="text" name="taux" required=""/>
            </p>
            <button type="submit"> Ajouter </button>
    </form>
