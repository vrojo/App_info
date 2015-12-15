<?php session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="Events.css"/>
		<title>Evénements</title>	
	</head>
	<body>
		<?php
		include("Header.php");
		require'fonctions_event.php';
		$Nb_comment=125*mysqli_query($connect_e,"select * from commente where Event_id='$Event_id' and texte_co IS NOT NULL")->num_rows;

		$h=0;
		if ($privacy == 1 && $Id_crea==$id_utilisateur){
			$h=20;
		} 
		elseif ($privacy == 0 && $Id_crea==$id_utilisateur OR $privacy == 1 && $Id_crea!=$id_utilisateur){
			$h=25;
		}
		else{
	$h=32;
		}
		if (verifco($mdp,$id_utilisateur)==TRUE){
			$hbandeaupres=700;
			
		}
		else {
			$hbandeaupres=600;
	 
		}		
		?>
		<div id="bandeaupresevent" style="height:<?php echo $hbandeaupres ?>px">
			<div class="bleft">
				<div class="bandeauhaut"><div class="Eventpic" style="background-image:url(http://www.rockenseine.com/wp-content/uploads/2015/09/VP2_7163RES-1024x683.jpg)"></div></div>
				<div class="bandeaubas"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d42028.32016165403!2d2.169811143748841!3d48.82444950573356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66dfad5c08e2b%3A0x36729832bbaf3b12!2sFestival+Rock+en+Seine!5e0!3m2!1sfr!2sfr!4v1446213297181" frameborder="0"  allowfullscreen id="map"></iframe></div>
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
										<a href="#5" title="Donner 5 étoiles">★</a>
										<a href="#4" title="Donner 4 étoiles">★</a>
										<a href="#3" title="Donner 3 étoiles">★</a>
										<a href="#2" title="Donner 2 étoiles">★</a>
										<a href="#1" title="Donner 1 étoile">★</a>
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
							<a href="#"><div class="Bouton2" style="height:<?php echo $h ?>%"><p>S'inscrire à l'événement</p></div></a>
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

</html>