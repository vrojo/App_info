<!DOCTYPE html>
<html>
    <head>
        
        <title>Gestion des catégories :</title>
        <meta charset="utf-8"/>
    </head>
    
           <link type="text/css" rel="stylesheet" href="gestion_categorie.css"/>

    <body>
        
        <?php include ("Header.php"); ?>
        <?php require("model.php") ?>
        <div class="gestion_categ">
        
        <div id="bloc_gestion_categ">
            <br>
        <div class="titre_gestion_categ">Gestion des catégories :</div>
        <br>
        <br>
             <?php $result = affichage_categ_recherche_avancee();
                $compteur = 1;
                
                
                if($compteur==1){
                    while($categorie = mysqli_fetch_assoc($result)) {
                        echo'<form action="gestion_categorie.php" method="post">        <span id="nom_categ">'.$categorie['nomCat'].'</span> <input type="text" class="zone_modification_categ" placeholder="modification" name='.$categorie['nomCat'].'> <input type="submit" value="supprimer/modifier" class="bouton_suppression_categ" name='.$categorie['id_categ'].'>      </form>';                               
                        
                    }
                    $compteur = 0;
                }
             ?>
             
        <br>
        <br>
   
        </div>
        <div id="bloc_gestion_categ">     
        <div class="titre_gestion_categ">Entrez un nom de catégorie à ajouter :</div>
        
        <br>
        <br>
        <form action="gestion_categorie.php" method="post">
            <input type="text" placeholder="Nom de catégorie" name="nom_add_categorie">
            <br>
            <br>
            <br>
            <input name="ajout_categ" type="submit" value="ajouter" id="bouton_back">
        </form>
        <br>
            <br>
           
        </div>
        </div>
    
        <?php
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
                update_categ($_POST[$categorie['nomCat']], $categorie['nomCat']);
                echo'<meta http-equiv="refresh" content="0; url="gestion_categorie.php" />';
            }
        }
        
                     
        
        ?>
        <?php mysqli_free_result($result); ?>
        <?php include("footer.php"); ?>
    </body>
    
</htm