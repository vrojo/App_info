<?php
	session_start();
	require 'fonctions_simplevent.php'; 
?>
<!-- Page d'accueil lorsque l'utilisateur n'est pas connecté -->
<!DOCTYPE html>
<html>
	<head>
		<!-- comme sur toutes nos pages, cette balise meta permet l'utilisation de caractères spéciaux -->
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/Simplevent.css"/>
		<title>Simplevent</title>
	</head>
	<body>
	    <div id="header">
	        <div class="bandeauhaut">
				<div class="headergauche"> 
					<div class="bandeauhaut" >
							<!-- chemin relatif du logo, qui est hebergé sur le serveur -->
						<a href="#"><img src="../reste/images/Logo.png" class="imagebandeau"/></a>
					</div>
					<div class="bandeaubas">
						<p style="font-size:1.5em;color:White;margin-left:2%">SimplEvent est le site qui vous permettra de créer, partager et de participer à des événements le plus simplement possible</p>
					</div>
				</div>
				<div class="headerdroit">
                    <a href="connexion.php"><div class="Bouton"><p>Se connecter</p></div></a>
				</div>
			</div>
			<div class="bandeaubas">
				<div class="bandeauhaut">
					<form method="post" action="../Vue/Evenements2.php?t=Search">
						<input type="text" name="mot_clef" id="recherche" placeholder="Ex:Paris, Rock, Football..."/> 
						<input type="Submit" value="Recherche d'événement" class="boutonrecherche"/>
					</form>
				</div>
				<div class="bandeaubas">		
                    <div class="bandeauhaut"><a href="connexion.php"><div class="Bouton"><p>Créer un événement</p></div></a></div>
					<div class="bandeaubas"><a href="#bandeau1"><img src="../reste/images/flechebas.png"id="flèchebas" title ='Venez voir en Bas !'/></a></div>
				</div>
			</div>
	    </div>
		
		<!-- Le site utilise beaucoup de javascript, cette balise affichera un message si le JS n'est pas activé -->
		<noscript>
			<h3 style="background-color:#74DEF1 ; color:white; text-align:center;">Pour profiter pleinement de cette page, et de l'ensemble du site Internet, veuillez activer l'utilisation de Javascript sur votre navigateur web</h3>
		</noscript>
	    
	    <div id="bandeau1">
			<!-- carrousel souvent utilisé, donc création d'une fonction qu'on appelle quand nécessaire -->
			<?php 
			include ('carrousel2.php');
			?>
	    </div>
	    <div id="bandeau2">
			<div class="bandeauhaut">
				<p class="texteb2">Simplifiez-vous la vie</p>
				<p class="texteb2">Ne ratez jamais un événement</p>
				<p class="texteb2">SimplEvent c'est</p>

			</div>
			<div class="bandeaubas">
					<p class="texteb2">Organisez mieux vos événements, libérez vous de cette charge de travail. Recherchez plus facilement les événements près de chez vous !</p>
					<p class="texteb2">Recevez des notifications pour tous les événements à ne pas rater ou pour ceux qui correspondent à vos attentes.</p>
					<ul class="texteb2">
						<li>déjà <?php echo "$Nb_event" ?> événements et <?php echo "$Nb_utilisateurs" ?> utilisateurs,</li>
						<li>95% de satisfaction,</li>
						<li>100% de création de souvenirs !</li>
					</ul>
			</div>
	    </div>
		<div id="bandeau3">
			<p> Rejoignez Simplevent</p>
                        <a href="connexion.php"><div class="Bouton"><p>S'inscrire/ se connecter</p></div></a>
		</div>
		
		<!-- le footer est tjrs le même sur le site, d'où l'utilisation d'une fonction include -->
		<?php include("footer.php"); ?>
	    
	</body>
</html>