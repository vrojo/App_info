<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="Evenements2.css"/>
		<script type="text/javascript" src="Evenements2.js"></script>
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
		
	if($cacher==0){?>
		<div id="formulaire_page_resultat">
			<form method="post" action="Evenements2.php">
				<label for="mot_clef">Mot clef : </label>
				<input type="text" name="mot_clef" id="mot_clef" autofocus placeholder="exemple : Festival"/>
				<input type="hidden" name="ville_evenement" value="%" />
				<input type="hidden" name="departement_evenement" value="%" />
				<input type="hidden" name="date_debut" value="<?php echo(date("Y-m-d")) ?>">
				<input type="hidden" name="date_fin" value="8000-12-31">
				<input type="submit" value="Go !" />
			</form>
			<br>
			<form method="post" action="Evenements2.php">
				<input type="hidden" name="mot_clef" value="" />
				<input type="hidden" name="ville_evenement" value="%" />
				<input type="hidden" name="departement_evenement" value="%" />
				<input type="hidden" name="date_debut" value="<?php echo(date("Y-m-d")) ?>">
				<input type="hidden" name="date_fin" value="8000-12-31">
				<input type="submit" value="Afficher tous les événements" />
			</form>
		</div>
		<div id="indicateur_recherche">

		<p>Résultat de recherche pour le mot clef : <?php echo($_POST['mot_clef']) ?></p>
		
			</div>
		<?php }?>
		<div id="contenant_resultat">
			<div class="ligne">
				<?php
				while ($data=mysqli_fetch_assoc($tout_evenement)) {
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
					<img src="<?php echo($vignette_evenement) ?>" class='vignette'/>
					<h3 class='nom_evenement'><?php echo($nom_evenement) ?></h3>
				</div>
				</span>
				<?php
					if ($compteur==3) {
						$evenement3=mysqli_fetch_assoc(mysqli_query($connect, "select * from multimedia natural join event where Event_id=$id_evenement"));
						?>
						</div>
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
						<?php
					}
					if ($compteur==2) {
						?>
						</div>
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
						<?php
					}
				}
				?>
			</div>
		</div>
		<?php include("footer.php")?>
		<script type="text/javascript">
			//<!--
			fermeture_init();
			//-->
		</script>
	</body>
</html>