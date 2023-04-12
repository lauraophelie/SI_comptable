<?php
    include("./fonctions.php");

    $societe_nom = $_GET['societe_nom'];
    $code_journal = $_GET['code_journal'];
    $ecritures = $_GET['ecritures'];	

    $id_societe = find_societe($societe_nom);

    foreach ($ecritures as $ecriture) {

        $date = $ecriture['date'];
        $numero_piece = $ecriture['numero_piece'];
        $cg = $ecriture['cg'];
        $ct = $ecriture['ct'];
        $libelle = $ecriture['libelle'];
        $debit = $ecriture['debit'];
        $credit = $ecriture['credit'];
        $devise = $ecriture['devise'];
        $montant_devise = $ecriture['montant_devise'];
        $taux = $ecriture['taux'];
        
        $insert = save_ecriture($code_journal, $id_societe['id'], $date, $numero_piece, $cg, $ct, $libelle, $debit, $credit, $devise, $montant_devise, $taux);
        if($insert == true) {
            echo "Les écritures ont été insérées avec succès dans la base de données.";
            exit();
        } else {
            echo "Une erreur s'est produite";
        }
    }
?>