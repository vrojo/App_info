function ouvrirfermer(id) {
    if(document.getElementById(id).style.visibility=="hidden")
    {
        document.getElementById(id).style.visibility="visible";
		document.getElementById(id).style.display="inline-block";
    }
    else
    {
        document.getElementById(id).style.visibility="hidden";
		document.getElementById(id).style.display="none";
    }
}

function ouverture() {
	ouvrirfermer('reponse1');
	ouvrirfermer('reponse2');
	ouvrirfermer('reponse3');
	ouvrirfermer('reponse4');
}