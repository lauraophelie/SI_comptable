<?php
    session_start();

    require("../../inc/pcg/fonctions.php");
    require("../../inc/grand_livre/fonctions.php");
    
    $societe = $_SESSION['id_societe'];
    $debut = getDebutCompta($societe);
    $compte = $_GET['num_compte'];

    $ecritures = getGrandLivre($compte, $debut,$societe);
    $compte = find_all();
    $id_societe = find_societe($societe);
?>

    <p><label for="num_compte"> Numero de compte : </label>
        <input type="number" name="num_compte" id="num_compte">
    </p>
        <h2> 
            <?php echo $journal['designation']; ?>
        </h2>
        <table border="1">
            <tr>
                <th> Date </th>
                <th> N° de pièce </th>
                <th> Compte tiers </th>
                <th> Libelle </th>
                <th> Débit </th>
                <th> Crédit </th>
            </tr>
            <?php foreach($ecritures as $ecriture) { ?>
                    <tr>
                        <td> <?php echo $ecriture['date_ecriture']; ?> </td>
                        <td> <?php echo $ecriture['numero_piece']; ?> </td>
                        <td> <?php echo $ecriture['compte_tiers']; ?> </td>
                        <td> <?php echo $ecriture['libelle']; ?> </td>
                        <td> <?php echo $ecriture['debit']; ?> </td>
                        <td> <?php echo $ecriture['credit']; ?> </td>
                    </tr>
            <?php } ?>
        </table>
        