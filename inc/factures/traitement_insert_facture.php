<?php
    require_once("./fonctions.php");
    header('Content-Type: text/html; charset=utf-8');

    $sessionData = json_decode($_POST['data'], true);
    $dataArray = json_decode($sessionData, true);

    $id_facture = $dataArray['id'];
    $client = $dataArray['client']['id_client'];
    $reference = $dataArray['reference'];
    $objet = $dataArray['objet'];
    $produits = $dataArray['produits'];
    $total_tva = $dataArray['total_tva'];
    $total_ht = $dataArray['total_ht'];
    $total_ttc = $dataArray['total_ttc'];
    $avance = $dataArray['avance'];
    $net_payer = $dataArray['net_payer'];
    $tva = $dataArray['tva'];
    $date_facture = $dataArray['date_facture'];
    $societe = 1;

    $insert_facture = insert_facture($id_facture, $date_facture, $societe, $client, $total_ttc, $tva, $reference, $objet, $avance, $net_payer);
    echo "facture : ".$insert_facture;
    if($insert_facture) {
        $ecriture = generer_ecriture($societe, $date_ecriture, $id_facture, $objet, $client, $total_ht, $total_tva, $total_ttc);
        if($ecriture) {
            echo "Facture enregistrée";
        }
    }
?>
