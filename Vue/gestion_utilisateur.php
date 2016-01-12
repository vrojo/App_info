<!DOCTYPE html>

<html>
   <head>
       
        <title>Gestion membres</title>
       <meta charset="utf-8"/>
    </head>
    <link type="text/css" rel="stylesheet" href="../Style/gestion_utilisateur.css"/>
    <body>        
        <?php session_strat(); ?>
        <?php include ("Header.php"); ?>
        <?php require("model.php") ?>
        <div class="gestion_utilisateur">
        
            <div id="bloc_gestion_utilisateur">
                <br>
                    <div class="titre_gestion_utilisateur">Gestion des utilisateurs :</div>
                    <br>
                    <br>
                    <?php affichage_utilisateur() ?>
   
            </div>
        </div>
        
        
           
        
    
        
        <?php include("footer.php"); ?> 
    

    <?php if(isset($_POST["id"]))
    {
        if($_POST["action"]=="supprimer")
        {
            suppression_utilisateur($_POST['id']); 
        }
        else
        {
            update_utilisateur($_POST['id']);
        }
    }
    ?>



</body>
</html>