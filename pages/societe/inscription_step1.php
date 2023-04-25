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
    <form action="../../inc/societe/traitement_step1.php" method="post" data-parsley-validate="">
        <h1> S'inscrire : </h1>
            <p> Nom de la société : <br/>
                <input type="text" name="nom_societe" placeholder="Ecrivez ici" required=""<?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['nom_societe'])){
                            echo("value='"+$_SESSION['societe']['nom_societe']+"'");
                        }
                    }
                ?>>
            </p>
            <p> Objet de la société : <br/>
                <input type="text" name="objet" placeholder="Ecrivez ici" required="" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['objet'])){
                            echo("value='"+$_SESSION['societe']['objet']+"'");
                        }
                    }
                ?>>
            </p>
            <p> Date de création : <br/>
                <input type="date" name="date_creation" required="" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['date_creation'])){
                            echo("value='"+$_SESSION['societe']['date_creation']+"'");
                        }
                    }
                ?>>
            </p>
            <p> Adresse de la société : <br/>
                <input type="texte" name="adresse" placeholder="Ecrivez ici" required="" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['nom_societe'])){
                            echo("value='"+$_SESSION['societe']['nom_societe']+"'");
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