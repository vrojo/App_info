function affiche(champ, type_erreur, message_erreur, erreur)
{
   if(erreur){
      champ.style.backgroundColor = "#fba";
      champ.style.color = "red";
      document.getElementById("bouton_connexion").style.visibility="hidden";
      document.getElementById(type_erreur).innerHTML = message_erreur;
    }
   else{
      champ.style.backgroundColor = "";
      champ.style.color = "";
      document.getElementById("bouton_connexion").style.visibility="visible";
      document.getElementById(type_erreur).innerHTML = message_erreur;
    }
}

function verifMail(mail)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(mail.value))
   {
      erreur = "erreur_mail";
      message ="<br>Veuillez entrer une adresse mail valide pour continuer l'inscription."
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

function verifMdp(mdpverif){
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