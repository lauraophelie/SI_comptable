<h1 id="main-title"> Comptabilité générale </h1>

<div style="height: 100px"> </div>

<div class="compta-menu-line-one">
    <div class="compta-menu-element-one">
        <i class="fas fa-pen-fancy"> </i>
        <h2> Ecritures </h2>
    </div>
    <div class="compta-menu-element-one">
        <i class="fas fa-book"> </i>
        <h2> Grand livre </h2>
    </div>
    <div class="compta-menu-element-one">
        <i class="fas fa-balance-scale"> </i>
        <h2> Balance </h2>
    </div>
    <div class="compta-menu-element-one">
        <i class="fas fa-comments-dollar"> </i>
        <h2> Etats </h2>
    </div>
</div>

<div class="compta-menu-line-one">
    <div class="compta-menu-element-one">
        <i class="fas fa-book-open"> </i>
        <h2> PCG </h2>
    </div>
    <div class="compta-menu-element-one">
        <i class="fas fa-newspaper"> </i>
        <h2> Journaux </h2>
    </div>
    <div class="compta-menu-element-one">
        <i class="fas fa-money-bill"> </i>
        <h2> Devise </h2>
    </div>
</div>

<script>
    const allBoxes = document.querySelectorAll(".compta-menu-element-one");

    const links = ["ecritures/listes_ecritures", "grandlivre/grandlivre", "balance/balance", "bilans/menu_bilan", 
                    "pcg/affichage_pcg&num_page=1", "journal/affichage_journaux", "devise/affichage_devise"];

    for(let i = 0; i < links.length; i++) {
        allBoxes[i].addEventListener("click", () => {
            let link = "./page.php?page=" + links[i];
            window.location.href = link;
        });
    }
</script>