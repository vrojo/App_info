<?php include("model.php")?>
<?php
		// On fait des tests sur la valeur des posts pour renvoyer vers les bonnes Vues
        if (isset($_POST['ajout_categ'])){
            insert_categ($_POST['nom_add_categorie']);
            include("gestion_categorie.php");
        } 
        $result = affichage_categ_recherche_avancee();
        while($categorie = mysqli_fetch_assoc($result)) {
            if(isset($_POST[$categorie['id_categ']]) && empty($_POST[$categorie['nomCat']])){
                delete_categ($categorie['id_categ']);
                include("gestion_categorie.php");
            }
            else if(isset($_POST[$categorie['nomCat']])){
                update_categ($_POST[$categorie['nomCat']], $categorie['id_categ']);
                include("gestion_categorie.php");
            }
        }
        
                     
        
        ?>
        <?php mysqli_free_result($result); ?>


