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
    <?php foreach($cle_repartition as $cle) { ?>
        <tr>
            <th>
                <?php echo $cle['produit']; ?>
            </th>
            <td>
                <input type="text" name="<?php echo "produit".$cle["produit_id"]; ?>" id="" class="<?php echo "produit".$cle["produit_id"]; ?> in"
                    value="<?php if($cle['cle']) echo $cle['cle']; ?>">
            </td>
            <td>
                <input type="text" name="<?php echo "fixe".$cle["produit_id"]; ?>" id="" placeholder="Fixe %"
                    value="<?php if($cle['fixe']) echo $cle['fixe']; ?>" class="<?php echo "fixe".$cle["produit_id"]; ?> in">
            </td>
            <td>
                <input type="text" name="<?php echo "variable".$cle["produit_id"]; ?>" id="" placeholder="Variable %"
                    value="<?php if($cle['variable']) echo $cle['variable']; ?>" class="<?php echo "variable".$cle["produit_id"]; ?> in">
            </td>
        </tr>
    <?php } ?>
</table>

<script>
    const inputs = document.getElementsByClassName("in");

    for(let i = 0; i < inputs.length; i++) {
        let input = inputs[i];
        input.style.height = "30px";
        input.style.border = "1px solid transparent";
    }

    const table = document.getElementById("table_cle");
    table.style.marginLeft = "45px";

</script>