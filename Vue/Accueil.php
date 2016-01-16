<?php 
session_start();
$connect= mysqli_connect("localhost", "root", "", "bddsimplevent");
$Accueil=TRUE;

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<link type="text/css" rel="stylesheet" href="../Style/Accueil.css"/>

		<title>Accueil</title>
	</head>
	<body>
		<?php 
		include("Header.php");
		if (!isset($_SESSION['mot_de_passe']) OR !isset($_SESSION['id_utilisateur'])){
			header("Refresh:0 ,url=../Vue/Simplevent.php");
			session_destroy();
			exit();
			}
		if(verifco($_SESSION['mot_de_passe'],$_SESSION['id_utilisateur'])==FALSE){
			header("Refresh:0 ,url=../Vue/Simplevent.php");
			session_destroy();
			exit();
			}
			
		?>
	    <div id="bandeau1">
			<div class="bandeauhaut">
				<form method="post" action="../Vue/Evenements2.php?t=Search">
					<input type="search" name="mot_clef" id="recherche" placeholder="Ex:Tommorrow Land, Rock, Football..."> 
					<input type="submit" class="boutonrecherche" value="Recherche d'événements">
					
				</form>
                    <div id="b1bas"><a href="../Vue/RechAvan.php"><div class="Bouton" ><p>Recherche avancée</p></div></a></div>
			</div>
			<div class="bandeaubas">
                            <a href="../Vue/creationevent.php"><div class="Bouton"><p>Créer un événement</p></div></a>
			</div>
	    </div>
	    <div id="bandeau2">
			<?php 
			include ('carrousel2.php');
			?>
	    </div>
		<div id="bandeau3">
			<div class="blocsresume">
				<div class="bandeauhaut"style="height:10%">
					<p style="font-size:0.6em; color:grey;margin:0;">Messages</p>
				</div>
				<div class="bandeaubas" style="height:90%">
					<?php blocresum('message',$id_utilisateur)?>
				</div>
			</div>
			<div class="blocsresume" >
				<div class="bandeauhaut"style="height:10%;">
					<p style="font-size:0.6em; color:grey;margin:0;">Evénements créés</p>
				</div>
				<div class="bandeaubas" style="height:90%">
					<?php blocresum('eventcree',$id_utilisateur)?>
				</div>
			</div>
			<div class="blocsresume">
				<div class="bandeauhaut"style="height:10%">
					<p style="font-size:0.6em; color:grey;margin:0;">Vos événements</p>
				</div>
				<div class="bandeaubas" style="height:90%">
					<?php blocresum('eventparticipe',$id_utilisateur)?>
				</div>
			
			</div>
		</div>
		<img src="C://wamp/www/App_info/reste/photo_event/130404170223-seymour-roger-ebert-story-top.jpg"/>
	    <?php include("Footer.php"); ?>
	    
	</body>
</html>