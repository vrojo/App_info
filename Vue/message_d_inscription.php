<!DOCTYPE html>
<html>
    <head>
	<title>Inscription</title>
	<meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="../Style/message_d_inscription.css"/>
        <script type="text/javascript" src="message_d_inscription.js"></script>    
    </head>       
    
    <body>
        <?php
            include("model.php");
            include("Header.php");
            
            if(verfifMailEx($_POST['mail'])){
                inscriptionpreleminaire($_POST['mail'], $_POST['mdpconnexion'], 0, 0);
                $verifenvoi = envoimail_confirmation($_POST['mail']);          
                if($verifenvoi == 0){
                    ?>
                    <div class="titre_verification">Erreur d'envoi </br> Vous allez être redirigé sur la page d'inscription.</br> </br></div>
                    <meta http-equiv="refresh"  content="2; URL = connexion.php"/>
                <?php

                }
                else{
                    ?>
                    <div class="titre_verification">Vous êtes inscrit ! </br> Vous allez recevoir un mail de confirmation, veuillez cliquer sur le lien qu'il contiendra pour confirmer votre inscription.</br> </br></div>
                    <meta http-equiv="refresh"  content="2; URL = Simplevent.php"/>
                <?php
                }
            }
            else{
                ?>
                <div class="titre_verification">Cette adresse est déjà utilisée. </br> Vous allez être redirigé sur la page d'inscription.</br> </br></div>
                <meta http-equiv="refresh"  content="2; URL = connexion.php"/>
                <?php
            }
            
            include"footer.php"?>
    </body>
</html>



