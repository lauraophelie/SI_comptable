<?php
    require_once("../inc/ecritures/fonctions.php");

    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $societe_id = $societe['id'];
    $societe_compta = find_societe_comptabilite($societe_id);

    $date_debut = $societe_compta['date_debut_exercice'];
    $date_fin_exercice = $societe_compta['date_fin_exercice'];

    $couts_nature = cout_par_nature($date_debut, $date_fin_exercice);
?>

<h1 id="main-title"> Coûts par nature </h1>

<div style="height: 150px"> </div>

<div class="case_couts"> 
    <p> Coûts fixe </p>
    <h2 class="val_cout"> Ar <?php echo number_format($couts_nature['fixe'], 0, ' ', ' '); ?> </h2>
</div>
<div class="case_couts"> 
    <p> Coûts variable </p>
    <h2 class="val_cout"> Ar <?php echo number_format($couts_nature['variable'], 0, ' ', ' '); ?> </h2>
</div>

<div class="case_chart" style="margin-top: 25px">
    <canvas id="chart-cout-nature" style="width:100%;max-width:600px; margin-top: 25px"> </canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"> </script>

<script>
    const valeurs = document.querySelectorAll('.val_cout');
    const yValues = [];

    for(let i = 0; i < valeurs.length; i++) {
        yValues.push(parseFloat(valeurs[i].innerText.split("Ar ")[1].replace(/\s/g, "")));
    }

    const xValues = ["Fixe", "Variable"];

    var barColors = [
        "#242F40",
        "#CCA43B",
    ];

    const chartCouts = document.getElementById("chart-cout-nature");
    chartCouts.style.height = "500px";
    chartCouts.style.margin = "20%";

    new Chart("chart-cout-nature", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
                title: {
                display: true,
                text: "Statitiques"
            }
        }
    });
</script>