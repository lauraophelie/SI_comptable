<?php 
    require_once("../inc/unite_oeuvre/fonctions.php");
    $unites = find_all_uo();
?>
<h1 id="main-title"> Liste des unites </h1>

    <a href="./page.php?page=unite/form_insert">
        <button id="button-add"> Ajouter un unité </button>
    </a>

    <?php 
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
        if(isset($_GET['message'])) {
            echo '<p style="color: green">'.$_GET['message'].'</p>';
        }
        if(empty($unites)) {
    ?>
        <p class="empty-pan" style="margin-top: 15%"> 
            Aucune unité d'oeuvre disponible pour le moment 
        </p>
    <?php } else { ?>
        <table id="pcg_table">
            <tr id="data-title">
                <th> ID </th>
                <th> Désignation </th>
                <th> </th>
            </tr>
            <?php foreach($unites as $unite) { ?>
                <tr id="data-line">
                    <td> <?php echo $unite['id']; ?> </td>
                    <td> <?php echo $unite['designation']; ?> </td>
                    <td>
                        <a href="modif_unite.php?id=<?php echo $unite['id']; ?>">
                            <i class="fas fa-pen"> </i>
                        </a>
                    </td>
                    <td>
                        <a href="../../inc/unite/traitement_delete.php?id=<?php echo $unite['id']; ?>">
                            <i class="fas fa-trash-alt"> </i>
                        </a>
                    </td>
                </tr>
    <?php } } ?>
    </table>
    