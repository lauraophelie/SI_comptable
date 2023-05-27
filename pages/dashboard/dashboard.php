<?php
    require("../inc/ecritures/fonctions.php");
    require("../inc/bilans/passifs/fonctions.php");

    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $societe_id = $societe['id'];
    $societe_compta = find_societe_comptabilite($societe_id);

    $date_debut = $societe_compta['date_debut_exercice'];
    $date_fin_exercice = $societe_compta['date_fin_exercice'];

    $capitaux_propres = capitaux_propres($societe_id, $date_debut, $date_fin_exercice);
?>

<h1 id="main-title"> Tableau de bord </h1>

<div style="height: 125px"> </div>

<div class="header-board-element">
    <div class="board-element-content resultat-box">
        <p> Résultat </p>
        <h2> Ar <?php echo number_format($capitaux_propres["resultat"], 0, ' ', ' '); ?></h2>
    </div>
    <div class="board-element-content seuil-box">
        <p> Seuil de rentabilité </p>
        <h2> Seuil </h2>
    </div>
    <div class="board-element-content">
        <p> Coût de revient  </p>
        <h2> Revient  </h2>
    </div>
    <div class="board-element-content">
        <p> Chiffre d'affaire </p>
        <h2> CA  </h2>
    </div>
</div>
<div style="height: 5px"> </div>
<div class="header-board-title">
    <h2> Charges et produits par mois </h2>
</div>

<div class="header-board-charts">
    <div class="board-element-chart">
        <div style="height: 25px"> </div>
        <canvas id="chart-one" style="width: 100%; height: 5px: margin-left: 5px;"> </canvas>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    const xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    const data = {
        labels: xValues,
        datasets: [
            {
                label: "Charges",
                data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478, 1001, 1005, 100],
                backgroundColor: "#3e95cd"
            },
            {
                label: 'Produit',
                data:  [300,700,2000,5000,6000,10000,2000,1000,200,100, 100, 100, 100],
                backgroundColor: "lightblue"
            }
        ]
    }

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Produits et Charges',
            }
            }
        },
    };

    new Chart("chart-one", config);

/*Chart("chart-one", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
      borderColor: "lightsalmon",
      fill: false
    }, { 
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
      borderColor: "lightblue",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});*/


</script>