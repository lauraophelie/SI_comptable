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
    $passifs_courants = passifs_courants($societe_id, $date_debut, $date_fin_exercice);
    $passifs_non_courants = passifs_non_courants($societe_id, $date_debut, $date_fin_exercice);

    $somme_totale = somme_totale($societe_id, $date_debut, $date_fin_exercice);
?>

<h1 id="main-title"> Bilan : Passifs </h1>

<div style="height: 125px"> </div>

<div class="info-societe-box">
    <h3> Société : <?php echo $nom_societe; ?> </h3>
    <h3> Adresse : </h3>
    <h3> Capital : <?php echo $societe_compta['capital']; ?> Ar </h3>
    <h3> CIF : </h3>
    <h3> STAT : </h3>
</div>

<div class="bilan-box">
    <h3> Bilan </h3>
    <h3> EXERCICE CLOS AU : <?php echo $date_fin_exercice; ?> </h3>
    <h3> Unité monétaire : Ariary </h3>
</div>

<div class="bilan-box-content">
    <table>
        <tr class="passif-line">
            <th> </th>
            <th class="case"> Compte </th>
            <th class="case"> Montant </th>
        </tr>
        <tr class="passif-line">
            <th colspan="4"> 
                <h4> CAPITAUX PROPRES </h4>
            </th>
        </tr>
        <tr class="passif-line">
            <td> Capital émis </td>
            <td> 10100 </td>
            <td> Ar <?php echo number_format($capitaux_propres["capital"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Réserves légales </td>
            <td> 10500 </td>
            <td> Ar <?php echo number_format($capitaux_propres["reserves_legales"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Résultat en instance d'affectation </td>
            <td> 12800 </td>
            <td> Ar <?php echo number_format($capitaux_propres["resultat_instance"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Résultat net </td>
            <td> 12000 </td>
            <td> Ar <?php echo number_format($capitaux_propres["resultat"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Autres capitaux propres </td>
            <td> 11000 </td>
            <td> Ar <?php echo number_format($capitaux_propres["autres_capitaux"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES CAPITAUX PROPRES </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo number_format(somme_valeurs($capitaux_propres), 0, ' ', ' '); ?> </th>
        </tr>
        <tr class="passif-line">
            <th colspan="4"> 
                <h4> PASSIFS NON COURANTS </h4>
            </th>
        </tr>
        <tr class="passif-line">
            <td> Impôts différés </td>
            <td> 13000 </td>
            <td> Ar <?php echo number_format($passifs_non_courants["impots_differes"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Emprunts / dettes à LMT part +1 an </td>
            <td> 16100 </td>
            <td> Ar 0 </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES PASSIFS NON COURANTS </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo number_format(somme_valeurs($passifs_non_courants), 0, ' ', ' '); ?> </th>
        </tr>
        <tr class="passif-line">
            <th colspan="4"> 
                <h4> PASSIFS COURANTS </h4>
            </th>
        </tr>
        <tr class="passif-line">
            <td> Emprunts / dettes à LMT part -1 an </td>
            <td> 16100 </td>
            <td> Ar 0 </td>
        </tr>
        <tr class="passif-line">
            <td> Dettes courts termes </td>
            <td> 16500 </td>
            <td> Ar <?php echo number_format($passifs_courants["dettes_court_termes"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Fournisseurs et comptes rattachés </td>
            <td> 40000 </td>
            <td> Ar <?php echo number_format($passifs_courants["fournisseurs"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Avance reçues des clients </td>
            <td> 40000 </td>
            <td> Ar 0 </td>
        </tr>
        <tr class="passif-line">
            <td> Autres dettes </td>
            <td> 40000 </td>
            <td> Ar <?php echo number_format($passifs_courants["autres_dettes"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line">
            <td> Comptes de trésoreries </td>
            <td> 50000 </td>
            <td> Ar <?php echo number_format($passifs_courants["tresorerie"], 0, ' ', ' '); ?> </td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES PASSIFS COURANTS </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo number_format(somme_valeurs($passifs_courants), 0, ' ', ' '); ?> </th>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES CAPITAUX PROPRES ET PASSIFS </h4>
            </th>
            <th> </th>
            <th> Ar <?php echo number_format($somme_totale, 0, ' ', ' '); ?> </th>
        </tr>
    </table>
</div>