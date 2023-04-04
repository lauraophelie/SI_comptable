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
    <form action="../../inc/societe/traitement.php" method="post" data-parsley-validate="">
        <h1> S'inscrire : </h1>
            <p> Nom de la société : 
                <input type="text" name="nom" placeholder="Ecrivez ici" required="">
            </p>
            <p> Objet de la société : 
                <input type="text" name="objet" placeholder="Ecrivez ici" required="">
            </p>
            <p> Date de création : 
                <input type="date" name="date_creation" required="">
            </p>
            <p> Mot de passe : 
                <input type="password" name="mot_de_passe" placeholder="Ecrivez ici" required="">
            </p>
            <p>
                <button type="submit"> S'inscrire </button>
            </p>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>