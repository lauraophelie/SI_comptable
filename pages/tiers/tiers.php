<?php
    require("../inc/tiers/fonctions.php");
    $tiers = getTiers();
    $max_length_message = "Le nombre de caractères ne doit pas dépasser 13";
?>
    <form action="../inc/tiers/traitement_insert.php" method="post" data-parsley-validate="">
        <h1> Ajouter un compte tiers </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <label for="type"> Type de tiers : </label>

        <input type="radio" name="type_tiers" id="FO" value="FO"/>
        <label for="FO" id="label-type" style="width: 190px; text-align:center"> Fournisseur </label>

        <input type="radio" name="type_tiers" id="CL" value="CL"/>
        <label for="CL" id="label-type" style="width: 190px; text-align:center; margin-left: 25px"> Client </label>

        <label for="num"> Numéro : </label> 
        <input type="text" name="num" id="" required="" data-parsley-maxlength="13" data-parsley-maxlength-message="<?php echo $max_length_message; ?>" placeholder="Ecrivez ici">
        
        <label for="designation"> Désignation </label>
        <input type="text" name="designation" required="" placeholder="Ecrivez ici">
      
        <button type="submit" id="add-button"> Ajouter </button>
    </form>