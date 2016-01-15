function verifNom(nom){    
    var regex = /^[a-zA-Z-]{2,30}$/;
    if(!regex.test(nom.value))
    {
        erreur = "erreur_nom";
        message ="<br>Veuillez entrer un autre nom de topic celui-ci existe déjà.";
        affiche(nom, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_nom";
        affiche(nom, erreur, message, false);
        return true;
    }
}

