<?php
	session_start();
	require 'fonctions_simplevent.php'; 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="Simplevent.css"/>
		<title>Simplevent</title>
	</head>
	<body>
	    <div id="header">
	        <div class="bandeauhaut">
				<div class="headergauche"> 
					<div class="bandeauhaut" >
						<a href="#"><img src="https://www.dropbox.com/s/1yxbj2y807fn5eq/Logo4.png?raw=1" class="imagebandeau"/></a>
					</div>
					<div class="bandeaubas">
						<p style="font-size:1.5em;color:White;margin-left:2%">SimplEvent c'est le meilleur outil pour trouver des événements près de chez-vous</p>
					</div>
				</div>
				<div class="headerdroit">
                    <a href="connexion.php"><div class="Bouton"><p>Se connecter</p></div></a>
				</div>
			</div>
			<div class="bandeaubas">
				<div class="bandeauhaut">
					<form method="post" action="">
						<input type="text" name="recherche" id="recherche" placeholder="Ex:Tommorrow Land, Rock, Football..."/> 
						<input type="Submit" value="Recherche d'événement" class="boutonrecherche"/>
					</form>
				</div>
				<div class="bandeaubas">		
                    <div class="bandeauhaut"><a href="connexion.php"><div class="Bouton"><p>Créer un événement</p></div></a></div>
					<div class="bandeaubas"><a href="#bandeau1"><img src="https://www.dropbox.com/s/g65ek8637g0km8o/mince-fleche-vers-le-bas_318-11165.png?raw=1"id="flèchebas" title ='Venez voir en Bas !'/></a></div>
				</div>
			</div>
			
			
	    </div>
	    
	    <div id="bandeau1">
				<div id="carroussel">
					<a href="#"><div id="Eventcarr1" class="Eventcarr"><span>Rock en Seine</span></div></a>
					<a href="#"><div id="Eventcarr2" class="Eventcarr"><span>TomorrowLand</span></div></a>
					<a href="#"><div id="Eventcarr3" class="Eventcarr"><span>Color Run</span></div></a>  
					<a href="#"><div id="Eventcarr4" class="Eventcarr"><span>AC/DC Concert</span></div></a>
				</div>
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
		<?php include("footer.php"); ?>
	    
	</body>
</html>