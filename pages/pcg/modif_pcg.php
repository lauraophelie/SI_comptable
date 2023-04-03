<?php
    require("../inc/pcg/fonctions.php");
    $compte = $_GET['compte'];
    $modif = find_by_compte($compte);

    $max_length = "Le nombre de caractères ne doit pas dépasser 5";
    $min_length = "Le nombre de caractères doit être égal à 5";
?>
    <form action="../inc/pcg/traitement_update.php" method="post" data-parsley-validate="" id="form1">
        <h1> Modifier le compte : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" name="id" value="<?php echo $compte; ?>" hidden/>

            <label for="numero"> N° de compte : </label>
            <input type="text" name="numero" value="<?php echo $modif['numero']; ?>" required="" 
            data-parsley-maxlength="5" data-parsley-maxlength-message="<?php echo $max_length; ?>"
            data-parsley-minlength="5" data-parsley-minlength-message="<?php echo $min_length; ?>"/>
        
            <label for="designation"> Désignation du compte : </label>
            <input type="text" name="designation" value="<?php echo $modif['designation']; ?>" required=""/>
        
            <button type="submit" id="modif-button"> Modifier </button>
        
    </form>