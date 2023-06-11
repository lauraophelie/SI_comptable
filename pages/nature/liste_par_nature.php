<?php
    require("../inc/seuil_de rentabilite/fonctions.php");
    if(isset($_SESSION['id_societe'])){
    $societe = $_SESSION['id_societe'];
    $id_produit = 1;
    $charges_suppletives = getAllChargeSuppl($_SESSION['id_societe'],$id_produit);
    $sum = getSum($societe, $id_produit);
?>
    <h1 id="main-title"> Les coûts par nature </h1>

    <?php 
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
        if(isset($_GET['message'])) {
            echo '<p style="color: green">'.$_GET['message'].'</p>';
        }
    ?>
        <table id="pcg_table">
            <tr id="data-title">
                <th> ID </th>
                <th> Désignation </th>
                <th> Unité </th>
                <th> Fixe</th>
                <th> Variable </th>
                <th> </th>
            </tr>
            
            <?php foreach($charges_suppletives as $charge) { ?>
                <tr id="data-line">
                    <td> <?php echo $charge['id']; ?> </td>
                    <td> <?php echo $charge['designation']; ?> </td>
                    <td> <?php echo $charge['unite']; ?> </td>
                    <td> <?php echo $charge['fixe']; ?> </td>
                    <td> <?php echo $charge['variable']; ?> </td>
                </tr>         
            <?php } ?>
        <tr></tr>   
        <tr>
            <td></td>
            <td></td>
            <td>TOTAL</td>
            <td> <?php echo $sum['fixe']; ?> </td>
            <td> <?php echo $sum['variable']; ?> </td>
        </tr>
    </table>
    <?php } ?>