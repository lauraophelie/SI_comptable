    <?php
        require("../inc/journal/fonctions.php");
        require("../inc/ecritures/fonctions.php");
        $societe = $_SESSION['nom'];
        $id_societe = find_societe($societe);
    ?>
    <form action="../inc/ecritures/traitement_import.php" method="post" enctype="multipart/form-data" id="form2">
        <h1> Importer un fichier : </h1>
        <?php
            if(isset($_GET['upload_error'])) {
                echo '<p style="color: red">'.$_GET['upload_error'].'</p>';
            }
            if(isset($_GET['upload_message'])) {
                echo '<p style="color: green">'.$_GET['upload_message'].'</p>';
            }
        ?>
        <input type="text" name="journal" id="" value="<?php echo $_GET['journal']; ?>" hidden>
        <input type="text" name="societe" value="<?php echo $id_societe['id']; ?>" hidden>
        <input type="file" name="excel" id="file-input"/>
        <label for="file-input"> 
            <i class="fas fa-upload"> </i> Fichier 
        </label> 

        <button type="submit" id="import-button"> Importer </button>
    </form>