<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/monprofil.css"/>
		<script type="text/javascript" src="monprofil.js"></script>
		<title>Mon profil</title>
	</head>
	
	<?php
	$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
	
	?>
	
	
	
	<body>
		<?php
		include("Header.php");
		$profil=mysqli_fetch_assoc(mysqli_query($connect, "select * from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
		?>
	
		<div id="presentation_mon_profil">
			<div id="nom_mon_profil">
				<h1><?php echo($profil['prenom_u'])?> <?php echo($profil['nom_u'])?></h1>
			</div>
			<div id="photo_autre_profil">
				<img src="<?php echo($profil['photo_u'])?>" id="photoprof">
			</div>
			<div id="description_mon_profil">
				<h3>Ma description :</h3>
				<p><?php echo($profil['description'])?></p>
			</div>
			<div id="boutons_mon_profil">
				<a href="modificationprofil.php"><div class="bouton_mon_profil"><p>Modifier mon compte</p></div></a>
				</br>
				</br>
				</br>
				<a href="messagerie.php?but=messages_recus"><div class="bouton_mon_profil"><p>Mes messages</p></div></a>
				</br>
				</br>
				</br>
				<a href="#"><div class="bouton_mon_profil"><p>Mes contacts</p></div></a>
				</br>
				</br>
			</div>
		</div>
		<div id="evenements_crees">
			<h2>Evénements créés : </h2>
			<?php
			$evenements_crees=mysqli_query($connect, "select * from event natural join multimedia where id_utilisateur=".$_SESSION['id_utilisateur']." and principale = 1 ");
			$compteur1=0;
			while ($data=mysqli_fetch_assoc($evenements_crees)) {
				$compteur1 ++;
				if ($compteur1<=3) {
				?>
				<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
				<div class='evenement'>
					<div class='vignette'>
						<img src="<?php echo($data['urlimg_event']) ?>"/>
					</div>
					<h3 class='nom_evenement'><?php echo($data['Nom_e']) ?></h3>
				</div>
				</a>
				<?php
				}
				else {
				?>
				<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
				<div class='evenement' id="cache1">
					<div class='vignette'>
						<img src="<?php echo($data['urlimg_event']) ?>"/>
					</div>
					<h3 class='nom_evenement'><?php echo($data['Nom_e']) ?></h3>
				</div>
				</a>
				<?php
				}
			}
			
			if ($compteur1==0) {
				echo("<p>Aucun événement dans cette partie, profitez de ce site Internet pour participer à plus d'événements !</p>");
			}
			
			if ($compteur1>3) {
			?>
			<span onclick="ouvrirfermer('#cache1')">
			<div class="afficher_plus">
				<div class="bouton_mon_profil"><p>Afficher plus</p></div>
			</div>
			</span>
			<?php
			}
			?>
		</div>
		<div id="evenements_a_venir">
			<h2>Evénements à venir : </h2>
			<?php
			$date=date("Y-m-d");
			$evenements_crees=mysqli_query($connect, "select * from event natural join multimedia natural join participation where id_participant=".$_SESSION['id_utilisateur']."  and principale = 1 and date_e>'".$date."'");
			$compteur2=0;
			while ($data=mysqli_fetch_assoc($evenements_crees)) {
				$compteur2 ++;
				if ($compteur2<=3) {
				?>
				<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
				<div class='evenement'>
					<div class='vignette'>
						<img src="<?php echo($data['urlimg_event']) ?>"/>
					</div>
					<h3 class='nom_evenement'><?php echo($data['Nom_e']) ?></h3>
				</div>
				</a>
				<?php
				}
				else {
				?>
				<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
				<div class='evenement' id="cache2">
					<div class='vignette'>
						<img src="<?php echo($data['urlimg_event']) ?>"/>
					</div>
					<h3 class='nom_evenement'><?php echo($data['Nom_e']) ?></h3>
				</div>
				</a>
				<?php
				}
			}
			
			if ($compteur2==0) {
				echo("<p>Aucun événement dans cette partie, profitez de ce site Internet pour participer à plus d'événements !</p>");
			}
			
			if ($compteur2>3) {
			?>
			<span onclick="ouvrirfermer('#cache2', 'afficher_plus2')">
			<div class="afficher_plus" id="afficher_plus2">
				<div class="bouton_mon_profil"><p>Afficher plus</p></div>
			</div>
			</span>
			<?php
			}
			?>
		</div>
		<div id="evenements_passes">
			<h2>Evénements passés : </h2>
			<?php
			$evenements_passes=mysqli_query($connect, "select * from event natural join multimedia natural join participation where id_participant=".$_SESSION['id_utilisateur']." and principale = 1 and date_e<'".$date."'");
			$compteur3=0;
			while ($data=mysqli_fetch_assoc($evenements_passes)) {
				$compteur3 ++;
				if ($compteur3<=3) {
				?>
				<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
				<div class='evenement'>
					<div class='vignette'>
						<img src="<?php echo($data['urlimg_event']) ?>"/>
					</div>
					<h3 class='nom_evenement'><?php echo($data['Nom_e']) ?></h3>
				</div>
				</a>
				<?php
				}
				else {
				?>
				<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
				<div class='evenement' id="cache3">
					<div class='vignette'>
						<img src="<?php echo($data['urlimg_event']) ?>"/>
					</div>
					<h3 class='nom_evenement'><?php echo($data['Nom_e']) ?></h3>
				</div>
				</a>
				<?php
				}
			}
			
			if ($compteur3==0) {
				echo("<p>Aucun événement dans cette partie, profitez de ce site Internet pour participer à plus d'événements !</p>");
			}
			
			if ($compteur3>3) {
			?>
			<span onclick="ouvrirfermer('#cache3')">
			<div class="afficher_plus">
				<div class="bouton_mon_profil"><p>Afficher plus</p></div>
			</div>
			</span>
			<?php
			}
			?>
		</div>
		<?php include('footer.php')?>
	</body>
	
	<script type="text/javascript">
		profpic();
		//<!--
		fermeture_init("#cache1");
		fermeture_init("#cache2");
		fermeture_init("#cache3");
		//-->
	</script>
</html>