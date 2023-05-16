<?php
    session_start();
    $nom = $_SESSION['nom'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accueil/accueil_style.css">
    <link rel="stylesheet" href="../../assets/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../assets/icons/fontawesome-5/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Page d'acceuil </title>
</head>
<body>
    <div class="header-board">
        <div class="header-board-logo">
            <h1> 
                <?php echo $nom; ?>
            </h1>
        </div>
        <div class="header-board-search">

        </div>
        <div class="header-board-nav">
            <nav>
                <a href="">
                    Compta. Générale
                </a>
                <a href="">
                    Compta. Analytique
                </a>
                <a href="">
                    Se déconnecter
                </a>
            </nav>
        </div>
    </div>
    <div class="board-content">
        <div class="board-box">
            <div class="board-box-element">

            </div>
            <div class="board-box-element">

            </div>
            <div class="board-box-element">

            </div>
            <div class="board-box-element">
                
            </div>
        </div>
        <div class="board-chart-one">
            <canvas id="chart-one" style="width:100%; max-width: 850px; height: 100%, max-height: 650px"> </canvas>
        </div>
    </div>
</body>
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
</html>