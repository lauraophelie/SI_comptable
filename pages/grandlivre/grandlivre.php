<?php
    require("../inc/pcg/fonctions.php");
    require("../inc/grand_livre/fonctions.php");
    $societe = $_SESSION['id_societe'];
    $debut = getDebutCompta($societe);
?>

    <h1 id="main-title"> Grand livre </h1>

    <div style="height: 125px"> </div>

        <form id="compte" class="form-inline" data-parsley-validate="" method="post">
            <label for="num_compte"> Numéro de compte : </label>
            <input name="num_compte" id="num_compte" required="" data-parsley-type="digits" data-parsley-length="[5,5]">
            <input type="submit" value="Valider">
        </form>

    <div style="height: 25px"> </div>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $compte = $_POST['num_compte'];
        $ecritures = getGrandLivre($compte, $debut, $societe);
        $total = getTotal($compte, $debut, $societe);
        $pcg = find_by_compte($compte);
?>  
        <h2>
            <?php  echo $pcg['numero']." ".$pcg['designation']; ?>
        </h2>

        <table border="1">
            <?php if(empty($ecritures)) { ?>
                <p class="empty-pan"> Aucune disponible écriture dans ce grand livre pour le moment </p>
            <?php } else { 
                $sum_debit = $total['debit'];
                $sum_credit = $total['credit'];    
            ?>
            <table class="ecriture_table">
                
                <tr id = "ecriture-title">
                    <th> </th>
                    <th class="titre-montant"> Debit </th>
                    <th class="titre-montant"> Credit </th>
                </tr>
                <tr class="total-case">
                    <td></td>
                    <td class="case-somme">
                        <?php echo number_format($sum_debit, 0, ' ', ' '); ?>
                    </td>
                    <td class="case-somme">
                        <?php echo number_format($sum_credit, 0, ' ', ' '); ?>
                    </td>
                </tr>
                <tr class="total-case">
                    <td>Solde</td>
                    <td class="case-somme">
                    <?php
                        if($total['total']<=0){
                            echo number_format(-$total['total'], 0, ' ', ' ');
                        }
                        ?>
                    </td>
                    <td class="case-somme">
                        <?php 
                            if($total['total']>0){
                                echo number_format($total['total'], 0, ' ', ' ');
                            }
                            ?>
                    </td>
                </tr>
            </table>
            
            <br>

            <table class="ecriture_table">
                <tr id="ecriture-title">
                    <th class="titre"> Date </th>
                    <th class="titre"> N° de pièce </th>
                    <th class="titre"> Compte tiers </th>
                    <th class="libelle"> Libellé </th>
                    <th class="titre-montant"> Débit </th>
                    <th class="titre-montant"> Crédit </th>
                </tr>
                <?php foreach($ecritures as $ecriture) { ?>
                    <tr id="ecriture_line">
                        <td class="case-date"> <?php echo $ecriture['date_ecriture']; ?> </td>
                        <td class="case-num"> <?php echo $ecriture['numero_piece']; ?> </td>
                        <td class="case-compte"> <?php echo $ecriture['compte_tiers']; ?> </td>
                        <td class="libelle"> <?php echo $ecriture['libelle']; ?> </td>
                        <td class="case-montant"> <?php echo number_format($ecriture['debit'], 0, ' ', ' '); ?> </td>
                        <td class="case-montant"> <?php echo number_format($ecriture['credit'], 0, ' ', ' '); ?> </td>
                    </tr>
                <?php } } ?>
            </table>
        </table>

    <?php } else { ?>
        <center>
            <p> Veuillez entrer le grand livre que vous souhaitez voir </p>
        </center>
    <?php } ?>

        <script src="../../assets/js/jquery.js"> </script>
        <script src="../../assets/js/parsley.js"> </script>
        <script src="./ecritures/js/script.js"> </script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#compte').parsley();
            });
        </script>