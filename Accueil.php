<?php 
session_start();
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
$Accueil=TRUE;

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="Accueil.css"/>
		<title>Accueil</title>
	</head>
	<body>
		<?php 
		include("Header.php");
		if (!isset($_SESSION['mot_de_passe']) OR !isset($_SESSION['id_utilisateur'])){
			header("Refresh:0 ,url=Simplevent.php");
			session_destroy();
			exit();
			}
		if(verifco($_SESSION['mot_de_passe'],$_SESSION['id_utilisateur'])==FALSE){
			header("Refresh:0 ,url=Simplevent.php");
			session_destroy();
			exit();
			}
		?>
	    <div id="bandeau1">
			<div class="bandeauhaut">
				<form method="post" action="">
					<input type="search" name="recherche" id="recherche" placeholder="Ex:Tommorrow Land, Rock, Football..."> 
					<input type="submit" class="boutonrecherche" value="Recherche d'événements">
					
				</form>
                    <div id="b1bas"><a href="RechAvan.php"><div class="Bouton" ><p>Recherche avancée</p></div></a></div>
			</div>
			<div class="bandeaubas">
                            <a href="creationevent.php"><div class="Bouton"><p>Créer un événement</p></div></a>
			</div>
	    </div>
	    <div id="bandeau2">
			<div id="carroussel">
				<a href="#"><div id="Eventcarr1" class="Eventcarr"><p>Rock en Seine</p></div></a>
				<a href="#"><div id="Eventcarr2" class="Eventcarr"><p>TomorrowLand</p></div></a>
				<a href="#"><div id="Eventcarr3" class="Eventcarr"><p>Color Run</p></div></a>  
				<a href="#"><div id="Eventcarr4" class="Eventcarr"><p>AC/DC Concert</p></div></a>
			</div>
	    </div>
		<div id="bandeau3">
			<div class="blocsresume"><?php ?></div>
			<div class="blocsresume"></div>
			<div class="blocsresume"></div>
		</div>
	    <?php include("Footer.php"); ?>
	    
	</body>
</html>