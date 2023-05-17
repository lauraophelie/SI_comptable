<?php
    require("../../inc/cout/fonctions.php");
    $couts = findAll();
    $centre = get_all_centre();
?>
    <h1 id="main-title"> Liste des couts par centre </h1>


    <?php 
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
        if(isset($_GET['message'])) {
            echo '<p style="color: green">'.$_GET['message'].'</p>';
        }
        if(empty($couts)) {
    ?>
        <p class="empty-pan" style="margin-top: 15%"> Aucun cout disponible pour le moment </p>
    <?php } else { ?>
        <table border="1">
            <tr>
                <th rowspan="2">compte</th>
                <th rowspan="2">rubrique</th>
                <th rowspan="2">total</th>
                <th rowspan="2">unite</th>
                <th colspan="4">Nature</th>
                <?php foreach($centre as $centres) { ?>
                    <th colspan="3">
                        <?php echo $nom_centre=$centres['designation']; ?>
                    </th>
                <?php } ?>
            <tr>
                <th> % </th>
                <th>Variable</th>
                <th> % </th>
                <th>fixe</th>
                <?php for($j=0;$j<count($centre);$j++){ ?>
                    <th>%</th>
                    <th>Variable</th>
                    <th>fixe</th>
                <?php } ?>
            <tr> 
            <?php foreach($couts as $cout) { ?>
                <tr id="data-line">
                    <td> <?php echo $compte=$cout['compte_general']; ?> </td>
                    <td> <?php echo $cout['libelle']; ?> </td>
                    <td> <?php echo $debit=$cout['debit'] ?>Ar</td>
                    <td> <?php 
                            $unite = find_unite_compte_6($cout['libelle']);
                            if(empty($unite)){ ?>
                                <a href="ajout_unite.php?libelle=<?php echo $cout['libelle'] ?>">
                                    ajouter une unite
                                </a>
                            <?php
                            }else{
                                foreach($unite as $unites) {
                                    echo $unites['unite'];
                                }
                            }
                        ?>
                    </td>

                    <td><?php 
                        $pourcentage_variable_compte_6=get_pourcentage_variable_compte6($compte);
                        if(empty($pourcentage_variable_compte_6)){
                            echo 0;
                        }else{
                            echo $pourcentage_variable_compte_6;
                        }
                        ?>%
                    </td>

                    <td> <?php  $valeur_variable_compte6=$debit*(get_pourcentage_variable_compte6($compte)/100);
                        if(empty($valeur_variable_compte6)){
                            echo 0;
                        }else{
                            echo $valeur_variable_compte6;
                        }
                    ?>Ar </td> 

                    <td><?php 
                        $pourcentage_fixe_compte_6=get_pourcentage_fixe_compte6($compte);
                        if(empty($pourcentage_fixe_compte_6)){
                            echo 0;
                        }else{
                            echo $pourcentage_fixe_compte_6;
                        }
                        ?>%
                    </td>

                    <td> <?php  $valeur_fixe_compte_6=$debit*(get_pourcentage_fixe_compte6($compte)/100);
                        if(empty($valeur_fixe_compte_6)){
                            echo 0;
                        }else{
                            echo $valeur_fixe_compte_6;
                        }
                    ?>Ar </td> 

                    <?php foreach($centre as $centres) { 
                        $nom_centre=$centres['designation'];
                        $idcentre = get_id_centre($nom_centre); ?>
                        <td> <?php  $pourcentage_centre_compte_6=get_pourcentage_centre($compte,$idcentre); 
                            if(empty($pourcentage_centre_compte_6)){
                                echo 0;
                            }else{
                                echo $pourcentage_centre_compte_6;
                            }
                        ?> %</td>
                        <td> <?php  echo $valeur_variable_centre=($pourcentage_centre_compte_6/100)*$valeur_variable_compte6; ?> </td>
                        <td> <?php echo $valeur_fixe_centre=($pourcentage_centre_compte_6/100)*$valeur_fixe_compte_6; ?> </td>
                    <?php } ?>

                </tr>
            <?php } } ?>
        </table>
    