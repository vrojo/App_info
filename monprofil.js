function ouvrirfermer(id, id2) {
	var aouvrir=document.querySelectorAll(id);
	
	for (var i = 0; i < aouvrir.length; i++) {
		var objet=aouvrir[i];
		objet.style.visibility="visible";
		objet.style.display="inline-block";
	}
	
	fermer(id2);
}


function ouvrir(id) {
	document.getElementById(id).style.visibility="visible";
	document.getElementById(id).style.display="inline-block";
}

function fermer(id) {
	document.getElementById(id).style.visibility="hidden";
	document.getElementById(id).style.display="none";
}

function fermeture_init(objet) {
	//crée un liste des div avec la classe information
	var afermer=document.querySelectorAll(objet);
	//parcourt la liste et cache ses éléments
	for (var i = 0; i < afermer.length; i++) {
		var objet=afermer[i];
		objet.style.visibility="hidden";
		objet.style.display="none";
	}
}

