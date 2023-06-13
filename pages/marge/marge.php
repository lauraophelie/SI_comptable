<?php
    require("../../inc/ecritures/fonctions.php");
    require("../../inc/bilans/resultat/fonctions.php");

    $societe_id = 1;
    $societe_compta = find_societe_comptabilite($societe_id);
    $date_fin_exercice = $societe_compta['date_fin_exercice'];
    $date_debut_exercice = $societe_compta['date_debut_exercice'];

    $cout_par_nature = cout_par_nature($date_debut_exercice,$date_fin_exercice);

    $chiffre_affaire = solde70($societe_id,$date_debut_exercice,$date_fin_exercice);
    $cout_fixe = $cout_par_nature['fixe'];
    $cout_variable = $cout_par_nature['variable'];
?>

<p>Chiffre d'affaire = <?php echo $chiffre_affaire; ?></p>
<p>cout fixe = <?php echo $cout_fixe?></p>
<p>cout variable = <?php echo $cout_variable ?></p>
<p> marge brute = <?php echo $chiffre_affaire - $cout_variable - $cout_fixe; ?> <p>
<p> marge cout fixe = <?php echo $chiffre_affaire - $cout_fixe; ?> </p>
<p> marge cout variable = <?php echo $chiffre_affaire - $cout_variable; ?> </p>