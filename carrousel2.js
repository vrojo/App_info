function Slider(){

// crée des listes des éléments dont la classe est "itemLinks" puis dont l'id est "limitation"
var links = document.querySelectorAll(".itemLinks");
var wrapper = document.querySelector("#limitation");
 
// on donne à activeLink la valeur 0 pour dire que cest la première image que l'on veut voir
var activeLink = 0;
 
// on parcourt les éléments de links et on leur donne un événement si on clique dessus
for (var i = 0; i < links.length; i++) {
    var link = links[i];
    link.addEventListener('click', setClickedItem, false);
 
    // permet d'avoir une sorte "d'ID" pour le bouton actif
    link.itemID = i;
}
 
// ajoute la classe "active" au premier bouton
links[activeLink].classList.add("active");
 
function setClickedItem(e) {
    removeActiveLinks();
	//si on change manuellement de slide, on remet à 0 le temps d'attente pour changer de slide
	resetTimer();
 
    var clickedLink = e.target;
    activeLink = clickedLink.itemID;
 
    changePosition(clickedLink);
}
 
function removeActiveLinks() {
    for (var i = 0; i < links.length; i++) {
        links[i].classList.remove("active");
    }
}
 
// s'occupe de modifier la position de ce qui est caché
// et modifie le bouton actif, pour que cela se voit sur le bouton.
function changePosition(link) {
    var position = link.getAttribute("data-pos");
    var translateValue = "translate3d(" + position + ", 0px, 0)";
    wrapper.style[transformProperty] = translateValue;
 
    link.classList.add("active");
}
 

// en fonction du navigateur, toutes les valeurs de "transform" ne fonctionnent pas
var transforms = ["transform",
            "msTransform",
            "webkitTransform",
            "mozTransform",
            "oTransform"];
 

var transformProperty = getSupportedPropertyName(transforms);

 
// récupère la version du transform qui est acceptée
function getSupportedPropertyName(properties) {
    for (var i = 0; i < properties.length; i++) {
        if (typeof document.body.style[properties[i]] != "undefined") {
            return properties[i];
        }
    }
    return null;
}



//
// Partie du code concernant le défilement automatique des slides.
//
var timeoutID;
 
function startTimer() {
    // nécessité de pauser une variable bien qu'on puisse lancer directement la fonction setInterval.
	//la variable permet de la réinitialliser lorsqu'on clique sur un bouton
    timeoutID = window.setInterval(goToNextItem, 5000);
}

startTimer();
 
function resetTimer() {
    window.clearInterval(timeoutID);
    startTimer();
}
 
 
function goToNextItem() {
    removeActiveLinks();
 
    if (activeLink < links.length - 1) {
        activeLink++;
    } else {
        activeLink = 0;
    }
 
    var newLink = links[activeLink];
    changePosition(newLink);
}
}