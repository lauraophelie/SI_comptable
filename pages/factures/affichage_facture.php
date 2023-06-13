<h1 id="main-title"> Facture </h1>

<script>
    var urlParams = new URLSearchParams(window.location.search);
    var jsonData = urlParams.get("data");
    var factureData = JSON.parse(jsonData);
    console.log(factureData);
</script>