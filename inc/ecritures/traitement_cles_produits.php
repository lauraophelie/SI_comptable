<?php 
    include_once("./fonctions.php");

    $compte_6   = $_GET['compte_6'];
    $cles       = $_GET['cles'];

    $reset      = reset_clets_rep_produit($compte_6);

    $success    = true;
    if($reset) {
        foreach($cles as $cle) {
            $compte     = $compte_6;
            $produit    = $cle['id_produit'];
            $total      = $cle['produit'];
            $fixe       = $cle['fixe'];
            $variable   = $cle['variable'];

            $insert     = insert_compte_6_produit($compte, $produit, $total, $fixe, $variable);

            if($insert == false) {
                $success = false;
                break;
            }
        }
    }
    if($success) {
        echo "Insertion terminée";
    } else {
        echo "Une erreur s'est produite lors de l'insertion des clés de répartition";
    }
?>