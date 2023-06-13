<?php 
    require_once("../inc/tiers/fonctions.php");
    require_once("../inc/produit/fonctions.php");

    $tiers = find_all();
    $produits = findAll();
?>

<h1 id="main-title"> Générer une facture ( 1 / 2 ) </h1>

<div style="height: 125px"> </div>

<form method="post" data-parsley-validate id="factureForm">
    <label for="client"> Client : </label>
        <select name="client" id="client">
            <?php foreach($tiers as $tier) { ?>
                <option value="<?php echo $tier['id']; ?>">
                    <?php echo $tier['numero']; ?> 
                </option>
            <?php } ?>
        </select>
    <label for="ref"> Référence : </label>
        <input type="text" name="ref" id="ref" placeholder="Ecrivez ici" required="">
    <label for="objet"> Objet : </label>
        <input type="text" name="objet" id="objet" placeholder="Ecrivez ici" required="">
    <label for="produit"> Produit : </label>
        <?php foreach($produits as $produit) { ?>
            <p class="paraProduit">
                <input type="checkbox" name="<?php echo 'produit'.$produit['id']; ?>" value="<?php echo $produit['id']; ?>" id="" style="margin-top: 25px"
                class="produitsFacture"> 
                    <?php echo $produit['designation']; ?>
            </p>
        <?php } ?>
    <label for="avance"> Avance : </label>
        <input type="text" name="avance" id="avance" placeholder="Ecrivez ici">
    <button type="submit" id="add-button"> Suivant </button>
</form>

<script>
    document.getElementById("factureForm").addEventListener("submit", function(e) {
        e.preventDefault();

        console.log("submitting");

        var client = document.getElementById("client").value;
        var ref = document.getElementById("ref").value;
        var objet = document.getElementById("objet").value;
        var avance = document.getElementById("avance").value;

        var produits = document.getElementsByClassName("produitsFacture");
        var designations = document.getElementsByClassName("paraProduit");

        var choixProduits = [];
        var designationsProduit = []; 

        for(let i = 0; i < produits.length; i++) {
            var object = {
                designation: designations[i].textContent.trim(),
                id_produit: parseInt(produits[i].value)
            }
            choixProduits.push(object);
        }

        var facture = {
            client: client,
            reference: ref,
            objet: objet,
            avance: avance,
            produits: choixProduits
        };

        var jsonData = JSON.stringify(facture);
        window.location.href = "./page.php?page=factures/insert_produit_facture&data=" + encodeURIComponent(jsonData);
    });
</script>