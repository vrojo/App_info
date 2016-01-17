<!-- Carrousel affichant les 9 derniers évenements-->

<?php
//récupère l'id du dernier évenement
$event_maximum=mysqli_fetch_assoc(mysqli_query($connect, "select max(Event_id) as max from event"));
$maximum=$event_maximum['max'];
?>
	<link type="text/css" rel="stylesheet" href="../Style/carrousel2.css"/>
	<script type="text/javascript" src="carrousel2.js"></script>
 
	<div id="contenant_slider">
			<div id="limitation">
				<div class="contenu">
					<div id="evenement1" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=$maximum and principale=1"));
						?>
						
						<!-- affiche la photo et le nom de l'event, et l'entoure d'une balise a avec le lien correspondant -->
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
					<div id="evenement2" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-1) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
					<div id="evenement3" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-2) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
				</div>
				<div class="contenu">
					<div id="evenement4" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-3) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
					<div id="evenement5" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-4) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
					<div id="evenement6" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-5) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
				</div>
				<div class="contenu">
					<div id="evenement7" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-6) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
					<div id="evenement8" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-7) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
					</div>
					<div id="evenement9" class="evenement">
						<?php 
						$evenement=mysqli_fetch_assoc(mysqli_query($connect, "select Event_id, Nom_e, urlimg_event from event natural join multimedia where Event_id=($maximum-8) and principale=1"));
						?>
						<a href="Events.php?Event_id=<?php echo $evenement['Event_id']?>"><div class="image_slider"style="background-image:url('<?php echo($evenement['urlimg_event']) ?>')">
							<p><?php echo $evenement['Nom_e'] ?></p>
						</div></a>
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