<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>Recherche d'événement :</title>
        <meta charset="utf-8"/>
    </head>
           <link type="text/css" rel="stylesheet" href="../Style/RechercheAvanceeFinale.css"/>

    <body>
        <?php include ("Header.php"); ?>
     
        
        
        
            <div id='titre_recherche'>Recherche d'événement :</br> </br> </div>

             <div id='formulaire_recherche'><form method="POST" action="Evenements2.php">
                    <span id="police_motscles">Mots clés:&nbsp; &nbsp; &nbsp;</span>
                
                    <div id="input_motscles"> <input type="text" name="mot_clef" placeholder="ex : Représentation "> </div>
                        <br/>
                        <br/>
                    <span id="police_categ">Catégorie d'événements :</span>
                        <br/>
                        <br/>
                    <div id="liste_categ"> 
                                  <?php require("model.php") ?>
                            <?php affichage_choix_recherche();?>
  
                    </div>
                        <br/>
                        <br/>
                    <span id="police_lieu"> Lieu de l'événement :</span>
                    <div id="input_lieu">
                        Ville : <input type="text" name="ville_evenement" placeholder="ex : Bordeaux"> <br/><br/>
                        Département : <input type="text" name="departement_evenement" placeholder="ex : 92">
                    </div>
                        <br/>
                        <br/>
                    <span id="police_date">Date de l'événement : <br/><br/></span>
              
                    <div id="input_date" > Entre le : <input type="date" id="date_recherche" name="date_debut" placeholder="jour / mois / année"/> et le : <input type="date"  id="date_recherche" name="date_fin" placeholder="jour / mois / année"/></div>
                        <br/>
                        <br/>
                        <br/>
                    <input type="submit" name ="Rechercher" value ="Rechercher" id="input_recherche">
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                
        </form>
                 
          <?php include('footer.php'); ?>
 
        </body>
    </html>