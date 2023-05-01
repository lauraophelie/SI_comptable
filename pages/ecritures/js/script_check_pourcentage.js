function checkPourcentage() {
    var compte_6 = document.getElementById("compte-input").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            var result = JSON.parse(xhr.responseText);
            if (result === null || typeof result.fixe === 'undefined' || typeof result.variable === 'undefined') {
                return;
            } else {
                document.getElementById("fixe").value = result.fixe;
                document.getElementById("variable").value = result.variable;
            }            
        }
    };
    xhr.open("GET", "../inc/ecritures/check_pourcentages.php?compte_6=" + compte_6, true);
    xhr.send();
}

var compteInput = document.getElementById("compte-input");
var fixeInput = document.getElementById("fixe");
var variableInput = document.getElementById("variable");

compteInput.addEventListener("input", function() {
  if (this.value.trim() === "") {
    fixeInput.value = "";
    variableInput.value = "";
  } else {
    checkPourcentage();
  }
});
