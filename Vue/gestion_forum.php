<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>Gestion des commentaires</title>
        <meta charset="utf-8"/>
    </head>
    
    <link type="text/css" rel="stylesheet" href="../Style/gestion_commentaires.css"/>

    <body>
        
        <?php include ("Header.php"); ?>
        <?php require("model.php") ?>
        <div class="gestion_commentaires">
        
            <div id="bloc_gestion_commentaires">
                <br>
                <div class="titre_gestion_commentaires_princ">Gestion des commentaires :</div>
                <br>
                <br>
                 <?php modification_topic() ?>
            </div>
        </div>
        <div class="gestion_commentaires">
        
            <div id="bloc_gestion_commentaires">
                <br>
                <div class="titre_gestion_commentaires_princ">Gestion des commentaires :</div>
                <br>
                <br>
                 <?php modification_topic() ?>
            </div>
        </div>
    </body>
</html>
<?php
        if(isset($_POST["idcom"])){
            if($_POST["action"]=="supprimer")
            {
                suppression_commentaire($_POST['idcom']); 
            }
        }
        ?>

      