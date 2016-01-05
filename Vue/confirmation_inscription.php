<!DOCTYPE html>
<html>
    <head>
        
        <title>Confirmation d'inscription</title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="confirmation_inscription.css"/>
        <script type="text/javascript" src="confirmation_inscription.js"></script>
    </head>
           

    <body>
        
        <?php include("header.php"); ?>
        <?php require("model.php"); ?> 
            <?php
            
                if(verif_id($_GET['id'], $_GET['idconf'])){
                                 
                    if(confirmation_inscription()){
                        ?>
                        <div class='message_erreur'>
                            Il semblerait que vous ne soyez pas enregistré dans notre base de données.
                            Veuillez réessayer plus tard.
                        </div>
                        <meta http-equiv="Refresh" content="1; url=Simplevent.php">

                        <?php
                    }
                    else{
                        ?>
                        <div class='message_erreur'>
                            Vous avez bien été enregistré sur le site Simplevent.
                            Vous allez être redirigé vers la page d'accueil du site afin de vous y connecter.
                            Vous pourrez modifier vos informations de profil afin de profiter d'une meilleure expérience sur Simplevent !
                        </div>
                        <meta http-equiv="Refresh" content="2; url=Simplevent.php">
                        <?php
                    }
                }
                else{
                    ?>
                    <div class='message_erreur'>
                        Merci de ne pas tenter d'acceder à des pages qui ne vous sont pas destinées.
                    </div>
                    <meta http-equiv="Refresh" content="2; url=Simplevent.php">    
                    <?php
                    
                }
            
