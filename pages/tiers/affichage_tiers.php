<?php
    require("../inc/tiers/fonctions.php");
    $num_page = $_GET['num_page'];
    $total = 10;
    $count = ($num_page - 1) * $total;

    $all_tiers = find_all();
    $tiers = findAllPagination($count, $total);
?>
    <h1 id="main-title"> Compte tiers </h1>

    <a href="./page.php?page=tiers/tiers">
        <button id="button-add"> Ajouter un tiers </button>
    </a>
    
    <div class="search_section">
        <input type="text" name="recherche_tiers" id="recherche_tiers" placeholder="Rechercher un compte tiers" style="margin-left: -16%"/> 
        <button type="submit">
            <i class="fas fa-search"> </i>
        </button>
    </div>

    <?php 
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
        if(isset($_GET['erreur'])) {
            echo '<p style="color: red">'.$_GET['erreur'].'</p>';
        }
        if(isset($_GET['message'])) {
            echo '<p style="color: green">'.$_GET['message'].'</p>';
        }
        if(empty($tiers)) {
    ?>
        <p class="empty-pan" style="margin-top: 15%"> Aucun compte tiers disponible pour le moment </p>
    <?php } else { ?>
        <table id="pcg_table">
            <tr id="data-title">
                <th> Type </th>
                <th> Numéro </th>
                <th> Intitulé </th>
                <th> </th>
            </tr>
            <?php foreach($tiers as $tier) { ?>
                <tr id="data-line">
                    <td> <?php echo $tier['type_tiers']; ?> </td>
                    <td> <?php echo $tier['numero']; ?> </td>
                    <td> <?php echo $tier['designation']; ?> </td>
                    <td>
                        <a href="./page.php?page=tiers/modif_tiers&id=<?php echo $tier['id'] ?>">
                            <i class="fas fa-pen"> </i>
                        </a>
                    </td>
                    <td>
                        <a href="../inc/tiers/traitement_delete&id=<?php echo $tier['id'];?>&num=<?php echo $tier['numero']; ?>">
                            <i class="fas fa-trash-alt"> </i>
                        </a>
                    </td>
                </tr>
    <?php } } ?>
    </table>
    <div class="pagination">
        <?php
            $total = 10;
            $limite = count($all_tiers) / $total;
            $n = ceil($limite);
            for($i = 1; $i <= $n; $i++) { ?>
                <a href="./page.php?page=tiers/affichage_tiers&num_page=<?php echo $i; ?>" class="<?php if($num_page == $i) echo "active" ?>"> 
                    <?php echo $i; ?>
                </a>
        <?php } ?>
    </div>