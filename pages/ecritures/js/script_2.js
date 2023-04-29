const fixe = document.getElementById("fixe");
const variable = document.getElementById("variable");

fixe.addEventListener("input", function() {
    const valeurFixe = parseFloat(fixe.value);
    const valeurVariable = isNaN(valeurFixe) ? "" : Math.max(0, 100 - valeurFixe);
    variable.value = valeurVariable;
});

variable.addEventListener("input", function() {
    const valueVariable = parseFloat(variable.value);
    const valueFixe = isNaN(valueVariable) ? "" : Math.max(0, 100 - valueVariable);
    fixe.value = valueFixe;
});