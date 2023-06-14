<?php 
    require_once("../inc/ecritures/fonctions.php");
    require_once("../inc/societe/fonctions.php");

    date_default_timezone_set('Indian/Antananarivo');

    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $infos_societe = findById($societe['id']);
    $date_actuelle = date("Y-m-d");
?>

<h1 id="main-title"> Facture </h1>

<div style="height: 150px"> </div>

<div class="container_facture">
    <div class="facture_info_societe">
        <h3 class="main_title">
            <?php echo  $nom_societe; ?>
        </h3>
        <p>
            <?php echo $infos_societe['adresse']; ?>
        </p>
        <p>
            <?php echo $infos_societe['telephone']; ?>
        </p>
        <p>
            <?php echo $infos_societe['mail']; ?>
        </p>
    </div>
    <div class="facture_info_debut">
        <h3 class="main_title">
            Facture
        </h3>
        <p style="margin-left: 125px" id="id_facture"> ID Facture </p>
        <p style="margin-left: 475px" id="date_facture"> 
            
        </p>
    </div>
    <div class="facture_info_tiers">
        <div class="info_tiers_box">
            <h3 class="main_title" id="soc_client">
                Client : Nom Société 
            </h3>
            <p id="ad_client"> Adresse </p>
            <p id="tel_client"> Téléphone </p>
            <p id="mail_client"> Email </p>
            <p id="res_client"> Responsable </p>
        </div>
    </div>
    <div class="facture_info_ref">
        <p id="ref_facture">
            Référence : 
        </p>
        <p id="objet_facture">
            Objet : 
        </p>
    </div>
    <div class="facture_content">
        <table id="table_fac_affichage">
            <tr>
                <th> Désignation </th>
                <th> Unité </th>
                <th> Quantité </th>
                <th> Prix Unitaire </th>
                <th> Montant </th>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td>
                    Total
                </td>
                <td>
                    Total HT
                </td>
                <td id="ht">
                    Total HT
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> TVA </td>
                <td id="pourcentage_tva">
                    TVA %
                </td>
                <td id="tva">
                    Valeur TVA
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> Total TTC </td>
                <td id="ttc">
                    TTC
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> Avance </td>
                <td id="avance">
                    Avance 
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> Net à payer </td>
                <td id="nap">
                    Net à payer 
                </td>
            </tr>
        </table>
    </div>
    <div class="facture_end">
        <p id="fac_end">
            Arrêté la présente facture à la somme de TTC Ar
        </p>
        <h3 style="margin-left: 125px">
            <?php echo $nom_societe; ?>
        </h3>
        <h3 style="margin-left: 475px"> Le Client </h3>
    </div>
</div>

<div class="facture_button">
    <button id="annuler_facture"> Annuler </button>
    <button id="modif_facture"> Modifier </button>
    <button id="valider_facture"> Valider </button>
</div>

<script src="../assets/js/jquery.js"> </script>
<script>
    var urlParams = new URLSearchParams(window.location.search);
    var jsonData = urlParams.get("data");
    var factureData = JSON.parse(jsonData);
    console.log(factureData);

    var avance = 0;
    if(factureData.avance === '') {
        avance = 0;
    } else {
        avance = parseInt(factureData.avance);
    }

    const data = {
        client: parseInt(factureData.client),
        avance: avance,
        reference: factureData.reference,
        objet: factureData.objet,
        produits: factureData.produits
    }
    $(document).ready(function() {
        var donnees = data;
        $.ajax({
            url: "../inc/factures/traitement_affichage_facture.php",
            method: "POST",
            data: { data: JSON.stringify(donnees) },
            success: function(response) {
                var facture = JSON.parse(response);
                var client = facture.client;
                var produits = facture.produits;
                var total_tva = facture.total_tva;
                var total_ht = facture.total_ht;
                var total_ttc = facture.total_ttc;
                var avance = facture.avance;
                var net_payer = facture.net_payer;
                var tva = facture.tva;
                var date_facture = facture.date_facture;
                var ref_facture = facture.reference;
                var objet_facture = facture.objet;

                console.log(facture);
                sessionStorage.setItem('factureData', JSON.stringify(response));

                var sessionData = sessionStorage.getItem('factureData');
                console.log(sessionData);

                document.getElementById('tva').innerHTML = 'Ar ' + total_tva.toLocaleString('fr-FR', { useGrouping: true, minimumFractionDigits: 0 });
                document.getElementById('ttc').innerHTML = 'Ar ' + total_ttc. toLocaleString('fr-FR', { useGrouping: true, minimumFractionDigits: 0 });
                document.getElementById('ht').innerHTML = 'Ar ' + total_ht.toLocaleString('fr-FR', { useGrouping: true, minimumFractionDigits: 0 });
                document.getElementById('avance').innerHTML = 'Ar ' + avance.toLocaleString('fr-FR', { useGrouping: true, minimumFractionDigits: 0 });
                document.getElementById('nap').innerHTML = 'Ar ' + net_payer.toLocaleString('fr-FR', { useGrouping: true, minimumFractionDigits: 0 });

                document.getElementById('pourcentage_tva').innerHTML = tva + ' %';
                document.getElementById('date_facture').innerHTML = 'Date : ' + date_facture;
                document.getElementById('ref_facture').innerHTML = 'Référence : ' + ref_facture;
                document.getElementById('objet_facture').innerHTML = 'Objet : ' + objet_facture;
                document.getElementById('fac_end').innerHTML = 'Arrêté la présente facture à la somme de ' + total_ttc + ' Ar';


                document.getElementById('tva').style.textAlign = "right";
                document.getElementById('ttc').style.textAlign = "right";
                document.getElementById('ht').style.textAlign = "right";
                document.getElementById('avance').style.textAlign = "right";
                document.getElementById('nap').style.textAlign = "right";

                document.getElementById('soc_client').innerHTML = "Client : " + client.societe;
                document.getElementById('ad_client').innerHTML = "Adresse : " + client.adresse;
                document.getElementById('tel_client').innerHTML = "Téléphone : " + client.telephone;
                document.getElementById('mail_client').innerHTML = "Email : " + client.mail;
                document.getElementById('res_client').innerHTML = "Responsable : " + client.responsable;

                document.getElementById('id_facture').innerHTML = facture.id;

                const table = document.getElementById('table_fac_affichage');
                for(let i = 0; i < produits.length; i++) {
                    var newRow = table.insertRow(1);

                    var designationCell = newRow.insertCell(0);
                    designationCell.textContent = produits[i].designation;
                    designationCell.style.textAlign = "center";

                    var uo = newRow.insertCell(1);
                    uo.textContent = produits[i].unite_oeuvre;
                    uo.style.textAlign = "center";

                    var quantityCell = newRow.insertCell(2);
                    quantityCell.style.textAlign = "center";
                    quantityCell.textContent = produits[i].quantite;

                    var prix = newRow.insertCell(3);
                    prix.style.textAlign = "center";
                    prix.textContent = produits[i].prix_unitaire;

                    var ht = newRow.insertCell(4);
                    ht.style.textAlign = "right";
                    ht.textContent = 'Ar ' + produits[i].montant_ht;
                }
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });
    });
    const valider = document.getElementById('valider_facture');
    valider.addEventListener('click', function() {
        let sessionData = sessionStorage.getItem('factureData');

        console.log(sessionData);

        $.ajax({
            url: '../inc/factures/traitement_insert_facture.php',
            method: 'POST',
            data: { data: sessionData },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Erreur lors de l\'envoi des données de session');
            }
        });
    });
</script>