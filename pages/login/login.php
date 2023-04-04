<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/formulaire.css">
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
            <label for="societe"> Nom de la société : </label>
            <input type="text" name="nom" placeholder="Ecrivez ici" value="<?php if(isset($_GET['nom'])) { echo $_GET['nom']; } ?>" required="">
            <?php
                if(isset($_GET['not_exist'])) {
                    echo '<script>
                        var nameInput = document.querySelector("input[name=\'nom\']");
                        nameInput.classList.add("error");
                    </script>';
                    echo '<p style="color: red">'.$_GET['not_exist'].'</p>';
                }
            ?>
            <label for="password"> Mot de passe : </label>
            <input type="password" name="mdp" placeholder="Ecrivez ici" required="">
            <?php        
                if(isset($_GET['erreur'])) {
                    echo '<script>
                        var passwordInput = document.querySelector("input[name=\'mdp\']");
                        passwordInput.classList.add("error");
                    </script>';
                    echo '<p style="color: red">'.$_GET['erreur'].'</p>';
                }
            ?>
            <button type="submit"> Se connecter </button>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>