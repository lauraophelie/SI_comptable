<?php 
    require_once("../inc/ecritures/fonctions.php");
    require_once("../inc/societe/fonctions.php");

    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $infos_societe = findById($societe['id']);
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
        <p style="margin-left: 125px"> ID Facture </p>
        <p style="margin-left: 475px"> Date : </p>
    </div>
    <div class="facture_info_tiers">
        <div class="info_tiers_box">
            <h3 class="main_title">
                Client : Nom Société 
            </h3>
            <p> Adresse </p>
            <p> Téléphone </p>
            <p> Email </p>
            <p> Responsable </p>
        </div>
    </div>
    <div class="facture_info_ref">
        <p>
            Référence : 
        </p>
        <p>
            Objet : 
        </p>
    </div>
    <div class="facture_content">
        <table>
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
                    TVA
                </td>
                <td>
                    Total HT
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td>
                    TVA %
                </td>
                <td>
                    Valeur TVA
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> Total TTC </td>
                <td>
                    TTC
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> Avance </td>
                <td>
                    Avance 
                </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> Net à payer </td>
                <td>
                    Net à payer 
                </td>
            </tr>
        </table>
    </div>
    <div class="facture_end">
        <p>
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

<script>
    var urlParams = new URLSearchParams(window.location.search);
    var jsonData = urlParams.get("data");
    var factureData = JSON.parse(jsonData);
    console.log(factureData);
</script>