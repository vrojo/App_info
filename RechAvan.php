<!DOCTYPE html>
<html>
    <head>
        
        <title>Recherche d'événement :</title>
        <meta charset="utf-8"/>
    </head>
           <link type="text/css" rel="stylesheet" href="RechercheAvanceeFinale.css"/>

    <body>
        <?php include ("Header.php"); ?>
        <?php require("model.php") ?>
     
        
        
        
            <div id='titre_recherche'>Recherche d'événement :</br> </br> </div>

             <div id='formulaire_recherche'><form method="POST" action="Recherche">
                    <span id="police_motscles">Mots clés:&nbsp; &nbsp; &nbsp;</span>
                
                    <div id="input_motscles"> <input type="text" name="mots clés" placeholder="ex : Représentation "> </div>
                        <br/>
                        <br/>
                    <span id="police_categ">Catégorie d'événements :</span>
                        <br/>
                        <br/>
                    <div id="liste_categ"> 
                        <select name="categories"  multiple>
                            <?php $result = affichage_categ_recherche_avancee();
                      
                                 while($categorie = mysqli_fetch_assoc($result)) {
                                        echo'<option value=/"'.$categorie['id'].'/">'.$categorie['nomCat'].'</option>';                               
                        
                                 }
                                    ?>
                            <?php mysqli_free_result($result); ?>
  
                        </select>
                    </div>
                        <br/>
                        <br/>
                    <span id="police_lieu"> Lieu de l'événement :</span>
                    <div id="input_lieu"><input type="text" name="lieuevenement" placeholder="ex : Bordeaux"></div>
                        <br/>
                        <br/>
                    <span id="police_date">Date de l'événement : <br/><br/></span>
              
                    <div id="input_date" > Entre le : <input type="date" id="date_recherche" placeholder="jour / mois / année"/> et le : <input type="date"  id="date_recherche" placeholder="jour / mois / année"/></div>
                        <br/>
                        <br/>
                        <br/>
                    <input type="submit" name ="Rechercher" value ="Rechercher" id="input_recherche">
                    <br>
                    <br>
        </form>
                 
          <?php include('footer.php'); ?>
 
        </body>
    </html>