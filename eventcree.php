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
                
                $uploaddir = 'C://wamp/www/App_info/reste/photo_event/';
                $uploadfile1 = $uploaddir.$_FILES['photo_principale']['name'];
                move_uploaded_file($_FILES['photo_principale']['tmp_name'], $uploadfile1);
                
                $idevent = $id_event['max'];
                mysqli_query($connect, "insert into multimedia(Event_id, urlimg_event, principale) values ('$idevent', '$uploadfile1', 1)");
               
                if ($_FILES['photo_secondaire']['size']!=0) {
		$uploadfile1 = $uploaddir.$_FILES['photo_secondaire']['name'];
		move_uploaded_file($_FILES['photo_secondaire']['tmp_name'], $uploadfile1);
                $idevent = $id_event['max'];
		mysqli_query($connect, "insert into multimedia(Event_id, principale, urlimg_event, principale) values ('$idevent', '$uploadfile2', 0)");
		
		if ($_FILES['photo_trois']['size']!=0) {
			$uploadfile3 = $uploaddir.$_FILES['photo_trois']['name'];
			move_uploaded_file($_FILES['photo_trois']['tmp_name'], $uploadfile1);
                        $idevent = $id_event['max'];
			mysqli_query($connect, "insert into multimedia(Event_id, principale, urlimg_event, principale) values ('$idevent', '$uploadfile3', 0)");
			
			if ($_FILES['photo_quatre']['size']!=0) {
				$uploadfile4 = $uploaddir.$_FILES['photo_secondaire']['name'];
				move_uploaded_file($_FILES['photo_quatre']['tmp_name'], $uploadfile1);
                                $idevent = $id_event['max'];
				mysqli_query($connect, "insert into multimedia(Event_id, principale, urlimg_event, principale) values ('$idevent', '$uploadfile4', 0)");
			}
		}
	}
        header("Location : Accueil.php");
        ?>
    </body>
</html>