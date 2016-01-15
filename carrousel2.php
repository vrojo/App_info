<!DOCTYPE html>

<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");
$event_maximum=mysqli_fetch_assoc(mysqli_query($connect, "select max(Event_id) as max from event"));
$maximum=$event_maximum['max'];
?>

<html>
	<link type="text/css" rel="stylesheet" href="carrousel2.css"/>
	<script type="text/javascript" src="carrousel2.js"></script>
 
	<body>
		<div id="contenant_slider">
			<div id="limitation">
				<div class="contenu">
					<div id="evenement1" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=$maximum and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
					<div id="evenement2" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-1) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
					<div id="evenement3" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-2) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
				</div>
				<div class="contenu">
					<div id="evenement4" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-3) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
					<div id="evenement5" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-4) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
					<div id="evenement6" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-5) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
				</div>
				<div class="contenu">
					<div id="evenement7" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-6) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
					<div id="evenement8" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-7) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
					<div id="evenement9" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-8) and principale=1"));
						?>
						<div class="image_slider">
							<img src="<?php echo($evenement['urlimg_event']) ?>" />
						</div>
						<h3 class="nom_slider"><?php echo($evenement['Nom_e']) ?></h3>
					</div>
				</div>
			</div>
		</div>
		<div id="points_navigation">
			<ul>
				<li class="itemLinks" data-pos="0%"></li>
				<li class="itemLinks" data-pos="-33.2%"></li>
				<li class="itemLinks" data-pos="-66.4%"></li>
			</ul>
		</div>
		<script type="text/javascript">
			Slider();
		</script>
	</body>
</html>