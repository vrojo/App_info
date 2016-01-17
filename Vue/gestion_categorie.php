<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>Gestion des catégories :</title>
        <meta charset="utf-8"/>
    </head>
    
    <link type="text/css" rel="stylesheet" href="../Style/gestion_categorie.css"/>

    <body>
        
        <?php include ("Header.php"); ?>
        <?php require("model.php");
				//nouvelle vérification que l'utilisateur est admin
              if (verifadmin($id_utilisateur) != 1){
                  header("Location:../Vue/Simplevent.php");
              }
        ?>
        <div class="gestion_categ">
        
        <div id="bloc_gestion_categ">
            <br>
        <div class="titre_gestion_categ">Gestion des catégories :</div>
        <br>
        <br>
             <?php modification_categorie() ?>
   
        </div>
        </div>
        <div id="bloc_ajout_categ">  
        <div class="titre_gestion_categ">Entrez un nom de catégorie à ajouter :</div>
        
        <br>
        <br>
        <br>
        <form action="gestion_categorie.php" method="post">
            <input type="text" placeholder="Nom de catégorie" name="nom_add_categorie" id="entrer_categ">
            <br>
            <br>
            <br>
            <input name="ajout_categ" type="submit" value="ajouter" id="bouton_back">
        </form>
        <br>
            <br>
           
        </div>
    
        
        <?php include("footer.php"); ?>
    </body>
    
</htm>


<?php
		// le post revient sur lui même
		//si on a rempli le formulaire :
        if (isset($_POST['ajout_categ'])){
            insert_categ($_POST['nom_add_categorie']);
                echo'<meta http-equiv="refresh" content="0; url="gestion_categorie.php" />';
        } 
        $result = affichage_categ_recherche_avancee();
        while($categorie = mysqli_fetch_assoc($result)) {
            if(isset($_POST[$categorie['id_categ']]) && empty($_POST[$categorie['nomCat']])){
                delete_categ($categorie['id_categ']);
                echo'<meta http-equiv="refresh" content="0; url="gestion_categorie.php" />';
            }
            else if(isset($_POST[$categorie['nomCat']])){
                update_categ($_POST[$categorie['nomCat']], $categorie['id_categ']);
                echo'<meta http-equiv="refresh" content="0; url="gestion_categorie.php" />';
            }
        }
        
                     
        
        ?>
        <?php mysqli_free_result($result); ?>