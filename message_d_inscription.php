<!DOCTYPE html>
<html>
    <head>
	<title>Inscription</title>
	<meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="message_d_inscription.css"/>
    </head>       
    
    <body>
        <?php
            include("model.php");
            include("Header.php");
            inscriptionpreleminaire($_POST['mail'], $_POST['mdpconnexion'], 0);
            $verifenvoi = envoimail_confirmation($_POST['mail']);          
            if($verifenvoi == 0){
                ?>
                <div id="titre_verfication">Erreur d'envoi </br> Vous allez être redirigé sur la page d'inscription.</br> </br></div>
                <meta http-equiv="refresh"  content="2; URL = connexion.php"/>
            <?php
                
            }
            else{
                ?>
                <div id="titre_verfication">Vous êtes inscrit ! </br> Vous allez recevoir un mail de confirmation, veuillez vous rendre sur le lien qu'il contiendra pour confirmer votre inscription.</br> </br></div>
             <?php
            }
              
            include"footer.php"?>
    </body>
</html>



