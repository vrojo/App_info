<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/aide.css"/>
		<script type="text/javascript" src="../Controler/aide.js"></script>
		<title>Aide</title>
	</head>
	
	<body>
		<?php include("Header.php");?>
		<div id="partie_aide">
			<h2 id="titre">Aide générale</h2>
			<div id="questions">
				<div id="bloc_question">
					<!-- le span permet de faire : quand on clique dessus, ça lance la fonction JS et ça affiche la réponse à la question -->
					<span onclick="ouvrirfermer('reponse1')"><h3 class="question">Je n'arrive pas à me connecter, que faire ?</h3></span>
					<div class="reponse" id="reponse1">
						<p>Il suffit pour se connecter de cliquer sur "connexion", puis de renseigner ses identifiants.</p>
					</div>
					<span onclick="ouvrirfermer('reponse2')"><h3 class="question">Comment créer un événement ?</h3></span>
					<div class="reponse" id="reponse2">
						<p>Afin de créer un événement, il faut d'abord avoir un compte utilisateur. Enfin, sur chaque page, vous trouverez un bouton "créer un événement", via lequel vous pourrez créer un événement.</p>
					</div>
					<span onclick="ouvrirfermer('reponse3')"><h3 class="question">Comment supprimer un événement ?</h3></span>
					<div class="reponse" id="reponse3">
						<p>Sur la page de votre événement, il y a un bouton "Modifier l'événement" : celui-ci permet de modifier certains champs mais aussi de supprimer l'événement.</p>
					</div>
					<span onclick="ouvrirfermer('reponse4')"><h3 class="question">A quoi servent les centres d'interêts ?</h3></span>
					<div class="reponse" id="reponse4">
						<p>SimplEvent met tout en oeuvre pour vous apporter satisfaction, et cela passe par le fait de mieux vous connaître.</p>
					</div>
				</div>
			</div>
			<p>Si vous n'avez pas trouvé de réponse à votre question n'hésitez pas à parcourir le forum !</p>
			<div style="background-color:#62cbcb; text-align:center">
				<a href="../Vue/forum.php">
				<div id="bouton_vers_forum">
					<p>Forum</p>
				</div>
				</a>
			</div>
		</div>
		
		<?php include("footer.php");?>
	</body>
		<script type="text/javascript">
		//<!--
			ouverture();
		//-->
		</script>
</html>