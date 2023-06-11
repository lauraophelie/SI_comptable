<?php 
    require_once("../inc/ecritures/fonctions.php");
    require_once("../inc/seuil_de_rentabilite/fonctions.php");

    $produits = get_all_produit();

    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $societe_id = $societe['id'];
    $societe_compta = find_societe_comptabilite($societe_id);

    $date_debut = $societe_compta['date_debut_exercice'];
    $date_fin_exercice = $societe_compta['date_fin_exercice'];
?>

<h1 id="main-title"> Seuil de rentabilité </h1>

<div style="height: 150px"> </div>

        <form id="seuil" class="form-inline" data-parsley-validate="" method="post">
            <label for="num_compte"> Produit : </label>
            <select name="produit" id="prod" style="border: none; margin-top: -2px; width: 200px">
                <?php foreach ($produits as $produit) { ?>
                    <option value="<?php echo $produit['id']; ?>"> 
                        <?php echo $produit['designation']; ?> 
                    </option>
                <?php } ?>
            </select>
            <input type="text" name="prix" id="" placeholder="Prix" style="width: 200px; margin-top: 0px; margin-left: 15px">
            <input type="submit" value="Valider" style="margin-left: 10px; margin-top: -1px; height: 40px">
        </form>

<div style="height: 25px"> </div>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $produit = $_POST['produit'];
        $prix = $_POST['prix'];
        $seuil = getSeuil($societe_id, $produit, $prix);
?>
    <table class="ecriture_table">
        <tr class="total_case">
            <th class="centre_designation">
                Produit 
            </th>
            <td class="case-somme">
                <?php echo number_format($seuil, 0, ' ', ' '); ?>
            </td>
        </tr>
    </table>

<?php } else { ?>
    <center>
        <p> Veuillez choisir un produit </p>
    </center>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#seuil').parsley();
    });
</script>