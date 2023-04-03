<?php
    require("../inc/journal/fonctions.php");
    require("../inc/ecritures/fonctions.php");

    $journaux = find_all();
    $societe = $_SESSION['nom'];
    $id_societe = find_societe($societe);
    $compta = find_societe_comptabilite($id_societe['id']);
?>
    <h1 id="main-title"> Ecritures </h1>

    <div style="height:85px"> </div>

    <?php foreach($journaux as $journal) { ?>
        <h2 id="journal-title"> 
            <?php echo $journal['designation']; ?>
        </h2>
        <?php 
            $ecritures = get_recent_ecritures($journal['id'], $id_societe['id'], $compta['date_debut_exercice'], $compta['date_fin_exercice'], null);
            if(empty($ecritures)) { ?>
                <p class="empty-pan"> Aucune disponible écriture pour le moment </p>
        <?php } else { ?>
        <table class="ecriture_table">
            <tr id="ecriture-title">
                <th class="titre"> Date </th>
                <th class="titre"> N° de pièce </th>
                <th class="titre"> Compte général </th>
                <th class="titre"> Compte tiers </th>
                <th class="libelle"> Libellé </th>
                <th class="titre-montant"> Débit </th>
                <th class="titre-montant"> Crédit </th>
            </tr>
            <?php 
                foreach($ecritures as $ecriture) { ?>
                    <tr id="ecriture_line">
                        <td class="case-date"> <?php echo $ecriture['date_ecriture']; ?> </td>
                        <td class="case-num"> <?php echo $ecriture['numero_piece']; ?> </td>
                        <td class="case-compte"> <?php echo $ecriture['compte_general']; ?> </td>
                        <td class="case-compte"> <?php echo $ecriture['compte_tiers']; ?> </td>
                        <td class="libelle"> <?php echo $ecriture['libelle']; ?> </td>
                        <td class="case-montant"> <?php echo number_format($ecriture['debit'], 0, ' ', ' '); ?> </td>
                        <td class="case-montant"> <?php echo number_format($ecriture['credit'], 0, ' ', ' '); ?> </td>
                    </tr>
            <?php } 
                $sum_debit = get_sum_debit_journal($journal['id'], $id_societe['id'], $compta['date_debut_exercice'], $compta['date_fin_exercice']);
                $sum_credit = get_sum_credit_journal($journal['id'], $id_societe['id'], $compta['date_debut_exercice'], $compta['date_fin_exercice']);
            ?>
        </table>
        <p id="button-range">
            <a href="./page.php?page=ecritures/ecriture&societe=<?php echo $societe; ?>&id_societe=<?php echo $id_societe['id']; ?>&journal=<?php echo $journal['id']; ?>&designation=<?php echo $journal['designation']; ?>"> 
                <button id="new-ecriture"> Nouvelle écriture </button>
            </a>
            <a href="">
                <button id="see-ecritures"> 
                    Voir toutes les écritures 
                    <i class="fas fa-arrow-right"> </i>
                </button>
            </a>
        </p>
    <?php } } ?>