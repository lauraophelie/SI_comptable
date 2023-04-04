<?php
    require("../inc/tiers/fonctions.php");
    $tiers = getTiers();
    $id = $_GET['id'];
    $modif = findByNum($id);
?>
    <form action="../../inc/tiers/traitement_modif.php" method="post" data-parsley-validate="" id="form1">
        <h1> Modifier le compte tier : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" value="<?php echo $id ?>" name="id" hidden>
        <label for="numero"> Numéro : </label>
        <input type="text" name="num" id="" value="<?php echo $modif['numero']; ?>">

        <label for="designation"> Intitulé du compte : </label>
        <input type="text" name="designation" data-parsley-maxlength="13" value="<?php echo $modif['designation']; ?>"
        data-parsley-maxlength-message="Le nombre de caractères ne doit pas dépasser 13" required="">

        <button type="submit" id="modif-button"> Modifier </button>
    </form>