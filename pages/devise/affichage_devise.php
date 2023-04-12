<?php
    require("../inc/devise/fonctions.php");
    $taux_recents = find_all_recent_taux();
?>

<h1 id="main-title"> Devises </h1>

<div style="height: 125px"> </div>

    <form id="compte" class="form-inline" data-parsley-validate="" method="post" action="../inc/devise/traitement_insert.php">
        <label for="devise" style="padding-top: 20px" required=""> Devise : </label>
        <input type="text" name="devise" style="width:150px">

        <label for="taux" style="padding-top: 20px"> Taux : </label>
        <input type="text" name="taux" style="width:150px" required="">

        <input type="submit" value="Ajouter" style="width:150px; margin-top: 25px">
    </form>

<div style="height: 45px"> </div>

<table id="pcg_table">
    <tr id="data-title">
        <th> ID </th>
        <th> Désignation </th>
        <th> Taux </th>
        <th> Date </th>
        <th> Mettre à jour </th>
    </tr>
    <?php foreach($taux_recents as $taux_recent) { ?>
        <tr id="data-line" data-devise="<?php echo $taux_recent['devise']; ?>">
            <td> <?php echo $taux_recent['devise']; ?> </td>
            <td> <?php echo $taux_recent['designation']; ?> </td>
            <td> <?php echo $taux_recent['taux']; ?> </td>
            <td> <?php echo $taux_recent['date_taux']; ?> </td>
            <td> 
                <a href="./page.php?page=devise/maj_taux_devise&devise=<?php echo $taux_recent['devise']; ?>&date_taux=<?php echo $taux_recent['date_taux']; ?>">
                    <i class="fas fa-pen open-button"> </i>
                </a>
            </td>
        </tr>
    <?php } ?>
</table>