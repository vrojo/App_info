


<!DOCTYPE html>
<html>
    <head>
        
        <title>BackOffice</title>
        <meta charset="utf-8"/>
       
    </head>
            <link type="text/css" rel="stylesheet" href="BackOffice.css"/>

    <body>
        <?php include("Header.php"); ?>
        <?php require("model.php"); ?> 
        <div class="formulaire_back_office">
            <form action="backoffice.php" method="post">
                <div class="back">
                    <div id="titre_back"><p>Gestion des utilisateurs/des administrateurs :</p></div>
                        <input type="submit" name="modification_utilisateur" value="Modification d'un utilisateur/d'un administrateur" id="bouton_back">            
                </div>
            <br>
            </form>
            
            <form action="backoffice.php" method="post">
                <div class="back">
                    <div id="titre_back"><p>Gestion des événements :</p></div>
                    <input type="submit" name="modification_event" value="Modification d'un événement" id="bouton_back">
                </div>
            </form>        
            <br>
            
            <form action="gestion_categorie.php" method="post">
                <div class="back">
                    <div id="titre_back"><p>Gestion des catégories :</p></div>
                    <input type="submit" name="modification_categorie" value="Modification d'une catégorie" id="bouton_back">
                </div>                
            </form>
            <br>
        
            <form action="backoffice.php" method="post">     
                <div class="back">
                    <div id="titre_back"><p>Gestion du forum du site :</p></div>
                    <input type="submit" name="modification_message" value="Modification d'un message/d'un topic" id="bouton_back">
                </div>
            <br>
            </form>
        </div>
        <?php include('footer.php') ?>
        </body>