function affiche(champ, type_erreur, message_erreur, erreur)
{
    compteur = 0;
    if(erreur){
      champ.style.backgroundColor = "#fba";
      champ.style.color = "red";
      document.getElementById(type_erreur).innerHTML = message_erreur;
      document.getElementById(type_erreur).style.color = "red";
    }
   else{
      champ.style.backgroundColor = "";
      champ.style.color = "";
      document.getElementById(type_erreur).innerHTML = message_erreur;
    }
}

function verifNom(nom){    
    var regex = /^[0-9-a-zA-Z- ]{2,30}$/;
    if(!regex.test(nom.value))
    {
        erreur = "erreur_nom";
        message ="<br>Veuillez entrer un nom valide pour continuer l'enregistrement.<br> Le nom doit avoir au moins 2 caractères.";
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

//Pour le prix

function verifPrix(prix){
    var regex = /^[0-9]{1,3}$/;
    if(!regex.test(num.value))
    {
        erreur = "erreur_prix";
        message ="<br>Veuillez entrer un prix valide pour continuer.";
        affiche(num, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_numrue";
        affiche(num, erreur, message, false);
        return true;
    }
}

//Pour les champs de l'adresse

function verifNumrue(num){
    var regex = /^[0-9]{1,3}$/;
    if(!regex.test(num.value))
    {
        erreur = "erreur_numrue";
        message ="<br>Veuillez entrer un numéro de rue valide pour continuer l'enregistrement.";
        affiche(num, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_numrue";
        affiche(num, erreur, message, false);
        return true;
    }
}

function verifRue(rue){
    var regex = /^[a-zA-Z\s-\']+$/;
    if(!regex.test(rue.value))
    {
        erreur = "erreur_rue";
        message ="<br>Veuillez entrer un nom de rue valide pour continuer l'enregistrement.";
        affiche(rue, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_rue";
        affiche(rue, erreur, message, false);
        return true;
    }
}

function verifVille(ville){
    var regex = /^[a-zA-Z\s-\']+$/;
    if(!regex.test(ville.value))
    {
        erreur = "erreur_ville";
        message ="<br>Veuillez entrer un nom de ville valide pour continuer l'enregistrement.";
        affiche(ville, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_ville";
        affiche(ville, erreur, message, false);
        return true;
    }
}

function verifCodepostal(code){
    var regex = /^[0-9]{2}$/;
    if(!regex.test(code.value))
    {
        erreur = "erreur_codepostal";
        message ="<br>Veuillez entrer un code postal valide (seulement deux chiffres) pour continuer l'enregistrement.";
        affiche(code, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_codepostal";
        affiche(code, erreur, message, false);
        return true;
    }
}

function verifPays(pays){
    var regex = /^[a-zA-Z\s-\']+$/;
    if(!regex.test(pays.value))
    {
        erreur = "erreur_pays";
        message ="<br>Veuillez entrer un nom de pays valide pour continuer l'enregistrement.";
        affiche(pays, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_pays";
        affiche(pays, erreur, message, false);
        return true;
    }
}