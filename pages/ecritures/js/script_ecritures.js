function envoyerEcritures() {

    var societe_nom     = document.getElementById("societe_nom").value;
    var code_journal    = document.getElementById("code_journal").value;
    var date_ecriture   = document.getElementById("date_ecriture").value;
    var numero_piece    = document.getElementById("n_piece").value;
    var rows            = [];

    var unite_oeuvre    = null;
    var nombre          = null;
    var nature          = null;
    var montant         = null;
    var compte_6        = null;


    console.log(document.getElementById("compte-input-1"));

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

    if (code_journal === 'AC') {
        unite_oeuvre    = document.getElementById("uo").value;
        nombre          = document.getElementById("nuo").value;
        nature          = document.getElementById("inc_n_inc").value;
        montant         = rows[0].debit;
        compte_6        = rows[0].cg;
    }

    var data = {
        date_ecriture: date_ecriture,
        societe_nom: societe_nom,
        numero_piece: numero_piece,
        code_journal: code_journal,
        ecritures: rows
    };

    if (code_journal === 'AC') {
        console.log(code_journal);
        data.unite_oeuvre   = unite_oeuvre;
        data.nombre         = nombre;
        data.nature         = nature;
        data.montant        = montant;
        data.compte_6       = compte_6;
    }
    console.log(data.montant);

    $.ajax({
        type: "GET",
        url: "../inc/ecritures/traitement_insert.php",
        data: data,
        success: function(response) {
            alert(response);
            if(code_journal === 'AC') {
                window.location.href = "./page.php?page=ecritures/cle_rep_produits&compte=" + compte_6;
            } else {
                window.location.href = "./page.php?page=ecritures/listes_ecritures";
            }
        },
        error: function(xhr, status, error) {
            alert("Une erreur s'est produite lors de l'envoi des données : " + error);
        }
    });
}