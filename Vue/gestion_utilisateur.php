<!DOCTYPE html>

<html>
   <head>
       
        <title>Gestion membres</title>
       <meta charset="utf-8"/>
    </head>
    <link type="text/css" rel="stylesheet" href="../Style/gestion_utilisateur.css"/>
    <body>        
        <?php session_start(); ?>
        <?php include ("Header.php"); ?>
        <?php require("model.php");
              if (verifadmin($id_utilisateur) != 1){
                  header("Location:../Vue/Simplevent.php");
              }
        ?>
        <div class="gestion_utilisateur">
        
            <div id="bloc_gestion_utilisateur">
                <br>
                    <div class="titre_gestion_utilisateur_princ">Gestion des utilisateurs :</div>
                    <br>
                    <br>
                    <?php affichage_utilisateur_signales() ?>
   
            </div>
            <div id="bloc_gestion_utilisateur">
                <br>
                    <div class="titre_gestion_utilisateur">Promouvoir un utilisateur au rang d'administrateur :</div>
                    <br>
                    <form action="../Controler/controleur_gestion_utilisateur.php" method="post">
                        <span id="texte_mail"> Mail de l'utilisateur à promouvoir :</span>
                        <br>
                        <br>
                        <input type="text" name="mail" id="mail_utilisateur">
                        <br>
                        <input type="submit" name="promu" value="Promouvoir" id="bouton_promotion">
                    </form>
            </div>
            <div id="bloc_gestion_utilisateur">
                <br>
                    <div class="titre_gestion_utilisateur">Liste des administrateurs du site :</div>
                    <br>
                    <?php liste_admin() ?>
                    
            </div>
        </div>
        <?php include("footer.php"); ?> 
    </body>
</html>


    