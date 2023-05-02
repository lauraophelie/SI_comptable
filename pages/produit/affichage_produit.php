<?php
    require("../inc/produit/fonctions.php");
    $produits = findAll();
?>
    <h1 id="main-title"> Liste des produits </h1>

    <a href="form_insert.php">
        <button id="button-add"> Ajouter un produit </button>
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
        <p class="empty-pan" style="margin-top: 15%"> Aucun produit disponible pour le moment </p>
    <?php } else { ?>
        <table id="pcg_table">
            <tr id="data-title">
                <th> ID </th>
                <th> Désignation </th>
                <th> </th>
            </tr>
            <?php foreach($produits as $produit) { ?>
                <tr id="data-line">
                    <td> <?php echo $produit['id']; ?> </td>
                    <td> <?php echo $produit['designation']; ?> </td>
                    <td>
                        <a href="modif_produit.php?id=<?php echo $produit['id']; ?>">
                            <i class="fas fa-pen"> </i>
                        </a>
                    </td>
                    <td>
                        <a href="../../inc/produit/traitement_delete.php?id=<?php echo $produit['id']; ?>">
                            <i class="fas fa-trash-alt"> </i>
                        </a>
                    </td>
                </tr>
    <?php } } ?>
    </table>
    