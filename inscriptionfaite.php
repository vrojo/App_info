<?php

require 'fonctions_inscription.php';
insert_utilisateur($_POST['nom_u'], $_POST['prenom_u'], $_POST['adresse'], $_POST['mail'], $_POST['telephone'], $_POST['mot_de_passe'], $_POST['date_de_naissance'], $_POST['description'], $_POST['photo_u']);
echo'<meta http-equiv="refresh"  content="5; URL = Simplevent.php">'
?>

<!DOCTYPE html><html><head><title>Inscription</title><meta charset="utf-8"/>    </head>    <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>    <body>        <?php include ("Header.php"); ?>        <?php require("model.php") ?>                                 <div id="titre_connexion">Vous êtes inscrit !</br> </br> </div>             <div id="formulaire_retour_accueil"><form method="_POST" action="Simplevent.php">                                        <input type="submit" name ="Retour_accueil" value ="Retourner au site" id="input_retour_accueil"><br><br></form><meta http-equiv="refresh"  content="3; URL = Simplevent.php"><?php include("footer.php"); ?>         </body>    </html>';
