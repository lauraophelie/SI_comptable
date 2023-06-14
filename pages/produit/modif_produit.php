<?php
    require("../inc/produit/fonctions.php");
    $id = $_GET['id'];
    $produit = findByNum($id);
    $unite = getAllUnite();
?>
    <form action="../inc/produit/traitement_modif.php" method="post" data-parsley-validate="" id="form1">
        <h1> Modifier le produit : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" value="<?php echo $id ?>" name="id" hidden>

        <label for="designation"> produit : </label>
        <input type="text" name="designation" value="<?php echo $produit['designation']; ?>" required="">

        <label for="designation"> prix Unitaire : </label>
        <input type="number" name="prix" value="<?php echo $produit['prix_unitaire']; ?>" required="">

        <label for="designation">Unite d'oeuvre :</label>
        <select id="unite" name="unite" required >
            <?php foreach($unite as $unites) { ?>
                <option value="<?php echo $unites['designation']; ?>"> <?php echo $unites['designation']; ?> </option>
            <?php } ?>
        </select>

        <button type="submit" id="modif-button"> Modifier </button>
    </form>