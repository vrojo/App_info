<?php session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="Events.css"/>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTJ7EKiUmBXBsHrnojWCg36xdAKObOLqM"></script>
		<script type="text/javascript" src="Eventmap.js"></script>
		
		<title>Evénements</title>	
	</head>
	<body onload="Eventmap()" >
		<?php
		include("Header.php");
		require'fonctions_event.php';
		
		?>
		<div id="bandeaupresevent" style="height:<?php echo $hbandeaupres ?>px"  >
			<div class="bleft" >
				<div class="bandeauhaut"><div class="Eventpic" style="background-image:url(http://www.rockenseine.com/wp-content/uploads/2015/09/VP2_7163RES-1024x683.jpg)"></div></div>
				<div class="bandeaubas" ><div id="map" style="width:95%;height:95%;left:50%;top:50%;transform:translate(-50%,-50%);"></div></div>
			</div>
			<div class="bright">
				<div class="bandeauhaut" style="height:10%;"><p style="font-size:1.4em; transform:translateY(-50%)"><?php echo $nom_e ?></p></div>
				<div class="bandeaumilieu" style="height:70%">
					<div class="bandeauhaut" style="height:30%">
						<div class="bleft" style="width:50%;">
							<div class="bleft" style="width:10%">
								<a href="#"><img src="https://www.dropbox.com/s/jmzi3lowgiry5wf/Bonhommevert.png?raw=1" style="width:100%"/></a>
								<a href="#"><img src="https://www.dropbox.com/s/33ldf4ajvhvh3hz/EIpgSD2K.png?raw=1" style="width:100%"/></a>
								<a href="#"><img src="https://www.dropbox.com/s/vpzc9y04zixn2lg/fb_icon_325x325.png?raw=1"style="width:100%"/></a>
								<a href="#"><img src="https://www.dropbox.com/s/0h0kmbxsicya03r/ajouter-un-nouveau-bouton-plus_318-9157.png?raw=1" style="width:100%"/></a>
							</div>
							<div class="bright" style="width:90%">
								<div class="bandeauhaut" style="height:33%; text-align:left;">
									<?php if ($prix==0)
										{
											echo "<p> Gratuit </p>";
										}
										else
										{
											echo "<p style='margin-left:20px'>Prix: $prix Euros</p>";
										}
									?>
								</div>
								<div class="bandeaumilieu" style="height:33%; text-align:left;">
									<div class="rating">
										<a id="star5" title="Donner 5 étoiles" onclick="noter(5,<?php echo $Event_id ?>)">★</a>
										<a id="star4" title="Donner 4 étoiles" onclick="noter(4,<?php echo $Event_id ?>)">★</a>
										<a id="star3" title="Donner 3 étoiles" onclick="noter(3,<?php echo $Event_id ?>)">★</a>
										<a id="star2" title="Donner 2 étoiles" onclick="noter(2,<?php echo $Event_id ?>)">★</a>
										<a id="star1" title="Donner 1 étoile" onclick="noter(1,<?php echo $Event_id ?>)">★</a>
									</div>
								</div>
								<div class="bandeaubas" style="height:33%; text-align:left">
									<p style="margin-left:20px"> Il reste 12 places</p>
								</div>
							</div>
						</div>
						<div class="bright" style="width:50%;">
							<?php if ($privacy == 1){ ?>
								<p style="height:<?php echo $h?>%; display:inline-block; position: relative;margin:0;"> cet événement est privé</p>
							<?php }
							?><?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
							<a href="#"><div class="Bouton2" onclick=(inscriptionevent(<?php echo $Event_id ?>)) style="height:<?php echo $h ?>%"><p><?php des_inscrire() ?></p></div></a>
							<a href="#"><div class="Bouton2" style="height:<?php echo $h ?>%"><p>Acheter un Billet</p></div></a><?php }?>
							<a href="#"><div class="Bouton2" style="height:<?php echo $h ?>%"><p>Site internet de l'événement</p></div></a>
							<?php if ($Id_crea==$id_utilisateur) {
							?><a href="#"><div class="Bouton2" style="height:<?php echo $h ?>%"><p>Modifier l'événement</p></div></a><?php }?>
						</div>
					</div>
					<div class="bandeaubas" style="height:50%;">
						<div class="bleft" >
							<h2> Informations </h2>
							<p style="font-weight:normal; font-size:0.7em"><?php echo $event['description_e']?></p>
						</div>
						<div class="bright" style="font-weight:normal; font-size:0.7em;">
							<p>Date de l'événement: <?php echo $event['date_e']?></p>
							<p>Nombre de participants maximum: <?php echo $event['nb_max_participant']?></p>
						</div>
					</div>
				</div>
				<?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
				<div class="bandeaubas" style="height:20%;text-align:left;">
					<div class="bandeauhaut" style="height:50%">
						<div class="bandeauhaut" style="height:25%">
							Catégorie d'événement:
						</div>
						<div class="bandeaubas" style="height:75%">
						</div>
					</div>
					
					<div class="bandeaubas" style="height:50%">
						<div class="bleft" style="width:75%; height:100%">
							<div class="bandeauhaut" style="height:25%;">
								Ils y participent
							</div>
							<div class="bandeaubas" style="height:75%;">
								<div class="carroussel">
									<?php carrousselprofiles();?>
								</div>
							</div>
						</div>
						<div class="bright" style="width:25%; height:100%; font-size:0.5em;">
							<a href="#"><p>Signaler cet événement</p></a>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
		<div id="bandeau1">
			<div class="bleft" >
				<h4>Sponsorisé par</h4>
				<img src="https://upload.wikimedia.org/wikipedia/fr/4/47/Isep-Logo.png" style="width:100%;max-height:90%;"/>
				
			</div>
			<div class="bright">
			</div>
		</div>
		<?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
		<div id="bandeau2_1" style="height:100px">
			<a href=#bandeau2_2><div class="Bouton2" style="width:50%;height:50px"><p>Ajouter un commentaire</p></div></a>
		</div>
		<?php } ?>
		<div id="bandeau2" style="height:<?php echo $Nb_comment ?>px">
			<?php coms($Event_id) ?>
		</div>
		<?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
		<div id="bandeau2_2" >
			<form method="post" style="height:100%" action="addcom.php">
				<textarea name="Commentaire" placeholder="Entrez votre commentaire" id="Zonecom"></textarea>
				<input type="hidden" name="Event_id" value= <?php echo $Event_id ?> />
				<input type="submit" name="envoyer" value="Envoyer" id="Boutoncom"/>
			</form>
		</div> <?php } ?>
		<div id="bandeau3"> 
		</div>
		
		<?php include("Footer.php");?>
	</body>
	<script> notation(<?php echo $Event_id ?>) </script>
</html>