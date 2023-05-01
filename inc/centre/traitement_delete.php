<?php
    include("./fonctions.php");
    $id = $_GET['id'];
    $delete = delete($id);
   
        if($delete == true) {
            header('Location: ../../pages/centre/affichage_centre.php?message=Le centre a ete supprime avec succes !');
            exit();
        } else {
            header("Location: ../../pages/centre/affichage_centre.php?erreur=Une erreur s'est produite lors de la suppression du compte !");
            exit();
        }
    
?>