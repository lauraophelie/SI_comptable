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
    <form action="../../inc/societe/traitement_step2.php" method="post" data-parsley-validate="">
        <h1> S'inscrire : </h1>
            <p> Capital : <br/>
                <input type="number" name="capital" placeholder="Ecrivez ici" required=""<?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['capital'])){
                            echo("value='"+$_SESSION['societe']['capital']+"'");
                        }
                    }
                ?>>
            </p>
            <p> Début de l'exercice comptable actuel: <br/>
                <input type="date" name="date_debut" placeholder="Ecrivez ici" required="" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['date_debut'])){
                            echo("value='"+$_SESSION['societe']['date_debut']+"'");
                        }
                    }
                ?>>
            </p>
            <p> Devise de tenu de compte : <br/>
                <input type="text" name="devise_tenu" required="" maxlength="10" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['devise_tenu'])){
                            echo("value='"+$_SESSION['societe']['devise_tenu']+"'");
                        }
                    }
                ?>>
            </p>
            <p>
                <button type="submit"> Suivant </button>
            </p>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>