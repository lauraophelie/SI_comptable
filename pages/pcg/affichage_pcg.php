<?php
    require("../inc/pcg/fonctions.php");
    $num_page = $_GET['num_page'];
    $total = 10;
    $count = ($num_page - 1) * $total;
    
    $all_comptes = find_all();
    $comptes = find_all_pagination($count, $total);
?>
    <h1 id="main-title"> Plan comptable général </h1>

    <a href="./page.php?page=pcg/ajout_pcg">
        <button id="button-add"> Ajouter un compte </button>
    </a>
    
    <a href="./page.php?page=pcg/export_pcg">
        <button id="button-export"> Exporter le pcg </button>
    </a>

    <form action="../inc/pcg/traitement_recherche.php" method="get">
        <div class="search_section">
            <input type="text" name="recherche_compte" id="recherche_compte" placeholder="Rechercher un compte dans le pcg"/> 
            <button type="submit">
                <i class="fas fa-search"> </i>
            </button>
        </div>
    </form>

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
            <th> N° de compte </th>
            <th> Désignation </th>
            <th> </th>
            <th> </th>
        </tr>
        <?php foreach($comptes as $compte) { ?>
            <tr id="data-line">
                <td> <?php echo $compte['numero']; ?> </td>
                <td> <?php echo $compte['designation']; ?> </td>
                <td>
                    <a href="./page.php?page=pcg/modif_pcg&compte=<?php echo $compte['numero']; ?>"> 
                        <i class="fas fa-pen"> </i>
                    </a>
                </td>
                <td>
                    <a href="../inc/pcg/traitement_delete.php?compte=<?php echo $compte['numero']; ?>">
                        <i class="fas fa-trash-alt"> </i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="pagination">
        <?php
            $limite = count($all_comptes) / $total;
            $n = ceil($limite);
            for($i = 1; $i <= $n; $i++) { ?>
                <a href="./page.php?page=pcg/affichage_pcg&num_page=<?php echo $i; ?>" class="<?php if($num_page == $i) echo "active" ?>"> 
                    <?php echo $i; ?>
                </a>
        <?php } ?>
    </div>
    
