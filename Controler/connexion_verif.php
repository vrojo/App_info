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
                <div style="text-align:center; width: 100%; height: 200px; background:#59b7ff; float:left; clear:both;"><h1 style="color:white;">Erreur de connexion</h1> <h3 style="color:white">Vous allez être redirigé vers la page de connexion.</h3></br> </br></div>
		<meta http-equiv="refresh"  content="0.5; URL = ../Vue/connexion.php"/>
					
                <?php
            }
            elseif (verif_confirmation($_POST['adrconnexion'])== True) {
                ?>
		<div style="text-align:center; width: 100%; height: 200px; background:#59b7ff; float:left; clear:both;"><h1 style="color:white;">Erreur de connexion</h1> <h3 style="color:white">Vous devez confirmer votre inscrition à partir du lien que vous avez reçu sur votre mail d'inscription.</h3></br> </br></div>
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
                    <div style="text-align:center; width: 100%; height: 200px; background:#59b7ff; float:left; clear:both;"><h1 style="color:white;">Connexion établie</h1> <h3 style="color:white">Vous allez être redirigé vers la page d'accueil.</h3></br> </br></div>
                    <meta http-equiv="refresh"  content="2; URL = ../Vue/accueil.php"/>
				<?php
		
		}
		else // Acces pas OK !
		{
                    ?>
                    <div style="text-align:center; width: 100%; height: 200px; background:#59b7ff; float:left; clear:both;"><h1 style="color:white;">Erreur de connexion</h1> <h3 style="color:white">Vous allez être redirigé vers la page de connexion.</h3></br> </br></div>
                    <meta http-equiv="refresh"  content="3; URL = ../Vue/connexion.php"/>
                    <?php
		}
            }
	include("footer.php");
?>
	</body>
	</html>
