<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/formulaire.css">
    <link rel="stylesheet" href="../../assets/css/parsley.css">
</head>
<body>
    <form action="../../inc/societe/traitement_step3.php" method="post" data-parsley-validate="">
        <h1> S'inscrire : </h1>
            <p> Mot de passe <br/>
                <input type="password" name="mot_de_passe" placeholder="Ecrivez ici" required="" maxlength="15" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['mot_de_passe'])){
                            echo("value='"+$_SESSION['societe']['mot_de_passe']+"'");
                        }
                    }
                ?>>
            </p>
            <p> Confirmer le mot de passe <br/>
                <input type="password" name="re_mot_de_passe" placeholder="Ecrivez ici" required="" maxlength="15" >
            </p>
            <p>
                <button type="submit"> S'inscrire </button>
            </p>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>