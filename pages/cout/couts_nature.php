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
    <h2> Ar <?php echo number_format($couts_nature['fixe'], 0, ' ', ' '); ?> </h2>
</div>
<div class="case_couts"> 
    <p> Coûts variable </p>
    <h2> Ar <?php echo number_format($couts_nature['variable'], 0, ' ', ' '); ?> </h2>
</div>