<?php
    require("../inc/devise/fonctions.php");
    $devise = $_GET['devise'];
    $date_taux = $_GET['date_taux'];
    $maj = find_by_devise($devise, $date_taux);
?>

<form action="../inc/devise/traitement_update.php" method="post" data-parsley-validate="" id="form1">
    <h1 style="padding-top: 50px"> Mettre à jour : </h1>

    <input type="text" name="devise" id="" value="<?php echo $devise; ?>" hidden>
    &
    <label for="taux"> Taux : </label>
    <input type="text" name="taux" id="" value="<?php echo $maj['taux']; ?>" required="">

    <label for="date"> Date : </label>
    <input type="date" name="date_taux" id="" value="<?php echo $maj['date_taux']; ?>">

    <button type="submit" id="modif-button"> Mettre à jour </button> 
</form>

