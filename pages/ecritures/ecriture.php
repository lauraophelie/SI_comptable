<?php
    require_once("../inc/devise/fonctions.php");
    require_once("../inc/ecritures/fonctions.php");
    $devises = find_all();

    $code = $_GET['journal'];
    $designation = $_GET['designation'];
    $societe = $_GET['societe'];
?>
    <h1 id="main-title">
        Journal : <?php echo $designation; ?>
    </h1>

    <div style="height:85px"> </div>

    <div id="info-box">
        <p> 
            Date :  <input type="date" name="date_ecriture"/>
            <input type="text" name="numero_piece" placeholder="N° de pièce"/>
        </p>
    </div>
    <?php
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
    ?>
    <form method="post" id="form-ecriture">
        <table>
            <tr id="input-title">
                <th> Date </th>
                <th> Pièce </th>
                <th> Compte général </th>
                <th> Compte tiers </th>
                <th> Libelle </th>
            </tr>
            <tr id="input-line">
                <td> <input type="text" name="date_ecriture" id=""/> </td>
                <td> <input type="text" name="numero_piece"/> </td>
                <td> <input type="text" name="cg" id="compte-input"/> </td>
                <td> <input type="text" name="ct" id="compte-input"/> </td>
                <td> <input type="text" name="libelle" id=""/></td>
            </tr>
            <tr id="input-title">
                <th style="padding-top: 25px"> Devise </th>
                <th style="padding-top: 25px"> Montant </th>
                <th style="padding-top: 25px"> Taux </th>
                <th style="padding-top: 25px"> Débit </th>
                <th style="padding-top: 25px"> Crédit </th>
                <th> </th>
            </tr>
            <tr id="input-line">
                <td>
                    <select name="devise" id="">
                        <option value=""> Devise </option>
                        <?php foreach($devises as $devise) { ?>
                            <option value="<?php echo $devise['devise']; ?>">
                                <?php echo $devise['devise']; ?>    
                            </option>
                        <?php } ?>
                    </select>
                </td>
                <td> <input type="text" name="montant_devise" id=""/> </td>
                <td> <input type="text" name="taux" id=""/> </td>
                <td> <input type="text" name="debit" id="" value="0"/> </td>
                <td> <input type="text" name="credit" id="" value="0"/> </td>
                <td> <button type="submit" id="add-ecriture-button"> Ajouter </button> </td>
            </tr>
            <?php if($code === 'AC') { ?>
                <tr id="input-title">
                    <th style="padding-top: 25px"> </th>
                    <th style="padding-top: 25px"> Fixe </th>
                    <th style="padding-top: 25px"> Variable </th>
                    <th> </th>
                    <th> </th>
                </tr>
                <tr id="input-line">
                    <td> <input type="text" name="cg" id="compte-input-1" placeholder="N° de compte" readonly/> </td>
                    <td> <input type="text" name="fixe" id="fixe" placeholder="%"> </td>
                    <td> <input type="text" name="variable" id="variable" placeholder="%"> </td>
                    <td>
                        <select name="inc" id="inc_n_inc">
                            <option value="inc"> Incorporable </option>
                            <option value="ninc"> Non incorporable </option>
                        </select>
                    </td>
                    <td> 
                        <button id="pop-up-produit">
                            <i class="fas fa-list"> </i>
                        </button>
                    </td>
                </tr>
                </table>
                <div id="popup-overlay"> </div>
                <div id="pop-up">
                    <div style="height: 15px"> </div>
                    <h2> Produit(s) </h2>
                    <table id="produit-table">
                        <?php 
                            $produits = get_all_produit();
                            foreach($produits as $produit) {
                        ?>
                            <tr> 
                                <td> <?php echo $produit['designation']; ?> </td>
                                <td>
                                    <input type="text" name="<?php echo $produit['id']; ?>" id="<?php echo "produit".$produit['id']; ?>" placeholder="%">
                                </td>
                                <td> 
                                    <input type="text" name="<?php echo 'fixe'.$produit['id']; ?>" placeholder="% fixe">
                                </td>
                                <td> 
                                    <input type="text" name="<?php echo 'variable'.$produit['id']; ?>" placeholder="% variable">
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <button id="pop-up-close"> Fermer </button>
                    <button id="pop-up-add"> Valider </button>
                    <div style="height: 50px"> </div>
                </div>
            <?php } ?>
        <input type="text" name="code_journal" id="code_journal" value="<?php echo $code; ?>" hidden/>
        <input type="text" name="societe" id="societe_nom" value="<?php echo $societe; ?>" hidden/>
    </form>

    <form method="post" id="form-ecritures">
        <table id="table-ecriture" style="margin-left: -25%; margin-top: 25px"> 
            <tbody> </tbody>
        </table>
        <button id="valider_ecriture" type=button onclick="envoyerEcritures()"> Valider l'écriture </button>
    </form>

    <script src="../assets/js/jquery.js"> </script>
    <script src="../assets/js/parsley.js"> </script>
    <script src="./ecritures/js/script.js"> </script>
    <script src="./ecritures/js/script_2.js"> </script>
    <script src="./ecritures/js/script_ecritures.js"> </script>
    <script src="./ecritures/js/script_check_pourcentage.js"> </script>
    <script src="./ecritures/js/script_produit.js"> </script>