<?php
    require_once("../inc/devise/fonctions.php");
    require_once("../inc/ecritures/fonctions.php");
    require_once("../inc/unite_oeuvre/fonctions.php");

    $devises = find_all();
    $unite_oeuvre = find_all_uo();

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
                <td> <input type="text" name="ct" id="compte-input-2"/> </td>
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
                <td> <input type="text" name="debit" id="debit-case" value="0"/> </td>
                <td> <input type="text" name="credit" id="" value="0"/> </td>
                <td> <button type="submit" id="add-ecriture-button"> Ajouter </button> </td>
            </tr>
            <?php if($code === 'AC') { ?>
                <tr id="input-title">
                    <th style="padding-top: 25px"> </th>
                    <th style="padding-top: 25px"> Nature </th>
                    <th style="padding-top: 25px"> Unité d'oeuvre </th>
                    <th style="padding-top: 25px"> Quantité </th>
                    <th style="padding-top: 25px"> Montant </th>
                    <th> </th>
                </tr>
                <tr id="input-line">
                    <td> <input type="text" name="cg" id="compte-input-1" placeholder="N° de compte" readonly/> </td>
                    <td>
                        <select name="inc" id="inc_n_inc">
                            <option value="inc"> Incorporable </option>
                            <option value="ninc"> Non incorporable </option>
                        </select>
                    </td>
                    <td>
                        <select name="uo" id="" style="border: none">
                            <?php foreach($unite_oeuvre as $uo) { ?>
                                <option value="<?php echo $uo['id']; ?>"> 
                                    <?php echo $uo['designation']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="nuo" id="" placeholder="Nombre">
                    </td>
                    <td>
                        <input type="text" name="mont_uo" id="mont_uo" value="0">
                    </td>
                </tr>
                </table>
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