    <?php
        require("../inc/balance/fonctions.php");
        $societe = $_SESSION['id_societe'];
        $debut = getDebutCompta($societe);
        $result_grandlivre = getAllSolde($debut,$societe);
        $balance = treatmentSolde($result_grandlivre);
    ?>
    <h1 id="main-title"> Balance </h1>

    <div style="height:175px"> </div>

    <?php if(empty($result_grandlivre)) { ?>
        <p class="empty-pan"> Il n'y a pas de solde du grand livre à inscrire dans la balance </p>
    <?php } else { ?>
    <table class="ecriture_table">
        <tr id="ecriture-title">
            <th class="titre"> Compte </th>
            <th class="titre"> Designation </th>
            <th class="titre"> Débit </th>
            <th class="titre"> Crédit </th>
        </tr>
        <?php foreach($result_grandlivre as $ecriture) { ?>
            <tr id="ecriture_line">
                <td class="case-compte"> <?php echo $ecriture['numero']; ?> </td>
                <td class="libelle"> <?php echo $ecriture['designation']; ?> </td>
                <td class="case-montant"> <?php echo number_format($ecriture['deb'], 0, ' ', ' '); ?> </td>
                <td class="case-montant"> <?php echo number_format($ecriture['cred'], 0, ' ', ' '); ?> </td>
            </tr>
        <?php } ?>
    </table>
    <?php } ?>
