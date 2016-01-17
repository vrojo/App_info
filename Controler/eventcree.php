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
		require 'fonctions_crea_event.php';
		// On fait appel à la fonction insert_event permettant d'insérer les données récupérées du formulaire
		insert_event($_POST['sponsor1'], $_POST['sponsor2'], $_POST['sponsor3'], $_POST['sponsor4'], $_POST['codepostal'], $_POST['numerorue'], 
		nl2br(htmlspecialchars (addslashes($_POST['pays']))), nl2br(htmlspecialchars (addslashes($_POST['rue']))), nl2br(htmlspecialchars (addslashes($_POST['ville']))), $_POST['date_e'], $_POST['date_f'], nl2br(htmlspecialchars (addslashes($_POST['description_e']))), $_POST['heuredebut'], 
		$_POST['heurefin'], nl2br(htmlspecialchars (addslashes($_POST['nb_max_participant']))), nl2br(htmlspecialchars (addslashes($_POST['Nom_e']))), $_POST['privacy'], $_POST['prix'], nl2br(htmlspecialchars (addslashes($_POST['urlsite_event']))));
                
                // On fait une requête permettant de trouver le dernier événement créé, celui-ci est l'événement en cours de création
                $id_event = mysqli_fetch_assoc(mysqli_query($connect, "select max(Event_id) as max from event"));
                $idevent = $id_event['max'];	
				// On précise le chemin dans lequel seront sauvegardées les images
                $uploaddir = '../reste/photo_event/';
				// On attribue un chemin au fichier à télécharger composé du chemin défini au dessus ainsi que du nom du fichier
                $uploadfile1 = $uploaddir.$_FILES['photo_principale']['name'];
				// On exécute la fonction permettant de télécharger le fichier
				upload('photo_principale',$uploadfile1,20000000, array('png','gif','jpg','jpeg','PNG','JPG'));                
                mysqli_query($connect, "insert into multimedia(Event_id, urlimg_event, principale) values ('$idevent', '$uploadfile1', 1)");
               // On vérifie en suite qu'une autre image a été fournie par l'utilisateur et ainsi de suite
               if ($_FILES['photo_secondaire']['size']!=0) {
				$uploadfile2 = $uploaddir.$_FILES['photo_secondaire']['name'];
				upload('photo_secondaire',$uploadfile2,20000000, array('png','gif','jpg','jpeg','PNG','JPG'));   
				mysqli_query($connect, "insert into multimedia(Event_id, urlimg_event, principale) values ('$idevent', '$uploadfile2', 0)");
		
				if ($_FILES['photo_trois']['size']!=0) {
					$uploadfile3 = $uploaddir.$_FILES['photo_trois']['name'];
					upload('photo_trois',$uploadfile3,20000000, array('png','gif','jpg','jpeg','PNG','JPG'));   	
					mysqli_query($connect, "insert into multimedia(Event_id, urlimg_event, principale) values ('$idevent', '$uploadfile3', 0)");
						
					if ($_FILES['photo_quatre']['size']!=0) {
						$uploadfile4 = $uploaddir.$_FILES['photo_quatre']['name'];
						upload('photo_quatre',$uploadfile4,20000000, array('png','gif','jpg','jpeg','PNG','JPG'));   
						mysqli_query($connect, "insert into multimedia(Event_id, urlimg_event, principale) values ('$idevent', '$uploadfile4', 0)");
					}
				}
			}
        ?>
		
		<div style="text-align:center; background:#74DEF1; width:100%; height:200px; float:left; clear:both;">
			<h1 style="color:white;">Votre événement a bien été créé !</h1>
			<h3 style="color:white">Vous allez être redirigé vers la page d'accueil</h3>
		</div>
        <?php include 'footer.php';?>
		<!--Redirection vers la page d'accueil-->
		<meta http-equiv="refresh" content="2; URL=../Vue/Accueil.php" />
    </body>
</html>