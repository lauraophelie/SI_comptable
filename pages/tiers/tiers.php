<?php
    require("../../inc/tiers/fonction.php");
    $tiers = getTiers();
    $max_length_message = "Le nombre de caractères ne doit pas dépasser 13";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/parsley.css">
    <title> Comptes tiers  </title>
</head>
<body>
    <form action="../../inc/tiers/traitement_insert.php" method="post" data-parsley-validate="">
        <p> Numéro : 
            <select name="num" required="">
                <?php foreach($tiers as $tier) { ?> 
                    <option value="<?php echo $tier['num']; ?>"> 
                        <?php echo $tier['num']; ?> 
                    </option>
                <?php } ?>
            </select>
        </p>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <p> Désignation : 
            <input type="text" name="designation" data-parsley-maxlength="13" data-parsley-maxlength-message="<?php echo $max_length_message; ?>" required="">
        </p>
        <p>
            <button type="submit"> Ajouter </button>
        </p>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>
</html>