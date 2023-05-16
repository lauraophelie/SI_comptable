function displayFenetreProduit() {
    var open = document.getElementById("pop-up");
    var popupOverlay = document.getElementById("popup-overlay");
    open.style.display = "block";
    popupOverlay.style.display = "block";
}

function closeFenetreProduit() {
    var close = document.getElementById("pop-up");
    var overlay = document.getElementById("popup-overlay");
    close.style.display = "none"
    overlay.style.display = "none";
}

const popupBoutton = document.getElementById("pop-up-produit");

popupBoutton.onclick = function(event) {
    event.preventDefault();
    displayFenetreProduit();
}

const closePopup = document.getElementById("pop-up-close");

closePopup.onclick = function(event) {
    event.preventDefault();
    closeFenetreProduit();
}


