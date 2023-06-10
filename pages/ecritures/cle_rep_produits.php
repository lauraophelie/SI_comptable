<?php 
    require_once("../inc/ecritures/fonctions.php");
    require_once("../inc/produit/fonctions.php");

    $societe  = $_SESSION['nom'];
    $compte_6 = $_GET['compte'];
    $id_societe = find_societe($societe);

    $produits = findAll();
    $charge = get_last_charge($id_societe['id'], $compte_6);
    $cle_repartition = get_cle_compte_6_produit($compte_6);
?>

<h1 id="main-title"> 
    <?php echo $charge['numero_compte']." : ".$charge['compte']; ?> 
</h1>

<div style="height:150px"> </div>

<h2 style="padding-left: 55px"> 
    Montant : <?php echo number_format($charge['montant'], 0, ' ', ' '); ?>
</h2>

<div style="height:25px"> </div>

<table width="800px" id="table_cle">
    <?php if($cle_repartition) {
        foreach($cle_repartition as $cle) { ?>
            <tr>
                <th>
                    <?php echo $cle['produit']; ?>
                </th>
                <td>
                    <input type="text" name="<?php echo "produit".$cle["produit_id"]; ?>" id="<?php echo "produit".$cle["produit_id"]; ?> " class="in produits"
                        value="<?php if($cle['cle']) echo $cle['cle']; ?>">
                </td>
                <td>
                    <input type="text" name="<?php echo "fixe".$cle["produit_id"]; ?>" id="<?php echo "fixe".$cle["produit_id"]; ?> " placeholder="Fixe %"
                        value="<?php if($cle['fixe']) echo $cle['fixe']; ?>" class="in fixes">
                </td>
                <td>
                    <input type="text" name="<?php echo "variable".$cle["produit_id"]; ?>" id="<?php echo "variable".$cle["produit_id"]; ?> " placeholder="Variable %"
                        value="<?php if($cle['variable']) echo $cle['variable']; ?>" class="in variables">
                </td>
            </tr>
    <?php } } else { 
        foreach($produits as $produit) { ?>
            <tr>
                <th>
                    <?php echo $produit['designation']; ?>
                </th>
                <td>
                    <input type="text" class="in produits">
                </td>
                <td>
                    <input type="text" placeholder="Fixe %" class="in fixes">
                </td>
                <td>
                    <input type="text" placeholder="Variable %" class="in variables">
                </td>
            </tr>
    <?php } } ?>
</table>

<button id="valider_ecriture" style="margin-left: 25%" type=button onclick="envoyerCleProduit()"> Valider </button>

<script>
    const inputs = document.getElementsByClassName("in");

    for(let i = 0; i < inputs.length; i++) {
        let input = inputs[i];
        input.style.height = "30px";
        input.style.border = "1px solid transparent";
    }

    const table = document.getElementById("table_cle");
    table.style.marginLeft = "45px";

    function envoyerCleProduit() {

        const compte_6      = <?php echo $charge['numero_compte']; ?>;

        const ids_produit   = [];

        const produits      = document.getElementsByClassName("produits");
        const fixes         = document.getElementsByClassName("fixes");
        const variables     = document.getElementsByClassName("variables");

        const rows = [];
        var j = 1;

        for(let i = 0; i < produits.length; i++) {
            let id_produit  = j;
            let produit     = produits[i].value;
            let fixe        = fixes[i].value;
            let variable    = variables[i].value;

            let row         = {
                id_produit:     id_produit,
                produit:        produit,
                fixe:           fixe,
                variable:       variable
            }
            rows.push(row);
            j++;
        }
        console.log(rows);

        const data = {
            compte_6:   compte_6,
            cles:       rows
        };
        console.log(data);

        $.ajax({
            type: "GET",
            url: "../inc/ecritures/traitement_cles_produits.php",
            data: data,
            success: function(response) {
                alert(response);
                window.location.href = "./page.php?page=ecriture/cle_repartitions&compte=" + compte_6;
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite lors de l'envoi des données : " + error);
            }
        });
    }
</script>