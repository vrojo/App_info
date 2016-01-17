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
        <?php require("model.php");
		//vérification administrateur
              if (verifadmin($id_utilisateur) != 1){
                  header("Location:../Vue/Simplevent.php");
              }
        ?>
        <div class="gestion_commentaires">
        
            <div id="bloc_gestion_commentaires">
                <br>
                <div class="titre_gestion_commentaires_princ">Gestion des commentaires :</div>
                <br>
                <br>
                 <?php modification_commentaires() ?>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>


      