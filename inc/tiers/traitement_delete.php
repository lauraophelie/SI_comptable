<?php
    include("./fonction.php");
    $id = $_GET['id'];
    $num = $_GET['num'];
    $delete = delete($id);
    $verifEcriture = verifEcriture($num);
    if($verifEcriture == true){
        header('Location: ../../pages/tiers/affichage_tiers.php>message=Desole,vous pouvez pas supprimer ce compte');
            exit();
    }else{
        if($delete == true) {
            header('Location: ../../pages/tiers/affichage_tiers.php');
            exit();
        }else{
            header("Location: ../../pages/tiers/affichage_tiers.php?erreur=Une erreur s'est produite lors de la suppression du compte !");
            exit();
        }
    }
?>