
<link type="text/css" rel="stylesheet" href="Header.css"/>

<?php 

require'fonctions_simplevent.php'; ?>

<div id="header">
	<div class="bandeauhaut">
		<div id="headergauche"> 
			<a href="Accueil.php"><img src="https://www.dropbox.com/s/1yxbj2y807fn5eq/Logo4.png?raw=1" class="imagebandeau"/></a>
		</div>
		<div id="headerdroit">
			<?php if(isset($Accueil)==FALSE) { ?>				
			<div class="bandeauhaut">
				<form method="post" action="../Vue/Evenements2.php">
					<input type="search" name="mot_clef" name="ville_evenement" id="recherche" placeholder="Ex:Tommorrow Land, Rock, Football..."/> 
					<input type="submit" class="boutonrecherche" value="Recherche d'événements"/>
				</form>
			</div>
			<div class="bandeaubas">
				<div id="decal"></div>
				<a href="creationevent.php"><div id="Boutoncrea"><p>Créer un événement</p></div></a>
			</div>
			<?php } ?>
		</div>
			
	</div>
	<div class="bandeaubas">
	<?php if (verifco($mdp,$id_utilisateur)==TRUE){?> 
		<div id="menu">
			<a href="Accueil.php"><div class="Boutonmenu"><p>Accueil</p> </div></a>
			<div class="Boutonmenu">
				<a href="Events.php?Event_id=1" style="color:inherit"><p>Evénements</p></a>
				<div class="menuderoul" >
					<a href="Evenements2.php?t=Eventscrees" style="color:inherit"><div class="bandeaubas" style="height:33%">
						<p style="display:inline-block; float:left; position:absolute;left:5%">Evénements créés</p>
					</div></a>
					<a href="Evenements2.php?t=MesEvents" style="color:inherit"><div class="bandeaubas" style="height:33%;">
						<p style="display:inline-block; float:left; position:absolute;left:5%">Vos Evénements</p>
					</div></a>
					<a href="Evenements2.php" style="color:inherit;"><div class="bandeaubas" style="height:33%">
						<p style="display:inline-block; float:left; position:absolute;left:5%">Evénements intéressants</p>
					</div></a>
				</div>	
			</div>
			<div class="Boutonmenu" >
				<a href="user.php?i=<?php echo $id_utilisateur?>" style="color:inherit"><p>Mon Compte</p></a>
				<div class="menuderoul" >
					<div class="bandeaubas" style="height:65%">
						<div class="bleft" style="width:40%">
							<a href="user.php?i=<?php echo $id_utilisateur?>"><img src="<?php echo $photo_u ;?>" class="profpic" /></a>
						</div>
						<div class="bright" style="width:60%">
							<p style="display:inline-block; float:left; position:relative;left:5%;color:#74def1;"><?php echo "$prenom_u $nom_u"?></p>
						</div>
					</div>
					<a href="../Modele/deconnexion.php" style="color:inherit"><div class="bandeaubas" style="height:35%;">
						<p  style="position:relative; display:inline-block; text-align:center">Se déconnecter</p>
					</div></a>
				</div>						
			</div>
		</div>
	<?php }
		else{
	?>
		<div id="menu">
				<a href="Accueil.php"><div class="Boutonmenu"><p>Accueil</p> 
				</div></a>
				<a href="inscription.php"><div class="Boutonmenu"><p>Créer un compte</p> 
				</div></a>
				<a href="connexion.php"><div class="Boutonmenu"><p>Se connecter </p> 
				</div></a>
		</div>
	<?php } ?>
	</div>
</div>