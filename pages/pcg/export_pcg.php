<?php
    include("../inc/pcg/fonctions.php");
    $types_fichiers = get_all_types();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PCG - Export </title>
</head>
<body>
    <form action="../inc/pcg/traitement_export.php" method="post" id="form_export">
        <h1> Exporter : </h1>

        <label for="nom"> Nom du fichier : </label>
        <input type="text" name="nom_fichier" placeholder="Ecrivez ici"/>

        <label for="type"> Type du fichier : </label>
            <?php for($i = 0; $i < count($types_fichiers); $i++) { ?>
                    <input type="radio" name="type_fichier" id="<?php echo $types_fichiers[$i]['type']; ?>" value="<?php echo $types_fichiers[$i]['type']; ?>"/> 
                    <label for="<?php echo $types_fichiers[$i]['type']; ?>" id="label-type">
                        <?php echo $types_fichiers[$i]['libelle']; ?> 
                    </label>
            <?php } ?>
        <button type="submit" id="export-button"> Exporter le fichier </button>
    </form>
</body>
</html>