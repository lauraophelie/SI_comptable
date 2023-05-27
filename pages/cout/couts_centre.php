<?php 
    require_once("../inc/ecritures/fonctions.php");
    $centres = get_all_centre();

    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $societe_id = $societe['id'];
    $societe_compta = find_societe_comptabilite($societe_id);

    $date_debut = $societe_compta['date_debut_exercice'];
    $date_fin_exercice = $societe_compta['date_fin_exercice'];
?>

<h1 id="main-title"> Coûts par centre </h1>

<div style="height: 150px"> </div>

        <form id="cout" class="form-inline" data-parsley-validate="" method="post">
            <label for="num_compte"> Centre : </label>
            <select name="centre" id="centre" style="border: none; margin-top: -2px; width: 200px">
                <?php foreach ($centres as $centre) { ?>
                    <option value="<?php echo $centre['id']; ?>"> 
                        <?php echo $centre['designation']; ?> 
                    </option>
                <?php } ?>
            </select>
            <input type="submit" value="Valider" style="margin-left: 25px">
        </form>

<div style="height: 25px"> </div>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $centre = $_POST['centre'];
        $couts = cout_par_centre($centre, $date_debut, $date_fin_exercice);
?>

<h2> Total : Centre <?php echo $couts['centre']; ?> </h2>

    <table class="ecriture_table">
        <tr id = "ecriture-title">
            <th class="titre-montant"> Fixe </th>
            <th class="titre-montant"> Variable </th>
        </tr>
        <tr class="total_case" style="height: 50px">
            <td class="case-somme">
                Ar <?php echo number_format($couts['fixe'], 0, ' ', ' '); ?>
            </td>
            <td class="case-somme">
                Ar <?php echo number_format($couts['variable'], 0, ' ', ' '); ?>
            </td>
        </tr>
    </table>

<?php } else { ?>
    <center>
        <p> Veuillez choisir un centre </p>
    </center>
<?php } ?>

<script src="../../assets/js/jquery.js"> </script>
<script src="../../assets/js/parsley.js"> </script>
<script src="./ecritures/js/script.js"> </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#cout').parsley();
    });
</script>
