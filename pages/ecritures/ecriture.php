<?php
    require("../inc/devise/fonctions.php");
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
                    <th style="padding-top: 25px"> Fixe </th>
                    <th style="padding-top: 25px"> Variable </th>
                    <th> </th>
                </tr>
                <tr id="input-line">
                    <td> <input type="text" name="fixe" id="fixe" placeholder="%"> </td>
                    <td> <input type="text" name="variable" id="variable" placeholder="%"> </td>
                    <td>
                        <select name="inc" id="">
                            <option value="inc"> Incorporable </option>
                            <option value="ninc"> Non incorporable </option>
                        </select>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <input type="text" name="code_journal" id="code_journal" value="<?php echo $code; ?>" hidden/>
        <input type="text" name="societe" id="societe_nom" value="<?php echo $societe; ?>" hidden/>
    </form>

    <form method="post" id="form-ecritures">
        <table id="table-ecriture" style="margin-left: -25%; margin-top: 25px"> 
            <tbody> </tbody>
        </table>
        <button id="valider_ecriture" type=button onclick="envoyerEcritures()"> Valider </button>
    </form>

    <script src="../assets/js/jquery.js"> </script>
    <script src="../assets/js/parsley.js"> </script>
    <script src="./ecritures/js/script.js"> </script>
    <script src="./ecritures/js/script_2.js"> </script>

    <script>

        function envoyerEcritures() {

            var societe_nom     = document.getElementById("societe_nom").value;
            var code_journal    = document.getElementById("code_journal").value;
            var rows            = [];

            $("#table-ecriture tr").each(function(){
                
                var date            = $(this).find("td:eq(0)").text();
                var numero_piece    = $(this).find("td:eq(1)").text();
                var cg              = $(this).find("td:eq(2)").text();
                var ct              = $(this).find("td:eq(3)").text();
                var libelle         = $(this).find("td:eq(4)").text();
                var devise          = $(this).find("td:eq(5)").text();
                var montant_devise  = $(this).find("td:eq(6)").text();
                var taux            = $(this).find("td:eq(7)").text();
                var debit           = $(this).find("td:eq(8)").text();
                var credit          = $(this).find("td:eq(9)").text();
                var row = {
                    date:           date,
                    numero_piece:   numero_piece,
                    cg:             cg,
                    ct:             ct,
                    libelle:        libelle,
                    devise:         devise,
                    montant_devise: montant_devise,
                    taux:           taux,
                    debit:          debit,
                    credit:         credit
                };
                rows.push(row);
            });
            $.ajax({
                type: "GET",
                url: "../inc/ecritures/traitement_insert.php",
                data: {
                    societe_nom:    societe_nom,
                    code_journal:   code_journal,
                    ecritures:      rows
                },
                success: function(response) {
                    alert(response);
                    var nom_societe = societe_nom;
                    window.location.href = "./page.php?page=ecritures/listes_ecritures";
                },
                error: function(xhr, status, error) {
                    alert("Une erreur s'est produite lors de l'envoi des données : " + error);
                }
            });
        }
    </script>