<?php 
    require_once("../inc/ecritures/fonctions.php");
    $compte_6 = $_GET['compte'];
    $cles_repartitions = get_cle_rep_produit_centre($compte_6);
    $produits = get_all_produit();
?>
<h1 id="main-title"> Répartitions </h1>

<div style="height: 125px"> </div>

<table id="pivot-table">
    <thead>
        <tr>
            <th> </th>
            <?php foreach($cles_repartitions as $cle) { ?>
                <th> 
                    <?php echo $cle['centre']; ?>
                </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($produits as $produit) { ?>
            <tr>
                <th> 
                    <?php echo $produit['designation']; ?>
                </th>
                <?php foreach($cles_repartitions as $cle) { ?>
                    <th> 
                        <p>
                            <input type="text" name="<?php echo "centre".$cle['id_centre']."fixe"; ?>" class="input-cle" placeholder="% fixe">
                        </p>
                        <p>
                            <input type="text" name="<?php echo "centre".$cle['id_centre']."variable"; ?>" class="input-cle" placeholder="% variable">
                        </p>
                    </th>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>

<button type="button" id="valider_ecriture" class="valider_cle" style="margin-left: 35%"> Valider </button>

<script>
    var cleInput = document.getElementsByClassName("input-cle");
    for(let i = 0; i < cleInput.length; i++) {
        cleInput[i].style.border = "1px solid transparent";
        cleInput[i].style.height = "25px";
    }

    const table = document.getElementById("pivot-table");
    table.style.width = "100%";
</script>