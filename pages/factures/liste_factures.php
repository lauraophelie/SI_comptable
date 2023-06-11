<?php
    require_once("../inc/factures/fonctions.php");
    $factures = liste_factures();
?>

<h1 id="main-title"> Liste des factures </h1>

    <a href="./page.php?page=factures/insert_facture">
        <button id="button-add"> Créer une facture </button>
    </a>

    <?php 
        if(empty($factures)) {
    ?>
        <p class="empty-pan" style="margin-top: 15%"> 
            Aucune n'est disponible pour le moment 
        </p>
    <?php } else { ?>
        <table id="pcg_table">ç
            <tr id="data-title">
                <th> ID </th>
                <th> Date </th>
                <th> Référence </th>
                <th> Client </th>
                <th> TVA </th>
                <th> Total TTC </th>
                <th> Avance </th>
                <th> Net à payer </th>
                <th> </th>
            </tr>
            <?php foreach($factures as $facture) { ?>
                <tr id="data-line">
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
    <?php } } ?>
    </table>
    