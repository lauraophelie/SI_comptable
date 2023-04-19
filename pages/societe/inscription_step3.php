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
            <p> Numéro d'identification fiscale : (NIF) <br/>
                <input type="text" name="nif" placeholder="Ecrivez ici" required="" maxlength="15" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['nif'])){
                            echo("value='"+$_SESSION['societe']['nif']+"'");
                        }
                    }
                ?>>
                <input type="file" name="scan_nif" class="scan">
            </p>
            <p> Numéro statistique : (NS) <br/>
                <input type="text" name="stat" placeholder="Ecrivez ici" required="" maxlength="15" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['stat'])){
                            echo("value='"+$_SESSION['societe']['stat']+"'");
                        }
                    }
                ?>>
                <input type="file" name="scan_ns" class="scan">
            </p>
            <p> Numéro du Registe de Commerce de la Société: (NRCS) <br/>
                <input type="date" name="date_creation" required="" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['date_creation'])){
                            echo("value='"+$_SESSION['societe']['date_creation']+"'");
                        }
                    }
                ?>>
                <input type="file" name="scan_nrcs" class="scan">
            </p>
            <p> Adresse de la société : 
                <input type="texte" name="adresse" placeholder="Ecrivez ici" required="" <?php
                    if(isset($_SESSION['societe'])){
                        if(isset($_SESSION['societe']['nom_societe'])){
                            echo("value='"+$_SESSION['societe']['nom_societe']+"'");
                        }
                    }
                ?>>
            </p>
            <p>
                <button type="submit"> S'inscrire </button>
            </p>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>