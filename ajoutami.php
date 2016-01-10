<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="ajoutami.css"/>
		<title>Ajout d'ami</title>
	</head>
	
	<body>
		<?php
		include("Header.php");
		$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
		mysqli_set_charset($connect,"utf8");
		
		if (isset($_GET['id_utilisateur']) and isset($_GET['id_ami'])) {
			mysqli_query($connect, "insert into relation_amicale(id_utilisateur, id_ami) values (".$_GET['id_utilisateur'].", ".$_GET['id_ami'].")");
			mysqli_query($connect, "insert into relation_amicale(id_utilisateur, id_ami) values (".$_GET['id_ami'].", ".$_GET['id_utilisateur'].")");
			?>
			<div id="ajoutami">
				<h3>Cet utilisateur a bien été ajouté à vos amis !</h3>
				<h3>Vous allez être redirigé vers la page d'accueil de Simplevent</h3>
			</div>
			<?php
		}
		else {
			?>
			<div id="ajoutami">
				<h3>L'URL est faux !</h3>
				<h3>Vous allez être redirigé vers la page d'accueil de Simplevent</h3>
			</div>
			<?php
		}
		
		header ("Refresh: 5 ; URL=simplevent.php");
		include('footer.php');
		?>
	</body>
</html>