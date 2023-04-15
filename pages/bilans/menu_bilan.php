<h1 id="main-title"> Etats financiers </h1>

<div class="radio-box">
    <input type="radio" id="actifs" value="actifs" name="type-bilan"/>
    <label for="actifs" id="label-type"> Actifs </label>

    <input type="radio" id="passifs" value="passifs" name="type-bilan"/>
    <label for="passifs" id="label-type"> Passifs </label>

    <input type="radio" id="resultat" value="resultat" name="type-bilan"/>
    <label for="resultat" id="label-type"> Résultats </label>
</div>

<center>
    <p> Veuillez choisir le bilan que vous souhaitez consulter </p>
</center>

<script>
  const actifsRadio = document.getElementById("actifs");
  const passifsRadio = document.getElementById("passifs");
  const resultatRadio = document.getElementById("resultat");

  actifsRadio.addEventListener("click", () => {
    window.location.href = "./page.php?page=bilans/actifs";
  });

  passifsRadio.addEventListener("click", () => {
    window.location.href = "./page.php?page=bilans/passifs";
  });

  resultatRadio.addEventListener("click", () => {
    window.location.href = "./page.php?page=bilans/resultat";
  });
</script>
