<?php
    require_once("../ecritures/fonctions.php");
    require_once("../produit/fonctions.php");
    require_once("../montant/fonctions.php");
    require_once("../tiers/Fonction.php");
    date_default_timezone_set('Indian/Antananarivo');
    $date_actuelle = date("Y-m-d");

    if(isset($_POST['data'])) {

        $data = json_decode($_POST['data'], true);

        $client = $data['client'];
        $produits = $data['produits'];
        $avance = $data['avance'];
        $reference = $data['reference'];
        $objet = $data['objet'];

        $search_tiers = findTiersById($client);
        $tva = getTVA();
        $produits_data = array();
        
        $total_ht = 0;

        for($i = 0; $i < count($produits); $i++) {
            $id_produit = $produits[$i]['id_produit'];
            $quantite = $produits[$i]['quantite'];
            $designation = $produits[$i]['designation'];

            $produit = findProduitByNum($id_produit);
            
            $unite_oeuvre = $produit['unite'];
            $prix_unitaire = $produit['prix_unitaire'];
        
            $montant_ht = montant_HT($quantite, $prix_unitaire);
            $total_ht += $montant_ht;
            $produits_data[$i] = array(
                'id_produit' => $id_produit,
                'designation' => $designation,
                'quantite' => $quantite,
                'unite_oeuvre' => $unite_oeuvre,
                'prix_unitaire' => $prix_unitaire,
                'montant_ht' => $montant_ht
            );
        }
        $total_tva = calcul_TVA($total_ht, $tva);
        $total_ttc = calcul_TTC($total_ht, $total_tva);
        $net_payer = net_a_payer($total_ttc, $avance);

        $infos_client = array(
            'id_client' => $client,
            'adresse' => $search_tiers['adresse'],
            'telephone' => $search_tiers['telephone'],
            'mail' => $search_tiers['mail'],
            'responsable' => $search_tiers['numero'],
            'societe' => $search_tiers['societe']
        );

        $facture = array(
            'client' => $infos_client,
            'reference' => $reference,
            'objet' => $objet,
            'produits' => $produits_data,
            'total_tva' => $total_tva,
            'total_ht' => $total_ht,
            'total_ttc' => $total_ttc,
            'avance' => $avance,
            'net_payer' => $net_payer,
            'tva' => $tva,
            'date_facture' => $date_actuelle
        );
        echo json_encode($facture);
    }
?>