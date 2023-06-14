<?php
    require_once("../inc/factures/fonctions.php");
    require_once("../inc/tiers/fonctions.php");
    $factures = liste_factures();
    $tiers = find_all();
?>

<h1 id="main-title"> Liste des factures </h1>

    <a href="./page.php?page=factures/insert_facture">
        <button id="button-add"> Créer une facture </button>
    </a>

    <div style="height: 75"> </div>

    <form action="" method="post" id="recherche_facture">
        <select name="client" id="client" style="width: 100px">
            <?php foreach($tiers as $tier) { ?>
                <option value="<?php echo $tier['id']; ?>">
                    <?php echo $tier['numero']; ?> 
                </option>
            <?php } ?>
        </select>
    </form>

    <?php 
        if(empty($factures)) {
    ?>
        <p class="empty-pan" style="margin-top: 15%"> 
            Aucune facture n'est disponible pour le moment 
        </p>
    <?php } else { ?>
        <table id="pcg_table">
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
                    <td> 
                        <?php echo $facture['id']; ?>
                    </td>
                    <td> 
                        <?php echo $facture['date_fact']; ?>
                    </td>
                    <td> 
                        <?php echo $facture['reference']; ?>
                    </td>
                    <td> 
                        <?php echo $facture['nom_tiers']; ?>
                    </td>
                    <td> 
                        <?php echo $facture['tva']; ?>
                    </td>
                    <td> 
                        <?php echo $facture['total_ttc']; ?>
                    </td>
                    <td> 
                        <?php echo $facture['avance']; ?>
                    </td>
                    <td> 
                        <?php echo $facture['net_a_payer']; ?>
                    </td>
                    <td> </td>
                </tr>
            <?php } } ?>
    </table>
    