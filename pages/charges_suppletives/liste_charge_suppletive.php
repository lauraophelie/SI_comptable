<?php
    require("../inc/charges_suppletives/fonctions.php");
    if(isset($_SESSION['id_societe'])){
    $charges_suppletives = findAllChargeSuppletif($_SESSION['id_societe']);
?>
    <h1 id="main-title"> Tous les charges supplétives </h1>

    <a href="./page.php?page=charge_suppletives/new_charge_suppletive">
        <button id="button-add"> Ajouter une charge suppletive </button>
    </a>

    <?php 
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
        if(isset($_GET['message'])) {
            echo '<p style="color: green">'.$_GET['message'].'</p>';
        }
        if(empty($produits)) {
    ?>
        <p class="empty-pan" style="margin-top: 15%"> Aucune charge supplétive disponible pour le moment </p>
    <?php } else { ?>
        <table id="pcg_table">
            <tr id="data-title">
                <th> ID </th>
                <th> Désignation </th>
                <th> </th>
            </tr>
            <?php foreach($charges_suppletives as $charge) { ?>
                <tr id="data-line">
                    <td> <?php echo $charge['id']; ?> </td>
                    <td> <?php echo $charge['designation']; ?> </td>
                    <td>
                        <a href="./page.php?page=modif_charge_suppletive&id=<?php echo $charge['id']; ?>">
                            <i class="fas fa-pen"> </i>
                        </a>
                    </td>
                    <td>
                        <a href="../../inc/charge_suppletives/traitement_delete.php?id=<?php echo $charge['id']; ?>">
                            <i class="fas fa-trash-alt"> </i>
                        </a>
                    </td>
                </tr>
    <?php } } ?>
    </table>
    <?php } ?>