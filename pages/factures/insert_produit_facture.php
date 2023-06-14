<h1 id="main-title"> Générer une facture ( 2 / 2 ) </h1>

<div style="height: 115px"> </div>

<h2 id="main-title"> Quantité des produits : </h2>

<div style="height: 115px"> </div>

<table id="produitsChoix">
    <tr style="height: 35px">
        <th> Produit </th>
        <th style="text-align: center"> Quantité </th>
    </tr>
</table>

<div class="button-container" style="margin-left: 35%; margin-top: 50px">
    <button type="button" id="retour-facture" class="fac"> Précédent </button>
    <button type="button" id="add-facture" class="fac"> Valider </button>
</div>

<script>
    var urlParams = new URLSearchParams(window.location.search);
    var jsonData = urlParams.get("data");
    var formData = JSON.parse(jsonData);

    var choixProduits = formData.produits;
    var tableProduits = document.getElementById("produitsChoix");

    for(let i = 0; i < choixProduits.length; i++) {
        var newRow = tableProduits.insertRow(-1);
        newRow.style.height = "30px";


        var produitCell = newRow.insertCell(0);
        produitCell.textContent = choixProduits[i].designation;
        produitCell.style.textAlign = "center";

        var quantityCell = newRow.insertCell(1);
        quantityCell.style.textAlign = "center";

        var input = document.createElement("input");
        input.type = "text";
        input.name = "produit" + choixProduits[i].id_produit;
        input.id = "produit" + choixProduits[i].id_produit;
        input.placeholder = "Quantité";
        input.style.border = "1px solid transparent";
        input.style.height = "30px";

        quantityCell.appendChild(input);
    }
    tableProduits.style.width = "600px";
    tableProduits.style.margin = '0 auto';

    const addButton = document.getElementById("add-facture");
    const retourButton = document.getElementById("retour-facture");
    const fac = document.getElementsByClassName("fac");

    for(let i = 0; i < fac.length; i++) {
        fac[i].style.border = "1px solid transparent";
        fac[i].style.width = "150px";
        fac[i].style.height = "35px";
        fac[i].style.transition = "0.5s";
    }
    addButton.style.background = "#CCA43B";

    retourButton.style.background = "#242F40";
    retourButton.style.color = "#FFFFFF";

    addButton.addEventListener("click", function(e) {
        e.preventDefault();  
        
        var produits = [];
        for(let i = 0; i < choixProduits.length; i++) {
            var name = "produit" + choixProduits[i].id_produit;
            var valueQuantite = document.getElementById(name).value;
            var objet = {
                id_produit: choixProduits[i].id_produit,
                designation: choixProduits[i].designation,
                quantite: valueQuantite
            }
            produits.push(objet);
        }
        var data = {
            client: formData.client,
            reference: formData.reference,
            objet: formData.objet,
            avance: formData.avance,
            produits: produits
        }
        var jsonData = JSON.stringify(data);
        window.location.href = "./page.php?page=factures/affichage_facture&data=" + encodeURIComponent(jsonData);
    });
</script>