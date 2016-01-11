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

function verifMail(mail)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(mail.value))
   {
      erreur = "erreur_mail";
      message ="<br>Veuillez entrer une adresse mail valide pour continuer l'enregistrement.";
      affiche(mail, erreur, message, true);
      return false;
   }
   else
   {
      message ="";
      erreur = "erreur_mail";
      affiche(mail, erreur, message, false);
      return true;
   }
}


function verifMdpconf(mdpverif){
    mdp = document.getElementById("mdpmodif").value;
    cmdp = document.getElementById("mdpconfmodif").value;
    if(cmdp!==mdp)
   {
      message = "<br>Les mots de passe ne sont pas identiques.";
      erreur = "erreur_confirmation_mdp";
      affiche(mdpverif, erreur, message, true);
      return false;
   }
   else
   {
      message = "";
      erreur = "erreur_confirmation_mdp";
      affiche(mdpverif, erreur, message, false);
      return true;
   }
}

function verifNom(nom){    
    var regex = /^[a-zA-Z-]{2,30}$/;
    if(!regex.test(nom.value))
    {
        erreur = "erreur_nom";
        message ="<br>Veuillez entrer un nom valide pour continuer l'enregistrement.";
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

function verifPrenom(prenom){    
    var regex = /^[a-zA-Z-]{2,30}$/;
    if(!regex.test(prenom.value))
    {
        erreur = "erreur_prenom";
        message ="<br>Veuillez entrer un prénom valide pour continuer l'enregistrement.";
        affiche(prenom, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_prenom";
        affiche(prenom, erreur, message, false);
        return true;
    }
}

function verifMdp(mdp){
    var regex = /^[a-zA-Z0-9]{2,}$/;
    if(!regex.test(mdp.value))
    {
        erreur = "erreur_mdp";
        message ="<br>Veuillez entrer un mot de passe valide (Plus de 2 caractères et comprenant seulement des chiffres et des lettres).";
        affiche(mdp, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_mdp";
        affiche(mdp, erreur, message, false);
        return true;
    }
}

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

function verifTelephone(tel){
    var regex = /^[0-9\s]{14}/;
    if(!regex.test(tel.value))
    {
        erreur = "erreur_telephone";
        message ="<br>Veuillez entrer un numéro de téléphone valide (avec espaces)pour continuer l'enregistrement.";
        affiche(tel, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_telephone";
        affiche(tel, erreur, message, false);
        return true;
    }
}

function verifDescr(descr){
    var regex = /^[a-zA-Z0-9\s\'\.\,]+$/;
    if(!regex.test(descr.value))
    {
        erreur = "erreur_description";
        message ="<br>Veuillez entrer une description valide (caractère authorisés : espace, point, et apostrophe)continuer l'enregistrement.";
        affiche(descr, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_description";
        affiche(descr, erreur, message, false);
        return true;
    }
}



function verifCompletModif(form){
    nom = document.getElementById("nom");
    prenom = document.getElementById("prenom");
    mail = document.getElementById("mail");
    mdp = document.getElementById("mdpmodif");
    mdpc = document.getElementById("mdpconfmodif");
    numrue = document.getElementById("numero_adresse");
    rue = document.getElementById("rue_adresse");
    ville = document.getElementById("ville_adresse");
    codepostal = document.getElementById("codepostal_adresse");
    pays = document.getElementById("pays_adresse");
    telephone = document.getElementById("telephone");
     
    if(nom.style.color === "red"){
        return false;
    }
    if(prenom.style.color === "red"){
        return false;
    }
    if(mail.style.color === "red"){
        return false;
    }
    if(mdp.style.color === "red"){
        return false;
    }
    if(mdpc.style.color === "red"){
        return false;
    }
    if(numrue.style.color === "red"){
        return false;
    }
    if(rue.style.color === "red"){
        return false;
    }
    if(ville.style.color === "red"){
        return false;
    }
    if(codepostal.style.color === "red"){
        return false;
    }
    if(pays.style.color === "red"){
        return false;
    }
    if(telephone.style.color === "red"){
        return false;
    }    
    else{
        return true;
    }
}