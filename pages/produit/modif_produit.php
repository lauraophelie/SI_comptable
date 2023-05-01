<?php
    require("../../inc/produit/fonctions.php");
    $id = $_GET['id'];
    $produit = findByNum($id);
?>
    <form action="../../inc/produit/traitement_modif.php" method="post" data-parsley-validate="" id="form1">
        <h1> Modifier le produit : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" value="<?php echo $id ?>" name="id" hidden>

        <label for="designation"> produit : </label>
        <input type="text" name="designation" value="<?php echo $produit['designation']; ?>" required="">
        <button type="submit" id="modif-button"> Modifier </button>
    </form>