var compteInput   = document.getElementById("compte-input");
console.log(compteInput.value);
//var fixeInput     = document.getElementById("fixe");
//var variableInput = document.getElementById("variable");

/*compteInput.addEventListener("input", function() {
    checkPourcentage();
  if (this.value.trim() === "") {
    fixeInput.value     = "";
    variableInput.value = "";
  } else {
    checkPourcentage();
  }
});*/
// Fonction pour préremplir les champs du pop-up
function prefillPopupInputs() {
    var compte_6 = document.getElementById("compte-input").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);
            if (response && response.cle_repartition) {
                var cle_repartition = response.cle_repartition;
                var produits = response.produits;

                var table = document.getElementById("produit-table");
                var rows = table.getElementsByTagName("tr");

                for (var i = 0; i < rows.length; i++) {
                    var inputs = rows[i].getElementsByTagName("input");

                    for (var j = 0; j < inputs.length; j++) {
                        var inputName = inputs[j].getAttribute("name");
                        if (inputName.includes("produit")) {
                            inputs[j].value = cle_repartition[i].cle;
                        } else if (inputName.includes("fixe")) {
                            inputs[j].value = cle_repartition[i].fixe;
                        } else if (inputName.includes("variable")) {
                            inputs[j].value = cle_repartition[i].variable;
                        }
                    }                    
                }
            }
        }
    };

    xhr.open("GET", "../inc/ecritures/check_pourcentages.php?compte_6=" + compte_6, true);
    xhr.send();
}

