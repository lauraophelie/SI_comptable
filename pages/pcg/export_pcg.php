<?php
    include("../../inc/pcg/fonctions.php");
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
    <form action="../../inc/pcg/traitement_export.php" method="post">
        <h1> Exporter : </h1>
        <p>
            <label for="nom"> Nom du fichier : </label>
            <input type="text" name="nom_fichier"/>
        </p>
        <p>
            <label for="type"> Type du fichier : </label>
            <select name="type_fichier">
                <?php for($i = 0; $i < count($types_fichiers); $i++) { ?>
                    <option value="<?php echo $types_fichiers[$i]['type']; ?>"> <?php echo $types_fichiers[$i]['libelle']; ?> </option>
                <?php } ?>
            </select>
        </p>
        <button type="submit"> Exporter le fichier </button>
    </form>
</body>
</html>