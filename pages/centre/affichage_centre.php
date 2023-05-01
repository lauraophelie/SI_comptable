<?php
    require("../../inc/centre/fonctions.php");
    $centres = findAll();
?>
    <h1 id="main-title"> Tous les centres</h1>

    <a href="form_insert.php">
        <button id="button-add"> Ajouter un centre </button>
    </a>

    <?php 
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
        if(isset($_GET['message'])) {
            echo '<p style="color: green">'.$_GET['message'].'</p>';
        }
        if(empty($centres)) {
    ?>
        <p class="empty-pan" style="margin-top: 15%"> Aucun centre disponible pour le moment </p>
    <?php } else { ?>
        <table id="pcg_table">
            <tr id="data-title">
                <th> ID </th>
                <th> Designation </th>
                <th> </th>
            </tr>
            <?php foreach($centres as $centre) { ?>
                <tr id="data-line">
                    <td> <?php echo $centre['id']; ?> </td>
                    <td> <?php echo $centre['designation']; ?> </td>
                    <td>
                        <a href="modif_centre.php?id=<?php echo $centre['id']; ?>">
                            <i class="fas fa-pen"> </i>
                        </a>
                    </td>
                    <td>
                        <a href="../../inc/centre/traitement_delete.php?id=<?php echo $centre['id']; ?> ">
                            <i class="fas fa-trash-alt"> </i>
                        </a>
                    </td>
                </tr>
    <?php } } ?>
    </table>
    