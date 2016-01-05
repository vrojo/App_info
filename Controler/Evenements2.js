//permet de n'avoir qu'un élément ouvert à la fois
var identifiant='1';

function ouvrirfermer(id) {
	//si l'élément qu'on clique n'est pas déjà ouvert, on ferme celui d'avant qui est ouvert
	if (identifiant!=id) {
	fermer(identifiant);
	identifiant=id;
	}
	//si l'élément est caché, on le montre
    if(document.getElementById(id).style.visibility=="hidden")
    {
        ouvrir(id);
    }
    else
    {
        fermer(id);
    }
}

function ouvrir(id) {
	document.getElementById(id).style.visibility="visible";
	document.getElementById(id).style.display="inline-block";
}

function fermer(id) {
	document.getElementById(id).style.visibility="hidden";
	document.getElementById(id).style.display="none";
}

function fermeture_init() {
	//crée un liste des div avec la classe information
	var afermer=document.querySelectorAll(".information");
	//parcourt la liste et cache ses éléments
	for (var i = 0; i < afermer.length; i++) {
		var objet=afermer[i];
		objet.style.visibility="hidden";
		objet.style.display="none";
	}
}