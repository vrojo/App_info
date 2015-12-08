<?php 
session_start();
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
function verifco($mdp,$id_utilisateur){
	global $connect_e;
	$result=mysqli_query($connect_e, "SELECT mot_de_passe from utilisateur where id_utilisateur=$id_utilisateur");
	$result=mysqli_fetch_assoc($result);
	$motpasse=$result['mot_de_passe'];
	if ($mdp==$motpasse){
		return TRUE;
	}
	else{
		return FALSE;
	}
	
}

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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="Accueil.css"/>
		<title>Accueil</title>
	</head>
	<body>
		<div id="header">
	        <div class="bandeauhaut">
				<div id="headergauche"> 
					<a href="#"><img src="https://www.dropbox.com/s/1yxbj2y807fn5eq/Logo4.png?raw=1" class="imagebandeau"/></a>
				</div>
				<div id="headerdroit">
					<!--<a href="#"><div class="Bouton"><p>Se connecter</p></div></a>-->
				</div>
			</div>
			<div class="bandeaubas">
				<div id="menu">
                                    <a href="Accueil.php"><div class="Boutonmenu"><p>Accueil</p> 
					</div></a>
					<a href="#"><div class="Boutonmenu"><p>Evénements</p> 
					</div></a>
					<a href="#"><div class="Boutonmenu"><p>Mon Compte</p>
					</div></a>  
					<a href="deconnexion.php"><div class="Boutonmenu"><p>Déconnexion</p>
					</div></a>
				</div>
			</div>
			
	    </div>
	    
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
			<div class="blocsresume"><?php  ?></div>
			<div class="blocsresume"></div>
			<div class="blocsresume"></div>
		</div>
	    <?php include("Footer.php"); ?>
	    
	</body>
</html>