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
		$_POST['heurefin'], $_POST['nb_max_participant'], $_POST['Nom_e'], $_POST['privacy'], $_POST['prix'], $_POST['urlsite_event']);
                
                
                $id_event = mysqli_fetch_assoc(mysqli_query($connect, "select max(Event_id) as max from event"));
                $idevent = $id_event['max'];
                $uploaddir = 'C://wamp/www/App_info/reste/photo_event/';
                $nomphoto1='Event'.$idevent.'_1.png';
				$uploadfile1 = $uploaddir."$nomphoto1";
                move_uploaded_file($_FILES['photo_principale']['tmp_name'], $uploadfile1);
			
                mysqli_query($connect, "insert into multimedia(Event_id, urlimg_event, principale) values ('$idevent', '$nomphoto1', 1)");
               
                if ($_FILES['photo_secondaire']['size']!=0) {
		$uploadfile2 = $uploaddir.$_FILES['photo_secondaire']['name'];
		$idevent = $id_event['max'];
		$nomphoto2='Event'.$idevent.'_2.png';
		$uploadfile2 = $uploaddir."$nomphoto2";
		move_uploaded_file($_FILES['photo_secondaire']['tmp_name'], $uploadfile2);
                
		mysqli_query($connect, "insert into multimedia(Event_id, principale, urlimg_event, principale) values ('$idevent', '$nomphoto2', 0)");
		
		if ($_FILES['photo_trois']['size']!=0) {
			$uploadfile3 = $uploaddir.$_FILES['photo_trois']['name'];
			$idevent = $id_event['max'];
			$nomphoto3='Event'.$idevent.'_3.png';
			$uploadfile3 = $uploaddir."$nomphoto3";
			move_uploaded_file($_FILES['photo_trois']['tmp_name'], $uploadfile3);
                        
			mysqli_query($connect, "insert into multimedia(Event_id, principale, urlimg_event, principale) values ('$idevent', '$nomphoto3', 0)");
			
			if ($_FILES['photo_quatre']['size']!=0) {
				$uploadfile4 = $uploaddir.$_FILES['photo_secondaire']['name'];
				 $idevent = $id_event['max'];
				 $nomphoto4='Event'.$idevent.'_4.png';
				$uploadfile4 = $uploaddir."$nomphoto4"
				move_uploaded_file($_FILES['photo_quatre']['tmp_name'], $uploadfile4);
                               
				mysqli_query($connect, "insert into multimedia(Event_id, principale, urlimg_event, principale) values ('$idevent', '$uploadfile4', 0)");
			}
		}
	}
        ?>
		
		<div style="text-align:center; back-ground-color:#74DEF1">
			<h1 style="color:white;">Votre événement a bien été créé !</h1>
			<h3 style="color:white">Vous allez être redirigé vers la page d'accueil</h3>
		</div><!--
		<meta http-equiv="refresh" content="2; URL=../Vue/Accueil.php"/>--> 
    </body>
</html>