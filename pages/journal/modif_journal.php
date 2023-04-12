<?php
    require("../inc/journal/fonctions.php");
    $journal = $_GET['journal'];
    $modif = find_by_code($journal);
?>
<form action="../inc/journal/traitement_update.php" method="post" data-parsley-validate="" id="form1">
        <h1> Modifier le journal : </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        <input type="text" name="id" value="<?php echo $journal; ?>" hidden/>
            <label for="numero"> Code du journal : </label>
            <input type="text" name="code" value="<?php echo $modif['id']; ?>" required=""/>

            <label for="designation"> Signification : </label>
            <input type="text" name="designation" value="<?php echo $modif['designation']; ?>" required=""/>
        
            <button type="submit" id="modif-button"> Modifier </button>     
</form>