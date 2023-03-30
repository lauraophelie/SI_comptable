<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../../inc/login/traitement.php" method="post">
    <?php        
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
    ?>
        <p><input type="text" name="nom" placeholder="societe"></p>
        <?php        
        if(isset($_GET['erreur'])) {
            echo '<p style="color: red">'.$_GET['erreur'].'</p>';
        }
    ?>
        <p><input type="password" name="mdp"></p>
        <p><input type="submit" value="LOGIN"></p>
    </form>
</body>
</html>