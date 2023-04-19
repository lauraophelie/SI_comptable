<?php
    require("../inc/ecritures/fonctions.php");
    require("../inc/bilans/resultat/fonctions.php");
    $nom_societe = $_SESSION['nom'];
    $societe = find_societe($nom_societe);
    $societe_id = $societe['id'];
    $societe_compta = find_societe_comptabilite($societe_id);
    $date_fin_exercice = $societe_compta['date_fin_exercice'];
    $date_debut_exercice = $societe_compta['date_debut_exercice'];

?>

<h1 id="main-title"> Bilan : Résultats </h1>

<div style="height: 125px"> </div>

<div class="info-societe-box">
    <h3> Société : <?php echo $nom_societe; ?> </h3>
    <h3> Adresse : </h3>
    <h3> Capital : <?php echo $societe_compta['capital']; ?> Ar </h3>
    <h3> CIF : </h3>
    <h3> STAT : </h3>
</div>

<div class="bilan-box">
    <h3> COMPTE DE RESULTAT ( par nature ) </h3>
    <h3> Période du <?php echo $date_debut_exercice; ?> Au </h3>
    <h3> Unité monétaire : Ariary </h3>
</div>

<div class="bilan-box-content">
    <table>
        <tr class="passif-line">
            <th> </th>
            <th class="case"> Compte </th>
            <th class="case"> DATE FIN EXERCICE N </th>
        </tr>
        <tr class="passif-line">
            <td> Chiffre d'affaire </td>
            <td> 70 </td>
            <td> Ar  <?php echo $solde1 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,70);?> </td>
        </tr>
        <tr class="passif-line">
            <td> Production stockée </td>
            <td> 71 </td>
            <td> Ar  <?php echo $solde2 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,71);?></td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> I. PRODUCTION DE L'EXERCICE </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde03=($solde1 + $solde2) ?> </th>
        </tr>
        <tr class="passif-line">
            <td> Achats consommés </td>
            <td> 60 </td>
            <td> Ar <?php echo $solde3 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,60);?></td>
        </tr>
        <tr class="passif-line">
            <td> Services extérieurs et autres consommations </td>
            <td> 61 / 62 </td>
            <td> Ar <?php echo $solde0 = soldes2_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,61,62) ?> </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> II. CONSOMMATION DE L'EXERCICE </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde01 = ($solde3+$solde0); ?> </th>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> III. VALEUR AJOUTEE D'EXPLOITATION ( I - II ) </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde02=($solde03-$solde01); ?> </th>
        </tr>
        <tr class="passif-line">
            <td> Charges de personnel </td>
            <td> 64 </td>
            <td> Ar <?php echo $solde7 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,64);?></td>
        </tr>
        <tr class="passif-line">
            <td> Impôts, taxes et versements assimilés </td>
            <td> 63 </td>
            <td> Ar <?php echo $solde8 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,63);?></td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> IV. EXCEDENT BRUT D'EXPLOITATION </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde9 =($solde7 + $solde8 )?></th>
        </tr>
        <tr class="passif-line">
            <td> Autres produits opérationnels </td>
            <td> 75 </td>
            <td> Ar <?php echo $solde10 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,75);?> </td>
        </tr>
        <tr class="passif-line">
            <td> Autres charges opérationnelles </td>
            <td> 65 </td>
            <td> Ar <?php echo $solde11 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,65);?> </td>
        </tr>
        <tr class="passif-line">
            <td> Dotations aux amortissements, aux provisions et pertes de valeur </td>
            <td> 68 </td>
            <td> Ar <?php echo $solde12 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,68);?> </td>
        </tr>
        <tr class="passif-line">
            <td> Reprise sur provisions et pertes de valeurs </td>
            <td> 78 </td>
            <td> Ar <?php echo $solde13 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,78);?> </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> V. RESULTAT OPERATIONNEL </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde14 = ($solde10+$solde11+$solde12+$solde13);?> </th>
        </tr>
        <tr class="passif-line">
            <td> Produits financiers </td>
            <td> 76 </td>
            <td> Ar <?php echo $solde15 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,76);?> </td>
        </tr>
        <tr class="passif-line">
            <td> Charges financières </td>
            <td> 66 </td>
            <td> Ar <?php echo $solde16 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,66);?> </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> VI. RESULTAT FINANCIER </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde17 =($solde15+$solde16); ?> </th>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> VII. RESULTAT AVANT IMPOTS ( V + VI ) </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde18 = ($solde17+$solde14); ?> </th>
        </tr>
        <tr class="passif-line">
            <td> Impôts exigibles sur résultats </td>
            <td> 695 </td>
            <td> Ar <?php echo $solde19 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,695);?> </td>
        </tr>
        <tr class="passif-line">
            <td> Impôts différés ( Variations ) </td>
            <td> 692 </td>
            <td> Ar <?php echo $solde20 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,692);?> </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES PRODUITS DES ACTIVITES ORDINAIRES </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde21=0 ?> </th>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES CHARGES DES ACTIVITES ORDINAIRES </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde22=0 ?> </th>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> VIII. RESULTAT NET DES ACTIVITES ORDINAIRES </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde23=($solde21+$solde22); ?> </th>
        </tr>
        <tr class="passif-line">
            <td> Eléments extraordinaires ( produits ) </td>
            <td> 77 </td>
            <td> Ar <?php echo $solde24 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,77);?> </td>
        </tr>
        <tr class="passif-line">
            <td> Eléments extraordinaires ( charges ) </td>
            <td> 67 </td>
            <td> Ar <?php echo $solde25 = soldes_resultat($societe_id,$date_debut_exercice,$date_fin_exercice,67);?> </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> IX. RESULTAT EXTRAORDINAIRE </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo $solde26=($solde24+$solde25); ?> </th>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> X. RESULTAT NET DE L'EXERCICE </h4>
            </th>
            <th> </th>
            <th> Ar 0 </th>
        </tr>
    </table>
</div>
