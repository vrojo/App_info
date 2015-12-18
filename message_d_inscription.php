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
            envoimail_confirmation($_POST['mail']);          
        ?>

    </body>
</html>



