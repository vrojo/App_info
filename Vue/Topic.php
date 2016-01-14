<?php 
session_start();
$id_utilisateur=$_SESSION['id_utilisateur']

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/Topic.css"/>
		<script type="text/javascript" src="../Modele/Eventmap.js"></script>
		<title>Forum SimplEvent</title>		
	</head>
	
	<body>
		<?php
		include("Header.php");	
		require 'fonctions_topic.php'; 
		?>
		<div id="Corps_forum">
			<div id="sujet">
				
			</div>
			<div id="bandeau2_1" style="height:100px">
				<a href=#bandeau2_2><div class="Bouton2" style="width:50%;height:50px"><p>Ajouter un commentaire</p></div></a>
			</div>
			<div id="bandeau2" style="height:auto">
				<?php 
					coms($_GET['Topic'])
				?>
			</div>
			<div id="bandeau2_2" >
				<form method="post" style="height:100%" action="../Controler/addcom.php">
					<textarea name="Commentaire" placeholder="Entrez votre commentaire" id="Zonecom"></textarea>
					<input type="hidden" name="Topic" value= <?php echo $_GET['Topic'] ?> />
					<input type="submit" name="envoyer" value="Envoyer" id="Boutoncom"/>
				</form>
			</div>
		</div>
	</body>
	</head>
</html>