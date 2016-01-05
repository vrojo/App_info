function affiche(champ, type_erreur, message_erreur, erreur, bouton)
{
   if(erreur){
      champ.style.backgroundColor = "#fba";
      champ.style.color = "red";
      document.getElementById(bouton).style.visibility="hidden";
      document.getElementById(type_erreur).innerHTML = message_erreur;
      document.getElementById(type_erreur).style.color = "red";
    }
   else{
      champ.style.backgroundColor = "";
      champ.style.color = "";
      document.getElementById(bouton).style.visibility="visible";
      document.getElementById(type_erreur).innerHTML = message_erreur;
    }
}

function verifMail(mail)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(mail.value))
   {
      erreur = "erreur_mail";
      bouton = "bouton_connexion"
      message ="<br>Veuillez entrer une adresse mail valide pour continuer l'inscription.";
      affiche(mail, erreur, message, true, bouton);
      return false;
   }
   else
   {
      message =""
      bouton = "bouton_connexion"
      erreur = "erreur_mail";
      affiche(mail, erreur, message, false, bouton);
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
      bouton = "bouton_connexion2";
      affiche(mailCo, erreur, message, true, bouton);
      return false;
   }
   else
   {
      message =""
      erreur = "erreur_mail_connexion";
      bouton = "bouton_connexion2";
      affiche(mailCo, erreur, message, false, bouton);
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
      bouton = "bouton_connexion";
      affiche(mdpverif, erreur, message, true, bouton);
      return false;
   }
   else
   {
      message = "";
      erreur = "erreur_confirmation_mdp";
      bouton = "bouton_connexion";
      affiche(mdpverif, erreur, message, false, bouton);
      return true;
   }
}

function verifMdpI(mdp){
    var regex = /^[a-zA-Z0-9]{2,}$/;
    if(!regex.test(mdp.value))
    {
        erreur = "erreur_mdpi";
        message ="<br>Veuillez entrer un mot de passe valide (Plus de 2 caractères et comprenants seulement des chiffres et des lettres.";
        bouton = "bouton_connexion";
        affiche(mdp, erreur, message, true, bouton);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_mdpi";
        bouton = "bouton_connexion";
        affiche(mdp, erreur, message, false, bouton);
        return true;
    }
}

function verifMdpC(mdp){
    var regex = /^[a-zA-Z0-9]{2,}$/;
    if(!regex.test(mdp.value))
    {
        erreur = "erreur_mdpc";
        message ="<br>Veuillez entrer un mot de passe valide (Plus de 2 caractères et comprenants seulement des chiffres et des lettres.";
        bouton = "bouton_connexion2";
        affiche(mdp, erreur, message, true, bouton);
        return false;
    }
    else
    {
        message ="";
        erreur = "erreur_mdpc";
        bouton = "bouton_connexion2";
        affiche(mdp, erreur, message, false, bouton);
        return true;
    }
}

function verifComplet(){
    connexion = document.getElementById("bouton_connexion");
    inscription = document.getElementById("bouton_connexion2");
    if(connexion.style.visibility === "visible" && inscription.style.visibility === "visible"){
        return true;
    }
    else{
        return false;
    }
}

