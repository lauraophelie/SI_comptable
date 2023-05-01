<?php
    require("../../inc/centre/fonctions.php");
    $id = $_GET['id'];
    $centre = findByNum($id);
?>
    <form action="../../inc/centre/traitement_modif.php" method="post" data-parsley-validate="" id="form1">
        <h1> Modifier le centre : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" value="<?php echo $id ?>" name="id" hidden>

        <label for="designation"> centre : </label>
        <input type="text" name="designation" value="<?php echo $centre['designation']; ?>" required="">
        <button type="submit" id="modif-button"> Modifier </button>
    </form>