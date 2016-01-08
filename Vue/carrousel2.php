<!DOCTYPE html>
<html>
 
	<head>
		<title>Slider</title>
		<link type="text/css" rel="stylesheet" href="../Style/carrousel2.css"/>
		<script type="text/javascript" src="carrousel2.js"></script>
	</head>
 
	<body>
		<div id="contenant_slider">
			<div id="limitation">
				<div class="contenu">
					<div id="evenement1" class="evenement" style="Background-image:URL=<?php echo $ ?>"></div>
					<div id="evenement2" class="evenement"></div>
					<div id="evenement3" class="evenement"></div>
				</div>
				<div class="contenu">
					<div id="evenement4" class="evenement"></div>
					<div id="evenement5" class="evenement"></div>
					<div id="evenement6" class="evenement"></div>
				</div>
				<div class="contenu">
					<a href="Events?id=<?php echo $idEvent?>"<div id="evenement7" class="evenement"></div>
					<div id="evenement8" class="evenement"></div>
					<div id="evenement9" class="evenement"></div>
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