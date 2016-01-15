<?php 
session_start();
$id_utilisateur=$_SESSION['id_utilisateur']

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/Topic.css"/>
		<script type="text/javascript" src="../Modele/Eventmap.js"></script>
		<title>Forum SimplEvent</title>		
	</head>
	
	<body>
		<?php
		include("Header.php");	
		require 'fonctions_topic.php'; 
		?>
		<div id="Corps_forum">
			
			<div class="bandeaucom" style="background-color:#59b7ff;Font-size:1em;">
				<div class="bleft" style="display:block;width:30%;height:125px;">
					<div class="bleft" style="width:50%;height:100%;">
						<a href="autreprofil.php?id_utilisateur=<?php echo $crea['id_utilisateur']?>"><img src="<?php echo $crea['photo_u']?>" class="profpic" style="float:right; height:90px; margin:0; margin-right:20px;"/></a>
					</div>
					<div class="bright" style="width:50%; height:100%; min-height:125px">
						<div class="bandeauhaut" style="height:20%;margin-top:10%">
							<p style="margin:0;top:50%; transform:translate(0,-50%)"><?php echo $crea["prenom_u"].' '.$crea["nom_u"] ?></p>
						</div>
						<div class="bandeaumilieu" style="height:20%;">
							<p style="margin:0;font-size:0.6em; text-align:left;"><?php echo $date_s; ?> </p>
						</div>
						<div class="bandeaubas" style="height:30%;">
							<p style="Font-size:0.6em">Signaler ce <br>Topic:</p> 
							<img src="https://www.dropbox.com/s/43g64iiwsnat9pw/Point-d-exclamation.png?raw=1" class="report" title="Signaler ce commentaire" onclick="report('sujet',<?php echo $_GET['Topic']?>)"/>
						</div>
					</div>
				</div>
				<div class="bleft" style="width:50%; height:auto; min-height:125px">
					<h2><?php echo $sujet ?></h2>
					<p style="position:relative;display:inline-block;height:auto;width:100%;margin: 0;margin-top:10px; text-align:left;word-wrap: break-word;"><?php echo $texte_s ?> </p>
				</div>
				<div class="bright" style="width:20%; height:125px;">
				</div>
			</div>
			<div id="bandeau2_1" style="height:100px">
				<a href=#bandeau2_2><div class="Bouton2" style="width:50%;height:50px"><p>Ajouter un commentaire</p></div></a>
			</div>
			<div id="bandeau2" style="height:auto">
				<?php 
					coms($_GET['Topic'])
				?>
			</div>
			<div id="bandeau2_2" >
				<form method="post" style="height:100%" action="../Controler/addfor.php">
					<textarea name="Commentaire" placeholder="Entrez votre commentaire" id="Zonecom"></textarea>
					<input type="hidden" name="Topic" value= <?php echo $_GET['Topic'] ?> />
					<input type="submit" name="envoyer" value="Envoyer" id="Boutoncom"/>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			profpic();
		</script>
		<?php include 'footer.php'?>
	</body>
</html>