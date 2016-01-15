<?php
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Evénement créé</title>
    </head>
    <body>
		<?php include ("Header.php");
		//$urlsite
		require 'fonctions_crea_event.php';
		insert_event($_POST['sponsor1'], $_POST['sponsor2'], $_POST['sponsor3'], $_POST['sponsor4'], $_POST['codepostal'], $_POST['numerorue'], 
		$_POST['pays'], $_POST['rue'], $_POST['ville'], $_POST['date_e'], $_POST['date_f'], $_POST['description_e'], $_POST['heuredebut'], 
		$_POST['heurefin'], $_POST['nb_max_participant'], $_POST['Nom_e'], $_POST['privacy'], $_POST['prix'], $_POST['photo_principale'], 
		$_POST['photo_secondaire'], $_POST['photo_trois'], $_POST['photo_quatre'], $_POST['urlsite_event']);
 
        header("Refresh:5, location=Accueil.php");
        ?>
    </body>
</html>