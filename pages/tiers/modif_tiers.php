<?php
    require("../../inc/tiers/fonction.php");
    $tiers = getTiers();
    $id = $_GET['id'];
    $modif = findByNum($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/parsley.css">
    <title> modifier tiers  </title>
</head>
<body>
    <h2>Modifier le comptes</h2>
    <form action="../../inc/tiers/traitement_modif.php" method="post" data-parsley-validate="">
        <p>
            <input type="text" value="<?php echo $id ?>" name="id" hidden>
        </p>
        <p> Numero de comptes : 
            <select name="num" required="">
                <?php for($i=0;$i<count($tiers);$i++) { ?> 
                    <option value="<?php echo $tiers[$i]['num']; ?>"><?php echo $tiers[$i]['num']; ?></option>
                <?php } ?>
            </select>
        </p>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <p> Designation : 
            <input type="text" name="designation" data-parsley-maxlength="13" value="<?php echo $modif['numero']; ?>"
            data-parsley-maxlength-message="Le nombre de caractères ne doit pas dépasser 13" required="">
        </p>
        <p>
            <button type="submit"> MODIFIER </button>
        </p>
    </form>
    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
</body>