const compte0 = document.getElementById("compte-input");
const compte1 = document.getElementById("compte-input-1");

console.log(compte0);

compte0.addEventListener("input", function() {
    const valeur0 = compte0.value;
    compte1.value = valeur0;
    console.log(compte1.value)
});

const v1 = document.getElementById("debit-case");
const v2 = document.getElementById("mont_uo");

v1.addEventListener("input", function() {
    const val1 = v1.value;
    v2.value = val1;
});