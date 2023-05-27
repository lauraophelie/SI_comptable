<?php 
    require_once("../inc/ecritures/fonctions.php");
    $produits = get_all_produit();

    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $societe_id = $societe['id'];
    $societe_compta = find_societe_comptabilite($societe_id);

    $date_debut = $societe_compta['date_debut_exercice'];
    $date_fin_exercice = $societe_compta['date_fin_exercice'];
?>

<h1 id="main-title"> Coûts par produit </h1>

<div style="height: 150px"> </div>

        <form id="cout" class="form-inline" data-parsley-validate="" method="post">
            <label for="num_compte"> Produit : </label>
            <select name="produit" id="prod" style="border: none; margin-top: -2px; width: 200px">
                <?php foreach ($produits as $produit) { ?>
                    <option value="<?php echo $produit['id']; ?>"> 
                        <?php echo $produit['designation']; ?> 
                    </option>
                <?php } ?>
            </select>
            <input type="submit" value="Valider" style="margin-left: 25px">
        </form>

    <div style="height: 25px"> </div>

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $produit = $_POST['produit'];
        $couts = cout_par_produit($produit, $date_debut, $date_fin_exercice);
        $couts_centre = cout_par_centre_produit($produit, $date_debut, $date_fin_exercice);


        $centres = array();
        foreach ($couts_centre as $cout_centre) {
            $centres[] = $cout_centre['centre'];
        }
        $centres_json = json_encode($centres);
?>
    <h2> Total : <?php echo $couts['produit']; ?> </h2>
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

    <h2> Par Centre : </h2>

    <table class="ecriture_table">
        <tr id = "ecriture-title">
            <th> </th>
            <th class="titre-montant"> Fixe </th>
            <th class="titre-montant"> Variable </th>
        </tr>
        <?php foreach($couts_centre as $cout_centre) { ?>
            <tr style="height: 50px">
                <th class="centre_designation">
                    <?php echo $cout_centre['centre']; ?>
                </th>
                <td style="text-align: right" class="valeurs_fixe">
                    Ar <?php echo number_format($cout_centre['fixe'], 0, ' ', ' '); ?>
                </td>
                <td style="text-align: right" class="valeurs_variable">
                    Ar <?php echo number_format($cout_centre['variable'], 0, ' ', ' '); ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <div class="case_chart" style="margin-top: 25px">
        <div class="chart-container">
            <canvas id="chart-cout-fixe" style="width:100%;max-width:600px; margin-top: 25px"> </canvas>
        </div>
        <div class="chart-container">
            <canvas id="chart-cout-variable" style="width:100%;max-width:600px; margin-top: 25px"> </canvas>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"> </script>
    <script>
        const centres = [];
        const fixes = [];
        const variables = [];

        <?php foreach ($couts_centre as $cout_centre) { ?>
            centres.push("<?php echo $cout_centre['centre']; ?>");
            fixes.push("<?php echo $cout_centre['fixe']; ?>");
            variables.push("<?php echo $cout_centre['variable']; ?>");
        <?php } ?>

        const yFixes = fixes.map(fix => parseFloat(fix.replace(/\D/g, '')));
        const yVariables = variables.map(variable => parseFloat(variable.replace(/\D/g, '')));

        const chartHeight = "400px";

        const chartFixes = document.getElementById("chart-cout-fixe");
        chartFixes.style.height = chartHeight;
        chartFixes.style.float = "left";

        const chartVariables = document.getElementById("chart-cout-variable");
        chartVariables.style.height = chartHeight;

        new Chart("chart-cout-fixe", {
            type: "pie",
            data: {
                labels: centres,
                datasets: [{
                    data: yFixes,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Statistiques Coûts Fixes"
                }
            }
        });

        new Chart("chart-cout-variable", {
            type: "doughnut",
            data: {
                labels: centres,
                datasets: [{
                    data: yVariables,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Statistiques Coûts Variables"
                }
            }
        });
    </script>


<?php } else { ?>
    <center>
        <p> Veuillez choisir un produit </p>
    </center>
<?php } ?>

<script src="../../assets/js/jquery.js"> </script>
<script src="../../assets/js/parsley.js"> </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#cout').parsley();
    });
</script>
