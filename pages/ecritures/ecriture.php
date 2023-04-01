<?php
    require("../../inc/devise/fonctions.php");
    $devises = find_all();

    $code = $_GET['journal'];
    $designation = $_GET['designation'];
    $societe = $_GET['societe'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ecriture Journal </title>
</head>
<style>
    input[type="text"] {
        width: 125px;
    }
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<body>
    <h1> Nouvelle écriture : </h1>
    <p> Journal : <?php echo $designation; ?> </p>
    <p> 
        Date :  <input type="date" name="date_ecriture"/>
        N° de pièce : <input type="text" name="numero_piece" placeholder="Ecrivez ici"/>
    </p>
    <?php
        if(isset($_GET['error'])) {
            echo '<p style="color: red">'.$_GET['error'].'</p>';
        }
    ?>
    <form method="post" id="form-ecriture">
        <table>
            <tr>
                <th> Date </th>
                <th> Pièce </th>
                <th> Compte général </th>
                <th> Compte tiers </th>
                <th> Libelle </th>
                <th> Devise </th>
                <th> Montant </th>
                <th> Taux </th>
                <th> Débit </th>
                <th> Crédit </th>
                <th> </th>
            </tr>
            <tr>
                <td> <input type="text" name="date_ecriture" id=""/> </td>
                <td> <input type="text" name="numero_piece" placeholder="Ecrivez ici"/> </td>
                <td> <input type="text" name="cg" id="" placeholder="Ecrivez ici"/> </td>
                <td> <input type="text" name="ct" id="" placeholder="Ecrivez ici"/> </td>
                <td> <input type="text" name="libelle" id="" placeholder="Ecrivez ici"/></td>
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
                <td> <input type="text" name="montant_devise" id="" placeholder="Ecrivez ici"/> </td>
                <td> <input type="text" name="taux" id="" placeholder="Ecrivez ici"/> </td>
                <td> <input type="text" name="debit" id="" placeholder="Ecrivez ici"/> </td>
                <td> <input type="text" name="credit" id="" placeholder="Ecrivez ici"/> </td>
                <td> <button type="submit" id="add-button"> Ajouter </button> </td>
            </tr>
        </table>
        <input type="text" name="code_journal" id="code_journal" value="<?php echo $code; ?>" hidden/>
        <input type="text" name="societe" id="societe_nom" value="<?php echo $societe; ?>" hidden/>
    </form>

    <form method="post" id="form-ecritures">
        <table id="table-ecriture" border="1px" width=850px> 
            <tbody> </tbody>
        </table>
        <button id="valider_ecriture" type=button onclick="envoyerEcritures()"> Valider </button>
    </form>

    <script src="../../assets/js/jquery.js"> </script>
    <script src="../../assets/js/parsley.js"> </script>
    <script src="./js/script.js"> </script>

    <script>

        function envoyerEcritures() {

            var societe_nom = document.getElementById("societe_nom").value;
            var code_journal = document.getElementById("code_journal").value;
            var rows = [];

            $("#table-ecriture tr").each(function(){
                
                var date = $(this).find("td:eq(0)").text();
                var numero_piece = $(this).find("td:eq(1)").text();
                var cg = $(this).find("td:eq(2)").text();
                var ct = $(this).find("td:eq(3)").text();
                var libelle = $(this).find("td:eq(4)").text();
                var devise = $(this).find("td:eq(5)").text();
                var montant_devise = $(this).find("td:eq(6)").text();
                var taux = $(this).find("td:eq(7)").text();
                var debit = $(this).find("td:eq(8)").text();
                var credit = $(this).find("td:eq(9)").text();
                var row = {
                    date: date,
                    numero_piece: numero_piece,
                    cg: cg,
                    ct: ct,
                    libelle: libelle,
                    devise: devise,
                    montant_devise: montant_devise,
                    taux: taux,
                    debit: debit,
                    credit: credit
                };
                rows.push(row);
            });
            $.ajax({
                type: "GET",
                url: "../../inc/ecritures/traitement_insert.php",
                data: {
                    societe_nom: societe_nom,
                    code_journal: code_journal,
                    ecritures: rows
                },
                success: function(response) {
                    alert(response);
                    var nom_societe = societe_nom;
                    window.location.href = "./listes_ecritures.php?societe=" + nom_societe;
                },
                error: function(xhr, status, error) {
                    alert("Une erreur s'est produite lors de l'envoi des données: " + error);
                }
            });
        }
    </script>
</body>
</html>