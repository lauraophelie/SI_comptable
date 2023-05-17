/*function checkPourcentage() {
    var compte_6 = document.getElementById("compte-input").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            var result = JSON.parse(xhr.responseText);
            if (result === null || typeof result.pourcentage.fixe === 'undefined' || typeof result.pourcentage.variable === 'undefined') {
                return;
            } else {

                var pourcentage = result.pourcentage;
                console.log(pourcentage)
                document.getElementById("fixe").value       = pourcentage.fixe;
                document.getElementById("variable").value   = pourcentage.variable;

                var select = document.getElementById("inc_n_inc");

                if(pourcentage.inc == 1 && pourcentage.n_inc == 0)        select.querySelector("option[value='inc']").selected = true;
                else if(pourcentage.n_inc == 1 && pourcentage.inc == 0)   select.querySelector("option[value='ninc']").selected = true;

                var produits = result.produits;
                var table = document.getElementById("produit-table");
                var inputs = table.querySelectorAll("input");

                for(let i = 0; i < inputs.length; i++) {
                    var input = inputs[i];
                    var id = input.id;
                    var produit = produits.find(function(p) { return "produit" + p.id_produit == id; });
                    if (produit !== undefined) {
                        input.value = produit.pourcentage;
                    }
                }

                var centres = result.centres;
                var tableCentre = document.getElementById("centre-table");
                var inputsCentre = tableCentre.querySelectorAll("input");

                for(let i = 0; i < inputsCentre.length; i++) {
                    var centreInput = inputsCentre[i];
                    var idCentre = centreInput.id;
                    var centre = centres.find(function(d) { return "centre" + d.id_centre == idCentre; });
                    if(centre !== undefined) {
                        centreInput.value = centre.pourcentage;
                    }
                }
            }            
        }
    };
    xhr.open("GET", "../inc/ecritures/check_pourcentages.php?compte_6=" + compte_6, true);
    xhr.send();
}*/

/*var compteInput   = document.getElementById("compte-input");
var fixeInput     = document.getElementById("fixe");
var variableInput = document.getElementById("variable");

compteInput.addEventListener("input", function() {
  if (this.value.trim() === "") {
    fixeInput.value     = "";
    variableInput.value = "";
  } else {
    checkPourcentage();
  }
});

compteInput.addEventListener("input", function() {
    checkPourcentage();
});*/
