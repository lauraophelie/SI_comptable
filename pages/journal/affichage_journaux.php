<?php
    require("../inc/journal/fonctions.php");
    $journaux = find_all();
?>
    <h1 id="main-title"> Type de journaux : </h1>

    <a href="./page.php?page=journal/ajout_journal">
        <button id="button-add"> Ajouter un journal </button>
    </a> 
    <div class="search_section">
        <input type="text" name="recherche_journal" id="recherche_compte" placeholder="Rechercher un code journal " style="margin-left: -20%"/> 
        <button type="submit">
            <i class="fas fa-search"> </i>
        </button>
    </div>
    <?php 
        if(isset($_GET['message'])) {
            echo '<p style="color: green; padding-top: 20px; padding-left: 60px">'.$_GET['message'].'</p>';
        }
        if(isset($_GET['error'])) {
            echo '<p style="color: red; padding-top: 20px; padding-left: 60px">'.$_GET['error'].'</p>';
        }
    ?>
    <table id="pcg_table">
        <tr id="data-title">
            <th> Code journal </th>
            <th> Signification </th>
            <th> </th>
            <th> </th>
        </tr>
        <?php foreach($journaux as $journal) { ?>
            <tr id="data-line">
                <td> <?php echo $journal['id']; ?> </td>
                <td> <?php echo $journal['designation']; ?> </td>
                <td>
                    <a href="./page.php?page=journal/modif_journal&journal=<?php echo $journal['id']; ?>">
                        <i class="fas fa-pen"> </i>
                    </a>
                </td>
                <td>
                    <a href="../inc/journal/traitement_delete.php?journal=<?php echo $journal['designation']; ?>">
                        <i class="fas fa-trash-alt"> </i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>