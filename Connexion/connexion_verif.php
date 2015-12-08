<?php 
	session_start();
    require'../globaux/model.php';
    if (empty($_POST['adrconnexion']) || empty($_POST['mdpconnexion']) ) //Oublie d'un champ
    {
        echo'<div class="message_erreur"> <p>Erreur de connexion</p></div> <input type="submit" action="connexion.php">';
    }
    else
    {
        
       $verif = verification_mdp($_POST['adrconnexion']);
        
	if ( $verif['mot_de_passe'] == $_POST['mdpconnexion']) // Acces OK !
	{
	    $_SESSION['id'] = $verif['id_utilisateur'];
		$_SESSION['mot_de_passe']=$verif['mot_de_passe'];
            $_SESSION['admin'] = $verif['admin'];
            echo'<!DOCTYPE html><html><head><title>Connexion</title><meta charset="utf-8"/>    </head>    <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>    <body>        <?php include ("Header.php"); ?>        <?php require("model.php") ?>                                 <div id="titre_connexion">Connexion établie</br> </br> </div>             <div id="formulaire_retour_accueil"><form method="POST" action="../ACCUEIL/accueil.php">                                        <input type="submit" name ="Retour_accueil" value ="Retourner au site" id="input_retour_accueil"><br><br></form><?php include("footer.php"); ?>         </body>    </html>';
            
	    
	}
	else // Acces pas OK !
	{
	    echo'<div class="message_erreur"> <p>Erreur de connexion</p></div> <input type="submit" action="connexion.php">';
	}
    }


?>


    
