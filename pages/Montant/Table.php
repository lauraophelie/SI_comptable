<?php
    include("../../inc/Montant/fonctions.php");
    $produit = getAll();
    $total =0;
    $tva = getTVA();
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Calcul Montant</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>produit</th>
                <th>quantite</th>
                <th>Prix_unitaire</th>
                <th>Montant</th>
            </tr>
            <?php foreach($produit as $produits) { ?>
                <tr>
                    <td><?php echo $product=$produits['produit']; ?></td>
                    <td><?php echo $quantite=$produits['quantite']; ?></td>
                    <th><?php echo $prix=$produits['prix_unitaire']; ?></th>
                    <th><?php echo $HT=montant_HT($quantite,$prix); ?></th>
                </tr>
                <?php $total+=$HT ?>
            <?php } ?>
        </table>
        <p>TOTAL HT=<?php echo $total; ?></p>
        <p>TVA 20%=<?php echo $TVA=calcul_TVA($total,$tva); ?> </p>
        <p>Montant TTC=<?php echo $TTC=calcul_TTC($total,$TVA); ?></p>
        <p>Avance=<?php echo $avance=20000; ?></p>
        <p>Net a payer=<?php echo net_a_payer($TTC,$avance); ?></p>
    </body>
</html>