<h1 id="main-title"> Tableau de bord </h1>

<div style="height: 125px"> </div>

<div class="header-board-element">
    <div class="board-element-content">
        <p> Résultat </p>
        <h2> Résultat </h2>
    </div>
    <div class="board-element-content">
        <p> Seuil de rentabilité </p>
        <h2> Seuil </h2>
    </div>
    <div class="board-element-content">

    </div>
    <div class="board-element-content">

    </div>
</div>

<div class="header-board-charts">
    <div class="board-element-chart">
        <div style="height: 25px"> </div>
        <canvas id="chart-one" style="width: 85%; height: 5px: margin-top: 25px; margin-left: 5px;"> </canvas>
    </div>
    <div class="board-element-case">

    </div>
    <div class="board-element-case">
        
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
                borderColor: "#3e95cd",
                fill: false
            },
            {
                label: 'Produit',
                data:  [300,700,2000,5000,6000,10000,2000,1000,200,100, 100, 100, 100],
                borderColor: "lightblue",
                fill: false
            }
        ]
    }

    const config = {
        type: 'line',
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