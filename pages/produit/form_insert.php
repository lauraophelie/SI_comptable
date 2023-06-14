<?php 
    require("../inc/produit/fonctions.php");
    $unite = getAllUnite();
?>
    <form action="../inc/produit/traitement_insert.php" method="post" data-parsley-validate="">
        <h1> Ajouter un produit </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        
        <label for="designation"> Designation </label>
        <input type="text" name="designation" required="" placeholder="Ecrivez ici">

        <label for="designation"> Prix Unitaire </label>
        <input type="number" name="prix" required="" placeholder="Ecrivez ici">

        <label for="designation">Unite d'oeuvre :</label>
        <select id="unite" name="unite" required >
            <?php foreach($unite as $unites) { ?>
                <option value="<?php echo $unites['designation']; ?>"> <?php echo $unites['designation']; ?> </option>
            <?php } ?>
        </select>
      
        <p><button type="submit" id="add-button"> Ajouter </button></p>
    </form>

    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>