
		<link type="text/css" rel="stylesheet" href="Header.css"/>
		
		<?php 
		require'fonctions_simplevent.php'; ?>
		
		<div id="header">
	        <div class="bandeauhaut">
				<div id="headergauche"> 
					<a href="Accueil.php"><img src="https://www.dropbox.com/s/1yxbj2y807fn5eq/Logo4.png?raw=1" class="imagebandeau"/></a>
				</div>
				<div id="headerdroit">	
					<div class="bandeauhaut">
						<form method="post" action="">
							<input type="search" name="recherche" id="recherche" placeholder="Ex:Tommorrow Land, Rock, Football..."/> 
							<input type="submit" class="boutonrecherche" value="Recherche d'événements"/>
						</form>
					</div>
					<div class="bandeaubas">
						<div id="decal"></div>
                             <a href="creationevent.php"><div id="Boutoncrea"><p>Créer un événement</p></div></a>
					</div>
				</div>
			</div>
			<div class="bandeaubas">
			<?php if (verifco($mdp,$id_utilisateur)==TRUE){?> 
				<div id="menu">
					<a href="Accueil.php"><div class="Boutonmenu"><p>Accueil</p> 
					</div></a>
					<a href="Events.php?Event_id=1"><div class="Boutonmenu" id="boutonmenuachov">
						<a href="#" style="color:inherit"><p>Evénements</p></a>
						<div id="menuderoul" >
							<a href="#" style="color:inherit"><div class="bandeaubas" style="height:33%">
								<p style="display:inline-block; float:left; position:absolute;left:5%">Evénements créés</p>
							</div></a>
							<a href="#" style="color:inherit"><div class="bandeaubas" style="height:33%;">
								<p style="display:inline-block; float:left; position:absolute;left:5%">Vos Evénements</p>
							</div></a>
							<a href="#" style="color:inherit;"><div class="bandeaubas" style="height:33%;">
								<p style="display:inline-block; float:left; position:absolute;left:5%">Evénements intéressants</p>
							</div></a>
						</div>	
					</div></a>
					<div class="Boutonmenu" id="boutonmenuachov">
						<a href="#" style="color:inherit"><p>Mon Compte</p></a>
						<div id="menuderoul" >
							<div class="bandeaubas" style="height:65%">
								<img src="<?php echo $photo_u ?>" class="profpic"/>
								<p style="display:inline-block; float:left; position:relative;left:5%;"><?php echo "$prenom_u $nom_u"?></p>
							</div>
							<a href="deconnexion.php" style="color:inherit"><div class="bandeaubas" style="height:35%;">
								<p  style="position:relative; display:inline-block; text-align:center">Se déconnecter</p>
							</div></a>
						</div>						
					</div>
					<!--<a href="deconnexion.php"><div class="Boutonmenu"><p>Déconnexion</p>
					</div></a>-->
				</div>
			<?php }
				else{
			?>
			<div id="menu">
					<a href="Accueil.php"><div class="Boutonmenu"><p>Accueil</p> 
					</div></a>
					<a href="inscription.php"><div class="Boutonmenu"><p>Créer un compte</p> 
					</div></a>
					<a href="inscription.php"><div class="Boutonmenu"><p>Se connecter </p> 
					</div></a>
			</div>
			<?php } ?>
			
	    </div>