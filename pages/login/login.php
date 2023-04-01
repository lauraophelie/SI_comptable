<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/parsley.css">
    <title> Se connecter à un compte  </title>
</head>
<body>
    <form action="../../inc/login/traitement.php" method="post" data-parsley-validate="">
        <h1> Se connecter : </h1>
            <?php        
                if(isset($_GET['error'])) {
                    echo '<p style="color: red">'.$_GET['error'].'</p>';
                }
            ?>
            <p> Nom de la société : 
                <input type="text" name="nom" placeholder="Ecrivez ici" required="">
            </p>
            <?php        
                if(isset($_GET['erreur'])) {
                    echo '<p style="color: red">'.$_GET['erreur'].'</p>';
                }
            ?>
            <p> Mot de passe : 
                <input type="password" name="mdp" placeholder="Ecrivez ici" required="">
            </p>
            <p>
                <button type="submit"> Se connecter </button>
            </p>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>