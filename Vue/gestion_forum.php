<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>Gestion du forum</title>
        <meta charset="utf-8"/>
    </head>
    
    <link type="text/css" rel="stylesheet" href="../Style/gestion_forum.css"/>

    <body>
        
        <?php include ("Header.php"); ?>
        <?php require("model.php") ?>
        <div class="gestion_forum">
        
            <div id="bloc_gestion_forum">
                <br>
                <div class="titre_gestion_forum_princ">Gestion des topics :</div>
                <br>
                <br>
                 <?php modification_topic() ?>
            </div>
        </div>
        <div class="gestion_forum">
        
            <div id="bloc_gestion_forum">
                <br>
                <div class="titre_gestion_forum_princ">Gestion des forum :</div>
                <br>
                <br>
                 <?php modification_reponse() ?>
            </div>
        </div>
        <?php include'footer.php'; ?>
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

      