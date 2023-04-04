
    <form action="../inc/journal/traitement_insert.php" method="post" data-parsley-validate="" id="form1">
        <h1> Ajouter un journal </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
            if(isset($_GET['message'])) {
                echo '<p style="color: green">'.$_GET['message'].'</p>';
            }
        ?>
            <p>
                <label for="numero"> Code journal : </label>
                <input type="text" name="code" required="" placeholder="Ecrivez ici"/>
            </p>
            <p>
                <label for="designation"> Signification : </label>
                <input type="text" name="designation" required="" placeholder="Ecrivez ici"/>
            </p>
            <button type="submit" id="add-button"> Ajouter </button>
    </form>

    <form action="../inc/journal/traitement_upload.php" method="post" enctype="multipart/form-data" id="form2">
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