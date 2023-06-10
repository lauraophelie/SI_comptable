<?php
    include_once("./fonctions.php");

    $societe_nom    = $_GET['societe_nom'];
    $code_journal   = $_GET['code_journal'];
    $ecritures      = $_GET['ecritures'];
    
    $unite_oeuvre   = $_GET['unite_oeuvre'];
    $nombre         = $_GET['nombre'];
    $nature         = $_GET['nature'];
    $montant        = $_GET['montant'];
    $compte_6       = $_GET['compte_6'];

    $date_ecriture  = $_GET['date_ecriture'];
    $numero_piece   = $_GET['numero_piece'];

    $id_societe = find_societe($societe_nom);

    $success = true;
    foreach ($ecritures as $ecriture) {
        $date               = $ecriture['date'];
        $numero_piece       = $ecriture['numero_piece'];
        $cg                 = $ecriture['cg'];
        $ct                 = $ecriture['ct'];
        $libelle            = $ecriture['libelle'];
        $debit              = $ecriture['debit'];
        $credit             = $ecriture['credit'];
        $devise             = $ecriture['devise'];
        $montant_devise     = $ecriture['montant_devise'];
        $taux               = $ecriture['taux'];
        
        $insert             = save_ecriture($code_journal, $id_societe['id'], $date, $numero_piece, $cg, $ct, $libelle, $debit, $credit, $devise, $montant_devise, $taux);

        if($insert == false) {
            $success = false;
            break;
        }
    }
    if($success) {
        $insert_2 = save_ecritures_charges($id_societe['id'], $date_ecriture, $numero_piece, $compte_6, " ", $unite_oeuvre, $nombre, $montant);
        
        $n1 = false;
        $n2 = false;
        
        if($nature == "inc") {
            $n1 = true;
            $n2 = false;
        } else if($nature == "ninc")  {
            $n2 = true;
            $n1 = false;
        }
        $nat = get_nature_compte_6($compte_6);
        if($nat == false) {
            $n = insert_nature_compte_6($compte_6, $n1, $n2);
        }

        if($insert_2) {
            echo "Les écritures ont été insérées avec succès dans la base de données.";
        }
    } else {
        echo "Une erreur s'est produite lors de l'insertion des écritures.";
    }
?>
