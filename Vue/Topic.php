<?php 
session_start();
$id_utilisateur=$_SESSION['ud_utilisateur']

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/Topic.css"/>
		<script type="text/javascript" src="../Modele/Eventmap.js"></script>
		<title>Forum</title>
		
		
	</head>
	
	<body>
		<?php
		include("Header.php");	
		require 'fonctions_topic.php'; 
		?>
		<div id="Corps_forum">
			<?php 
				
			?>
		</div>
	</body>
	</head>
</html>