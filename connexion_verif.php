<?php
    
    require'model.php';
    include("Header.php");
    
    if (empty($_POST['adrconnexion']) || empty($_POST['mdpconnexion']) ) //Oublie d'un champ
    {
	               echo'<!DOCTYPE html><html><head><title>Connexion</title><meta charset="utf-8"/>    </head>    <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>    <body>                                        <div id="titre_connexion">Erreur de connexion</br> Vous allez être redirigé sur la page de connexion.</br> </br></div>             <div id="formulaire_retour_accueil"><form method="POST" action="accueil.php">                                        <input type="submit" name ="Retour_accueil" value ="Retourner au site" id="input_retour_accueil"><br><br></form><meta http-equiv="refresh"  content="3; URL = connexion.php">         </body>    </html>';
                       include("footer.php");
                       
    }
    else
    {
        
       $verif = verification_mdp($_POST['adrconnexion']);
        
	if ( $verif['mot_de_passe'] == $_POST['mdpconnexion']) // Acces OK !
	{
	    $_SESSION['id_utilisateur'] = $verif['id_utilisateur'];
            $_SESSION['mot_de_passe']=$verif['mot_de_passe'];
            $_SESSION['admin_utilisateur'] = $verif['admin'];
            echo'<!DOCTYPE html><html><head><title>Connexion</title><meta charset="utf-8"/>    </head>    <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>    <body>                                       <div id="titre_connexion">Connexion établie</br> Vous allez être redirigé dans quelques secondes.</br></br></div>             <div id="formulaire_retour_accueil"><form method="_POST" action="accueil.php">                                        <input type="submit" name ="Retour_accueil" value ="Retourner au site" id="input_retour_accueil"><br><br></form></div><meta http-equiv="refresh"  content="3; URL = accueil.php">          </body>    </html>';
            include("footer.php");
	    
	}
	else // Acces pas OK !
	{
	               echo'<!DOCTYPE html><html><head><title>Connexion</title><meta charset="utf-8"/>    </head>    <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>    <body>                                        <div id="titre_connexion">Erreur de connexion</br> Vous allez être redirigé sur la page de connexion.</br> </br></div>             <div id="formulaire_retour_accueil"><form method="POST" action="accueil.php">                                        <input type="submit" name ="Retour_accueil" value ="Retourner au site" id="input_retour_accueil"><br><br></form><meta http-equiv="refresh"  content="3; URL = connexion.php">         </body>    </html>';
                       include("footer.php");
	}
    }


?>


    
