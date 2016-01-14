<?php
    session_start();
    require'model.php';
    ?>
    <!DOCTYPE html>
        <html>
            <head>
		<title>Connexion</title>
        	<meta charset="utf-8"/>
		<link type="text/css" rel="stylesheet" href="../Style/connexion_verif.css"/>
            </head>        
            <body>
            <?php
	
            include("Header.php");
    
            if (empty($_POST['adrconnexion']) || empty($_POST['mdpconnexion']) ){ //Oublie d'un champ
	            ?>
                <div id="titre_connexion">Erreur de connexion</br> Vous allez être redirigé sur la page de connexion.</br> </br></div>
		<meta http-equiv="refresh"  content="0.5; URL = ../Vue/connexion.php"/>
					
                <?php
            }
            elseif (verif_confirmation($_POST['adrconnexion'])== True) {
                ?>
		<div id="titre_connexion">Erreur de connexion</br> Vous devez confirmer votre inscrition à partir du lien que vous avez reçu sur votre mail d'inscription.</br> </br></div>
		<meta http-equiv="refresh"  content="0.5; URL = ../Vue/connexion.php"/>	
                <?php
        
            }
            else{
        
                $verif = verification_mdp($_POST['adrconnexion']);
        
		if ( $verif['mot_de_passe'] == $_POST['mdpconnexion']){ // Acces OK !
                    $_SESSION['id_utilisateur'] = $verif['id_utilisateur'];
                    $_SESSION['mot_de_passe']=$verif['mot_de_passe'];
                    $_SESSION['admin_utilisateur'] = $verif['admin'];
                    ?>
                    <div id="titre_connexion">Connexion établie</br> Vous allez être redirigé sur la page d'accueil.</br> </br></div>
                    <meta http-equiv="refresh"  content="2; URL = ../Vue/accueil.php"/>
				<?php
		
		}
		else // Acces pas OK !
		{
                    ?>
                    <div id="titre_connexion">Erreur de connexion</br> Vous allez être redirigé sur la page de connexion.</br> </br></div>
                    <meta http-equiv="refresh"  content="3; URL = ../Vue/connexion.php"/>
                    <?php
		}
            }
	include("footer.php");
?>
	</body>
	</html>
