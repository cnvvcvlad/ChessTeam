// Lors du click sur 'slider-left' j'aurais la fonction sliderLeft
document.getElementById('slider-left').onclick = sliderLeft;


autoSlider(); /* En JS il faut ecrire le nom de la fonction, une fois il passe pour voir les variables et les fonctions , ensuite il passe pour éxécuter  */
// setTimeout(autoSlider(), 5000);
var left = 0;
var right;
var timer;

function autoSlider() {
    timer = setTimeout(sliderLeft, 10001);
}

function sliderLeft() {
    var bandeau = document.getElementById('bandeau');
    left = left - 600;

    // On vérifie le déplacement à gauche des éléments, et on fixe la mesure en pixel, pour que la derniere image ne sort pas du caroussel
    if (left < -1800) {
        left = 0;
        clearTimeout(timer);
    }
    bandeau.style.left = left + 'px';
    autoSlider();
}


