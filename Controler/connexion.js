function affiche(champ, type_erreur, message_erreur, erreur)
{
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
      message ="<br>Veuillez entrer une adresse mail valide pour continuer l'inscription.";
      affiche(mail, erreur, message, true);
      return false;
   }
   else
   {
      message =""
      erreur = "erreur_mail";
      affiche(mail, erreur, message, false);
      return true;
   }

}

function verifMailConnexion(mailCo)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(mailCo.value))
   {
      erreur = "erreur_mail_connexion";
      message ="<br>Veuillez entrer une adresse mail valide pour continuer l'inscription.";
      affiche(mailCo, erreur, message, true);
      return false;
   }
   else
   {
      message =""
      erreur = "erreur_mail_connexion";
      affiche(mailCo, erreur, message, false);
      return true;
   }

}
function verifMdpconf(mdpverif){
    mdp = document.getElementById("mdpconnexion_inscription").value;
    cmdp = document.getElementById("mdpconnexion_verif_inscription").value;
    if(cmdp!==mdp)
   {
      message = "<br>Les mots de passe ne sont pas identiques."
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

function verifMdpI(mdp){
    var regex = /^[a-zA-Z0-9]{2,}$/;
    if(!regex.test(mdp.value))
    {
        erreur = "erreur_mdpi";
        message ="<br>Veuillez entrer un mot de passe valide (Plus de 2 caractères et comprenants seulement des chiffres et des lettres.";
        affiche(mdp, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_mdpi";
        affiche(mdp, erreur, message, false);
        return true;
    }
}

function verifMdpC(mdp){
    var regex = /^[a-zA-Z0-9]{2,}$/;
    if(!regex.test(mdp.value))
    {
        erreur = "erreur_mdpc";
        message ="<br>Veuillez entrer un mot de passe valide (Plus de 2 caractères et comprenants seulement des chiffres et des lettres.";
        affiche(mdp, erreur, message, true);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_mdpc";
        affiche(mdp, erreur, message, false);
        return true;
    }
}

function verifCompletConnexion(form){
    id = document.getElementById("mail_connexion");
    mdp = document.getElementById("mdp_connexion");
    if(id.style.color === "red"){
        return false;
    }
    else if(mdp.style.color === "red"){
        return false;
    }
    return true;
}

function verifCompletInscription(form){
    id = document.getElementById("mail_inscription");
    mdp = document.getElementById("mdpconnexion_inscription");
    mdpc = document.getElementById("mdpconnexion_verif_inscription")
    if(id.style.color === "red"){
        return false;
    }
    else if(mdp.style.color === "red"){
        return false;
    }
    else if(mdpc.style.color === "red"){
        return false;
    }
    else if(mdpc.value ===! mdp.value){
        return false;
    }
    return true;
}

