<?php
    session_start();
    require'model.php';
    if (empty($_POST['adrconnexion']) || empty($_POST['mdpconnexion']) ) //Oublie d'un champ
    {
        echo'<div class="message_erreur"> <p>Erreur de connexion</p></div> <input type="submit" action="connexion.php"><meta http-equiv="refresh"  content="5; URL = connexion.php">';
    }
    else
    {
        
       $verif = verification_mdp($_POST['adrconnexion']);
        
	if ( $verif['mot_de_passe'] == $_POST['mdpconnexion']) // Acces OK !
	{
	    $_SESSION['id_utilisateur'] = $verif['id_utilisateur'];
            $_SESSION['mot_de_passe']=$verif['mot_de_passe'];
            $_SESSION['admin_utilisateur'] = $verif['admin'];
            echo'<!DOCTYPE html><html><head><title>Connexion</title><meta charset="utf-8"/>    </head>    <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>    <body>        <?php includ7e ("Header.php"); ?>        <?php require("model.php") ?>                                 <div id="titre_connexion">Connexion établie</br> </br> </div>             <div id="formulaire_retour_accueil"><form method="_POST" action="accueil.php">                                        <input type="submit" name ="Retour_accueil" value ="Retourner au site" id="input_retour_accueil"><br><br></form><meta http-equiv="refresh"  content="3; URL = accueil.php"><?php include("footer.php"); ?>         </body>    </html>';
            
	    
	}
	else // Acces pas OK !
	{
	               echo'<!DOCTYPE html><html><head><title>Connexion</title><meta charset="utf-8"/>    </head>    <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>    <body>        <?php include ("Header.php"); ?>        <?php require("model.php") ?>                                 <div id="titre_connexion">Erreur de connexion</br> </br> </div>             <div id="formulaire_retour_accueil"><form method="POST" action="accueil.php">                                        <input type="submit" name ="Retour_accueil" value ="Retourner au site" id="input_retour_accueil"><br><br></form><meta http-equiv="refresh"  content="3; URL = connexion.php"><?php include("footer.php"); ?>         </body>    </html>';

	}
    }


?>


    
