<?php
    require("../../inc/cout/fonctions.php");
    $libelle = $_GET['libelle'];
    $unite = findAll_unite();
?>
    <form action="../../inc/cout/traitement_unite.php" method="post" data-parsley-validate="" id="form1">
        <h1> Ajouter une unite : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
       

        <label for="designation">libelle : </label>
        <input type="text" name="libelle" value="<?php echo $libelle ?>" required="">
        <label for="designation">unite d oeuvre : </label>
        <select name="unite" id="unite">
            <?php foreach($unite as $unites) { ?>
            <option value="<?php echo $unites['unite']; ?>"><?php echo $unites['unite']; ?></option>
            <?php } ?>
        </select>
        <button type="submit" id="modif-button"> Ajouter </button>
    </form>
