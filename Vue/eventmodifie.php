<?php
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Evénement modifié</title>
    </head>
	
    <body>
	<?php
	$connect = mysqli_connect('localhost', 'root', '', 'bddsimplevent');
		mysqli_set_charset($connect,"utf8");
		include ("Header.php"); 
		
	$event=mysqli_fetch_assoc(mysqli_query($connect, "select * from event join multimedia join adresse where principale=1 and event.Event_id=".$_GET['id_event'].""));
	
	if ($_POST['Nom_e']!=$event['Nom_e']) {
		mysqli_query($connect, "update event set Nom_e=".$_POST['Nom_e']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['numerorue']!=$event['numerorue']) {
		mysqli_query($connect, "update adresse set numerorue=".$_POST['Nom_e']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['rue']!=$event['rue']) {
				mysqli_query($connect, "update adresse set rue=".$_POST['rue']." where id_adresse=".$event['id_adresse']."");
	}
	
	elseif ($_POST['ville']!=$event['ville']) {
		mysqli_query($connect, "update adresse set ville=".$_POST['rue']." where id_adresse=".$event['id_adresse']."");
	}
	
	elseif ($_POST['codepostal']!=$event['codepostal']) {
		mysqli_query($connect, "update adresse set codepostal=".$_POST['codepostal']." where id_adresse=".$event['id_adresse']."");
	}
	
	elseif ($_POST['pays']!=$event['pays']) {
		mysqli_query($connect, "update adresse set pays=".$_POST['pays']." where id_adresse=".$event['id_adresse']."");
	}
	
	elseif ($_POST['prix']!=$event['prix']) {
		mysqli_query($connect, "update event set prix=".$_POST['prix']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['date_e']!=$event['date_e']) {
		mysqli_query($connect, "update event set date_e=".$_POST['date_e']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['date_f']!=$event['date_f']) {
		mysqli_query($connect, "update event set date_f=".$_POST['date_f']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['heuredebut']!=$event['heuredebut']) {
		mysqli_query($connect, "update event set heuredebut=".$_POST['heuredebut']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['heurefin']!=$event['heurefin']) {
		mysqli_query($connect, "update event set heurefin=".$_POST['heurefin']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['nb_max_participant']!=$event['nb_max_participant']) {
		mysqli_query($connect, "update event set nb_max_participant=".$_POST['nb_max_participant']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['nb_max_participant']!=$event['nb_max_participant']) {
		mysqli_query($connect, "update event set nb_max_participant=".$_POST['nb_max_participant']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['description_e']!=$event['description_e']) {
		mysqli_query($connect, "update event set description_e=".$_POST['description_e']." where Event_id=".$_GET['id_event']."");
	}
	
	elseif ($_POST['privacy']!=$event['privacy']) {
		mysqli_query($connect, "update event set privacy=".$_POST['privacy']." where Event_id=".$_GET['id_event']."");
	}
	
	$site_existant=mysqli_query($connect, "select exists (select urlsite_event from multimedia where event.Event_id=".$_GET['id_event']." and urlsite_event!=NULL");
	
	elseif ($site_existant==1 and $_POST['urlsite_event']!="") {
		$site=mysqli_fetch_assoc(mysqli_query($connect, "select urlsite_event from multimedia where Event_id=".$_GET['id_event'].""));
		$site=$site['urlsite_event'];
		mysqli_query($connect, "update multimedia set urlsite_event=".$_POST['urlsite_event']." where urlsite_event=$site");
	}
	
	elseif ($site_existant==0 and $_POST['urlsite_event']!="") {
		mysqli_query($connect, "insert into multimedia(urlsite_event, Event_id, principale) (".$_POST['urlsite_event'].", ".$_GET['id_event'].", 0)");
	}
	?>
	
	<div style="text-align:center; background:#74DEF1; float:left; clear:both;">
		<h1 style="color:white;">Votre événement a bien été modifié !</h1>
		<h3 style="color:white">Vous allez être redirigé vers la page d'accueil</h3>
	</div>
		<!--Redirection vers la page d'accueil-->
		<meta http-equiv="refresh" content="2; URL=../Vue/Accueil.php" />
	</body>
</html>