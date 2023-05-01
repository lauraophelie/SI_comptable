
    <form action="../../inc/produit/traitement_insert.php" method="post" data-parsley-validate="">
        <h1> Ajouter un produit </h1>
        <?php 
            if(isset($_GET['error'])) {
                echo '<p style="color: red">'.$_GET['error'].'</p>';
            }
        ?>
        
        <label for="designation"> Designation </label>
        <input type="text" name="designation" required="" placeholder="Ecrivez ici">
      
        <button type="submit" id="add-button"> Ajouter </button>
    </form>

    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>