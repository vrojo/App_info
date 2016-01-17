<!DOCTYPE html>
<html>
    <head>
        
        <title>Confirmation d'inscription</title>
        <meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="../Style/confirmation_inscription.css"/>
        <script type="text/javascript" src="confirmation_inscription.js"></script>
    </head>
           

    <body>
        <!-- Divers tests permettant de vérifier que l'utlisateur est bien où il a le droit d'être -->
        <?php include("header.php"); ?>
        <?php require("model.php"); ?> 
            <?php
            if(isset($_GET['id'])&& isset($_GET['idconf'])){
                if(verif_id($_GET['id'], $_GET['idconf'])){
                                 
                    if(confirmation_inscription()){
                        ?>
                        <div class='message_erreur'>
                            Il semblerait que vous ne soyez pas enregistré dans notre base de données.
                            <br>
                            Veuillez réessayer plus tard.
                        </div>
						<?php include'carrousel2.php'; ?>
                        <?php include'footer.php'; ?>
                        <meta http-equiv="Refresh" content="1; url=../Vue/Simplevent.php">

                        <?php
                    }
                    else{
                        ?>
                        <div class='message_erreur'>
                            Vous avez bien été enregistré sur le site Simplevent.
                            <br>
                            Vous allez être redirigé vers la page d'accueil du site afin de vous y connecter.
                            <br>
                            Vous pourrez modifier vos informations de profil afin de profiter d'une meilleure expérience sur Simplevent !
                        </div>
                        <?php include'carrousel2.php'; ?>
                        <?php include'footer.php'; ?>
                        <meta http-equiv="Refresh" content="2; url=../vue/Simplevent.php">
						
                        <?php
                    }
                }
                else{
                    ?>
                    <div class='message_erreur'>
                        Merci de ne pas tenter d'acceder à des pages qui ne vous sont pas destinées.
                    </div>
                    <?php include'carrousel2.php'; ?>
                    <?php include'footer.php'; ?>
                    <meta http-equiv="Refresh" content="2; url=../Vue/Simplevent.php">    
                    <?php
                    
                }
            }
            else{
                ?>
                    <div class='message_erreur'>
                        Merci de ne pas tenter d'acceder à des pages qui ne vous sont pas destinées.
                    </div>
                    <?php include'carrousel2.php'; ?>
                    <?php include'footer.php'; ?>
                    <meta http-equiv="Refresh" content="2; url=../Vue/Simplevent.php">    
                    <?php
            }
      
