<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/Evenements2.css"/>
		<script type="text/javascript" src="Evenements2.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTJ7EKiUmBXBsHrnojWCg36xdAKObOLqM"></script>
		<script type="text/javascript" src="../Modele/Eventmap.js"></script>
		<title>Evénements</title>
	</head>
	
	<?php
	$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
	mysqli_set_charset($connect,"utf8");
	?>
	
	<body>
		<?php
		include("Header.php");
		require "fonctions_recherche_events.php";
		$compteur=0;
		
		?>
		<!-- Le site utilise beaucoup de javascript, cette balise affichera un message si le JS n'est pas activé -->
		<noscript>
			<h3 style="background-color:#74DEF1 ; color:white; text-align:center;">Pour profiter pleinement de cette page, et de l'ensemble du site Internet, veuillez activer l'utilisation de Javascript sur votre navigateur web</h3>
		</noscript>
		<?php
	if($cacher==0){
		?>
		
		<div id="formulaire_page_resultat">
			<form method="post" action="Evenements2.php" id="formulaire_resultat">
				<label for="mot_clef" style="color:white ; font-size:1.5em;">Mot clef : </label>
				<input type="text" name="mot_clef" id="mot_clef" autofocus placeholder="exemple : Festival"/>
				<input type="hidden" name="ville_evenement" value="%" />
				<input type="hidden" name="departement_evenement" value="%" />
				<input type="hidden" name="date_debut" value="<?php echo(date("Y-m-d")) ?>">
				<input type="hidden" name="date_fin" value="8000-12-31">
				<input type="submit" value="Go !" class="Bouton_evenements"/>
				</br>
				</br>
			</form>
				<form method="post" action="RechAvan.php">
					<input type="submit" value="Revenir à la recherche avancée" class="Bouton_evenements"/>
					</br>
					</br>
				</form>
				<form method="post" action="Evenements2.php">
					<input type="hidden" name="mot_clef" value="" />
					<input type="hidden" name="ville_evenement" value="%" />
					<input type="hidden" name="departement_evenement" value="%" />
					<input type="hidden" name="date_debut" value="<?php echo(date("Y-m-d")) ?>">
					<input type="hidden" name="date_fin" value="8000-12-31">
					<input type="submit" value="Afficher tous les événements" class="Bouton_evenements"/>
				</form>
		</div>
		<div id="indicateur_recherche">
			<p> 
			<?php
			if ($_POST['mot_clef']=="") {
				echo("Evénements : ");
			}
			else {
				echo("Résultat de recherche pour le mot clef :".$_POST['mot_clef']."");
			} 
			?></p>
		</div>
		
		<?php }?>
		<div id="contenant_resultat">
			<div class="ligne">
				<?php
				while ($data=mysqli_fetch_assoc($tout_evenement)) {
					$listeadresse[]=$data['numerorue']." ".$data['rue']." ".$data['ville']." ".$data['pays'];
					$vignette_evenement=$data["urlimg_event"];
					$nom_evenement=$data["Nom_e"];
					$id_evenement=$data["Event_id"];
					$compteur++;
					if ($compteur==1) {
						$evenement1=mysqli_fetch_assoc(mysqli_query($connect, "select * from multimedia natural join event where Event_id=$id_evenement"));
					}
					if ($compteur==2) {
						$evenement2=mysqli_fetch_assoc(mysqli_query($connect, "select * from multimedia natural join event where Event_id=$id_evenement"));
					}
				?>
				<span onclick="ouvrirfermer(<?php echo("$id_evenement") ?>)">
				<div class='evenement'>
					<div class='vignette'>
						<img style="background-color:#59b7ff;" src="<?php echo($vignette_evenement) ?>"/>
					</div>
					<h3 class='nom_evenement'><?php echo($nom_evenement) ?></h3>
				</div>
				</span>
				<?php
					if ($compteur==3) {
						$evenement3=mysqli_fetch_assoc(mysqli_query($connect, "select * from multimedia natural join event where Event_id=$id_evenement"));
						?>
						</div>
						<div class="contenant_informations">
							<div class="information" id="<?php echo($evenement1["Event_id"]) ?>">
								<div class="photo_information">
									<img src="<?php echo($evenement1["urlimg_event"])?>"/>
								</div>
								<div class="informations">
									<h3 class="titre_information"><?php echo($evenement1["Nom_e"])?></h3>
									<div class="texte_information">
										<p><?php echo($evenement1["description_e"]) ?></p>
									</div>
										<a href="Events.php?Event_id=<?php echo($evenement1["Event_id"]) ?>"><div class="Bouton_information"><p>En savoir plus</p>
									</div></a>
								</div>
							</div>
							<div class="information" id="<?php echo($evenement2["Event_id"]) ?>">
								<div class="photo_information">
									<img src="<?php echo($evenement2["urlimg_event"])?>"/>
								</div>
								<div class="informations">
									<h3 class="titre_information"><?php echo($evenement2["Nom_e"])?></h3>
									<div class="texte_information">
										<p><?php echo($evenement2["description_e"]) ?></p>
									</div>
										<a href="Events.php?Event_id=<?php echo($evenement2["Event_id"]) ?>"><div class="Bouton_information"><p>En savoir plus</p>
									</div></a>
								</div>
							</div>
							<div class="information" id="<?php echo($evenement3["Event_id"]) ?>">
								<div class="photo_information">
									<img src="<?php echo($evenement3["urlimg_event"])?>"/>
								</div>
								<div class="informations">
									<h3 class="titre_information"><?php echo($evenement3["Nom_e"])?></h3>
									<div class="texte_information">
										<p><?php echo($evenement3["description_e"]) ?></p>
									</div>
										<a href="Events.php?Event_id=<?php echo($evenement3["Event_id"]) ?>"><div class="Bouton_information"><p>En savoir plus</p>
									</div></a>
								</div>
							</div>
						</div>
						<div class="ligne">
						<?php
						$compteur=0;
					}
				}
				?>
				<?php
				if ($compteur!=3) {
					if ($compteur==1) {
						?>
						</div>
						<div class="contenant_informations">
							<div class="information" id="<?php echo($evenement1["Event_id"]) ?>">
								<div class="photo_information">
									<img src="<?php echo($evenement1["urlimg_event"])?>"/>
								</div>
								<div class="informations">
									<h3 class="titre_information"><?php echo($evenement1["Nom_e"])?></h3>
									<div class="texte_information">
										<p><?php echo($evenement1["description_e"]) ?></p>
									</div>
										<a href="Events.php?Event_id=<?php echo($evenement1["Event_id"]) ?>"><div class="Bouton_information"><p>En savoir plus</p>
									</div></a>
								</div>
							</div>
						</div>
						<?php
					}
					if ($compteur==2) {
						?>
						</div>
						<div class="contenant_informations">
							<div class="information" id="<?php echo($evenement1["Event_id"]) ?>">
								<div class="photo_information">
									<img src="<?php echo($evenement1["urlimg_event"])?>"/>
								</div>
								<div class="informations">
									<h3 class="titre_information"><?php echo($evenement1["Nom_e"])?></h3>
									<div class="texte_information">
										<p><?php echo($evenement1["description_e"]) ?></p>
									</div>
										<a href="Events.php?Event_id=<?php echo($evenement1["Event_id"]) ?>"><div class="Bouton_information"><p>En savoir plus</p>
									</div></a>
								</div>
							</div>
							<div class="information" id="<?php echo($evenement2["Event_id"]) ?>">
								<div class="photo_information">
									<img src="<?php echo($evenement2["urlimg_event"])?>"/>
								</div>
								<div class="informations">
									<h3 class="titre_information"><?php echo($evenement2["Nom_e"])?></h3>
									<div class="texte_information">
										<p><?php echo($evenement2["description_e"]) ?></p>
									</div>
										<a href="Events.php?Event_id=<?php echo($evenement2["Event_id"]) ?>"><div class="Bouton_information"><p>En savoir plus</p>
									</div></a>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		<div id="map">
		</div>
		<?php include("footer.php");
		$jsadresses=json_encode($listeadresse);
		?>
		<script type="text/javascript">
			Eventmap(<?php echo $jsadresses ?>,"Paris");
			
			//<!--
			fermeture_init();
			//-->
		</script>
		
	</body>
</html>