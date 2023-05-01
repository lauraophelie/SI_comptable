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