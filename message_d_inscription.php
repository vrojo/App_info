<!DOCTYPE html>
<html>
    <head>
	<title>Inscription</title>
	<meta charset="utf-8"/>
        <link type="text/css" rel="stylesheet" href="connexion_verif.css"/>
    </head>       
    
    <body>
        <?php
            include("model.php");
            include("Header.php");
            inscrtionpreleminaire($_POST['mail'], $_POST['mdpconnexion'], $_POST['mdpconnexion_verif']);
            $mail_utilisateur = $_POST['mail'];
            $mail_sujet = "Votre inscription sur Simplevent";
            $message = "test";
            mail($mail_utilisateur, $mail_sujet, $message);         
            include("footer.php")           
        ?>
    </body>
</html>



