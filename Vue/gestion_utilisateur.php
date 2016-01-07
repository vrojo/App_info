<!DOCTYPE html>
<html>
    <head>
        
        <title>Gestion des utilisateurs</title>
        <meta charset="utf-8"/>
    </head>
    
    <link type="text/css" rel="stylesheet" href="../Style/gestion_utilisateur.css"/>

    <body>
        
        <?php include ("Header.php"); ?>
        <?php require("model.php") ?>
        <div class="gestion_categ">
        
        <div id="bloc_gestion_utilisateur">
            <br>
        <div class="titre_gestion_utilisateur">Gestion des utilisateurs:</div>
        <br>
        <br>
             <?php $result = affichage_utilisateurs();
                $compteur = 1;
                
                
                if($compteur==1){
                    echo'<div class="mailutilisateur">';
                    while($categorie = mysqli_fetch_assoc($result)) {
                        echo '<div class="mail_de_utilisateur">'.$categorie['mail'].'</div>';
                        }
                    echo'</div>'; 
                }    
                  ?>  
        
        </div>
        </div> 
        <div class="bloc_gestion_utilisateur">
            <div class="titre_gestion_utilisateur">Ajout administrateur :</div>
            <span id="police_admin">Mail du futur administrateur :</span><input type="text" name="mail_futur_admin">            
        </div>
        <div class="bloc_gestion_utilisateur">
            <div class="titre_gestion_utilisateur">Supprimer administrateur :</div>
            <span id="police_admin">Mail de l'administrateur :</span><input type="text" name="mail_admin">            
        </div>
        <?php mysqli_free_result($result); ?>
        <?php include("footer.php"); ?>
    </body>
</html>
  