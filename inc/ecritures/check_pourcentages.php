<?php 
    include_once("./fonctions.php");
    include_once("../produit/fonctions.php");

    if(isset($_GET["compte_6"])) {
        $compte_6 = $_GET["compte_6"];
        $check_result = array(
            "cle_repartition" => get_cle_compte_6_produit($compte_6),
            "produits" => findAll(),
            "nature_compte_6" => get_nature_compte_6($compte_6)
        );
        header("Content-Type: application/json");
        echo json_encode($check_result);
    }
?>