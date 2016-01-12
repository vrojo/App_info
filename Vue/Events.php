<?php session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/Events.css"/>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTJ7EKiUmBXBsHrnojWCg36xdAKObOLqM"></script>
		<script type="text/javascript" src="../Modele/Eventmap.js"></script>

		
		
	</head>
	
	<body>
		<?php
		include("Header.php");
		require'fonctions_event.php';
		
		?>
		<title><?php echo $event['Nom_e'] ?></title>	
		<div id="bandeaupresevent" style="height:<?php echo $hbandeaupres ?>px">
			<div class="bleft" >
				<div class="bandeauhaut"><div class="Eventpic" style="background-image:url(<?php echo $event['urlimg_event'] ?>)"></div></div>
				<div class="bandeaubas" ><div id="map" style="transform: translate(-50%,-50%);" ></div></div>
			</div>
			<div class="bright">
				<div class="bandeauhaut" style="height:10%;"><p style="font-size:1.4em; transform:translateY(-50%)"><?php echo $nom_e ?></p></div>
				<div class="bandeaumilieu" style="height:70%">
					<div class="bandeauhaut" style="height:40%">
						<div class="bleft" style="width:50%;">
							<div class="bleft" style="width:10%">
								<div id="Contacts">
									<img src="../reste/bvert.png" id="imgcontact" title="Inviter un ami" />
									<div class="menucontacts">
									<?php fonctioncontact($id_utilisateur)?>
									</div>
								</div>
								<a href="https://twitter.com/intent/tweet/?url=<?php  echo $URLevent;?>&text=Je suis intéressé par cet événement &via=SimplEvent"><img src="https://www.dropbox.com/s/33ldf4ajvhvh3hz/EIpgSD2K.png?raw=1" title="Partager sur twitter" style="max-width:100%; max-height:25%"/></a>
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $URLevent?>"><img src="https://www.dropbox.com/s/vpzc9y04zixn2lg/fb_icon_325x325.png?raw=1"title="Partager sur facebook" style="max-width:100%; max-height:25%"/></a>
								<a href="mailto:?subject=HelloWorld&body=<?php echo $URLevent; ?>"><img src="https://www.dropbox.com/s/0h0kmbxsicya03r/ajouter-un-nouveau-bouton-plus_318-9157.png?raw=1" title="Partager par mail" style="max-width:100%; max-height:25%"/></a>
							</div>
							<div class="bright" style="width:90%">
								<div class="bandeauhaut" style="height:33%;">
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
								<div class="bandeaubas" style="height:33%;">
									<?php if ($event['date_e']!=$event['date_f'] && !empty($event['date_e']) && !empty($event['date_f'])){?>
										<p style="font-weight:normal;font-size:0.7em">Date de début: <?php echo $event['date_e']?></p>
										<p style="font-weight:normal;font-size:0.7em">Date de fin: <?php echo $event['date_f']?></p>
									<?php }
										else{?>
									<p style="font-weight:normal;font-size:0.7em">Date de l'événement: <?php echo $event['date_e']?> </p>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="bright" style="width:50%">
							<?php if ($privacy == 1){ ?>
								<p style="height:<?php echo $h?>%; display:inline-block; position:relative; margin:0;font-weight:normal;font-size:1.25vw;"> cet événement est privé</p>
							<?php }
							?><?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
							<a href="#"><div class="Bouton2" onclick=(inscriptionevent(<?php echo $Event_id ?>)) style="height:<?php echo $h ?>%"><p><?php des_inscrire() ?></p></div></a>
							<a href="#"><div class="Bouton2" style="height:<?php echo $h ?>%"><p>Acheter un Billet</p></div></a><?php }?>
							<?php if (!empty($event['urlsite_event'])){?><a href="<?php echo $event['urlsite_event'] ?>"><div class="Bouton2" style="height:<?php echo $h ?>%"><p>Site internet de l'événement</p></div></a>
							<?php }
							if ($Id_crea==$id_utilisateur) {
							?><a href="#"><div class="Bouton2" style="height:<?php echo $h ?>%"><p>Modifier l'événement</p></div></a><?php }?>
						</div>
					</div>
					<div class="bandeaubas" style="height:60%; text-align: left; padding:5px 0 0 0">
						<div class="bleft" style="width:65%">
							<h2> Informations </h2>
							<p style="font-weight:normal; font-size:0.7em"><?php echo $event['description_e']?></p>
						</div>
						<div class="bright" style="font-weight:normal; font-size:0.7em;width:35%">
							<?php
							if(!empty($event['heuredebut'])){echo "<p>Heure de début:".$event['heuredebut']."</p>";}
							if(!empty($event['heurefin'])){echo "<p>Heure de fin: ".$event['heurefin']."</p>";}
							if(!empty($event['nb_max_participant'])){echo "<p>Nombre de participants maximum: ".$event['nb_max_participant']."</p>";}
							?>
						</div>
					</div>
				</div>
				<?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
				<div class="bandeaubas" style="height:20%;text-align:left;">
					<div class="bandeauhaut" style="height:50%">
						<div class="bandeauhaut" style="height:25%">
							Catégorie d'événement:
						</div>
						<div class="bandeaubas" style="height:75%; font-weight:normal;">
							<?php categories($Event_id)?>, 
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
							<p style="Font-size:1em">Signaler cet <br> événement:</p>
							<img src="https://www.dropbox.com/s/43g64iiwsnat9pw/Point-d-exclamation.png?raw=1" class="report" title="Signaler cet événement" onclick="report('event',<?php echo $Event_id?>)"/>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
		<div id="bandeau1">
			<div class="bandeauhaut"  style="height:50px;color:grey">
				<div class="bleft">Sponsorisé par</div>
				<div class="bright">
					<img src="https://upload.wikimedia.org/wikipedia/fr/4/47/Isep-Logo.png" style="float:left;display:inline-block;max-height:90%;"/>
				</div>
			</div>
			<div class="bandeaubas" style="height:auto">
				<?php carroussel_event($Event_id);?>
			</div>
		</div>
		<?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
		<div id="bandeau2_1" style="height:100px">
			<a href=#bandeau2_2><div class="Bouton2" style="width:50%;height:50px"><p>Ajouter un commentaire</p></div></a>
		</div>
		<?php } ?>
		<div id="bandeau2" style="height:auto">
			<?php coms($Event_id) ?>
		</div>
		<?php if (verifco($mdp,$id_utilisateur)==TRUE){?>
		<div id="bandeau2_2" >
			<form method="post" style="height:100%" action="../Controler/addcom.php">
				<textarea name="Commentaire" placeholder="Entrez votre commentaire" id="Zonecom"></textarea>
				<input type="hidden" name="Event_id" value= <?php echo $Event_id ?> />
				<input type="submit" name="envoyer" value="Envoyer" id="Boutoncom"/>
			</form>
		</div> <?php } ?>
		<div id="bandeau3"> 
		</div>
		<?php include("Footer.php");?>
	</body>
	<script>
	Eventmap([<?php echo $adresse ?>],'Paris');
	notation(<?php echo $Event_id?>,<?php echo(notationphp($Event_id))?>);
	profpic();
	
	
	</script>
</html>