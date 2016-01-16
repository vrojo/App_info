<!DOCTYPE html>

<html>
   <head>
       
        <title>Gestion events</title>
       <meta charset="utf-8"/>
    </head>
    <link type="text/css" rel="stylesheet" href="../Style/gestion_event.css"/>
    <body>        
        <?php session_start(); ?>
        <?php include ("Header.php"); ?>
        <?php require("model.php");
              if (verifadmin($id_utilisateur) != 1){
                  header("Location:../Vue/Simplevent.php");
              }
        ?>
        <div class="gestion_event">
        
            <div id="bloc_gestion_event">
                <br>
                    <div class="titre_gestion_event_princ">Gestion des utilisateurs :</div>
                    <br>
                    <br>
                    <?php affichage_event_signales() ?>
   
            </div>
        </div>
        <?php include("footer.php"); ?> 
    </body>
</html>
