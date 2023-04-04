<?php
    $max_length = "Le nombre de caractères ne doit pas dépasser 5";
    $min_length = "Le nombre de caractères doit être égal à 5";
?>

    <form action="../inc/pcg/traitement_insert.php" method="post" id="form1">
        <h1> Ajouter un compte </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
            if(isset($_GET['message'])) {
                echo '<p style="color: green">'.$_GET['message'].'</p>';
            }
        ?>
            <label for="numero"> N° de compte : </label>
            <input type="text" name="numero" required="" placeholder="Ecrirez ici"
                data-parsley-maxlength="5" data-parsley-maxlength-message="<?php echo $max_length; ?>"
                data-parsley-minlength="5" data-parsley-minlength-message="<?php echo $min_length; ?>"/>

            <label for="designation"> Désignation : </label>
            <input type="text" name="designation" required="" placeholder="Ecrivez ici"/>

            <button type="submit" id="add-button"> Ajouter </button>
    </form>

    <form action="../inc/pcg/traitement_upload.php" method="post" enctype="multipart/form-data" id="form2">
        <h1> Importer un fichier : </h1>
        <?php
            if(isset($_GET['upload_error'])) {
                echo '<p style="color: red">'.$_GET['upload_error'].'</p>';
            }
            if(isset($_GET['upload_message'])) {
                echo '<p style="color: green">'.$_GET['upload_message'].'</p>';
            }
        ?>
        <input type="file" name="excel" id="file-input"/>
        <label for="file-input"> 
            <i class="fas fa-upload"> </i> Fichier 
        </label> 

        <button type="submit" id="import-button"> Importer </button>
    </form>

    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
