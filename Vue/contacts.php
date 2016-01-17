<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/contacts.css"/>
		<title>Contacts</title>
	</head>
	
	<?php
	$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
	mysqli_set_charset($connect,"utf8");
	?>
	
	<body>
		<?php
		include("Header.php");
		?>
		<div id="contenant_contacts">
			<form method="POST" action="">
				<label for id="nom">Nom : </label>
				<input type="text" name="nom" id="nom" placeholder="ex: Antoine" />
				</br>
				</br>
				<label for id="parmi">Rechercher parmi : </label>
				<input type="radio" name="parmi" id="parmi" value="amis"/><label>Mes amis</label>
				<input type="radio" name="parmi" id="parmi" value="tout"/><label>Tout le monde</label>
				</br>
				</br>
				<input type="submit" name="Rechercher" class="bouton_recherche_contact" />
				</br>
				</br>
			</form>
			
			<div id="affichage_contacts">
			<?php
			//en fonction de ce qui a été coché ou cherché par l'utilisateur, la recherche se fait parmi les amis ou parmi tout le monde
			
			
			//si une radio a été cochée
			if (isset($_POST['parmi'])){
				
				//si la radio pour tous les utilisateurs a été cochée
				if ($_POST['parmi']=="tout") {
					if ($_POST['nom']!="") {
						echo("<h4>Recherche de ".$_POST['nom']." parmi tous les utilisateurs :</h4>");
					}
					else {
						echo("<h4>Utilisateurs :</h4>");
					}
					
					//fait une recherche parmi tout le monde, en omettant l'utilisateur lui même
					$utilisateurs=mysqli_query($connect, "select * from utilisateur where (prenom_u like '%".$_POST['nom']."%' or nom_u like '%".$_POST['nom']."%') and id_utilisateur!=".$_SESSION['id_utilisateur']."");
					while ($data=mysqli_fetch_assoc($utilisateurs)) {
						
						//affiche chaque contact avec un lien vers son profil
						?>
						<a href="autreprofil.php?id_utilisateur=<?php echo ($data['id_utilisateur'])?>">
						<div class='contact'>
							<div class='vignette_contact'>
								<img src="<?php echo($data['photo_u']) ?>"/>
							</div>
							<h3 class='nom_contact'><?php echo($data['prenom_u']) ?> <?php echo($data['nom_u']) ?></h3>
						</div>
						</a>
						<?php
					}
				}
				
				//si la radio des amis a été cochée
				else{
					if ($_POST['nom']!="") {
						echo("<h4>Recherche de ".$_POST['nom']." parmi vos amis :</h4>");
					}
					else {
						echo("<h4>Vos amis :</h4>");
					}
					
					//recherche parmi les amis, d'où la double inclusion
					$amis=mysqli_query($connect, "select * from utilisateur where (prenom_u like '%".$_POST['nom']."%' or nom_u like '%".$_POST['nom']."%') and id_utilisateur in (select id_ami from utilisateur natural join relation_amicale where id_utilisateur=".$_SESSION['id_utilisateur'].")");
					while ($data=mysqli_fetch_assoc($amis)) {
						?>
						<a href="autreprofil.php?id_utilisateur=<?php echo ($data['id_utilisateur'])?>">
							<div class='contact'>
								<div class='vignette_contact'>
									<img src="<?php echo($data['photo_u']) ?>"/>
								</div>
								<h3 class='nom_contact'><?php echo($data['prenom_u']) ?> <?php echo($data['nom_u']) ?></h3>
							</div>
						</a>
						<?php
					}
				}
				
			}
			
			//si aucune radio n'a été cochée mais qu'il y a un nom dans la recherche non vide
			elseif (!isset($_POST['parmi']) and isset($_POST['nom']) and $_POST['nom']!="") {
				echo("<h4>Recherche de ".$_POST['nom']." parmi vos amis :</h4>");
				$amis=mysqli_query($connect, "select * from utilisateur where (prenom_u like '%".$_POST['nom']."%' or nom_u like '%".$_POST['nom']."%') and id_utilisateur in (select id_ami from utilisateur natural join relation_amicale where id_utilisateur=".$_SESSION['id_utilisateur'].")");
				while ($data=mysqli_fetch_assoc($amis)) {
					?>
					<a href="autreprofil.php?id_utilisateur=<?php echo ($data['id_utilisateur'])?>">
						<div class='contact'>
							<div class='vignette_contact'>
								<img src="<?php echo($data['photo_u']) ?>"/>
							</div>
							<h3 class='nom_contact'><?php echo($data['prenom_u']) ?> <?php echo($data['nom_u']) ?></h3>
						</div>
					</a>
					<?php
				}
			}
			
			//en arrivant sur la page, ou alors sans recherche : la page affiche tous les amis
			else {
				echo("<h4>Vos amis :</h4>");
				$amis=mysqli_query($connect, "select * from utilisateur where id_utilisateur in (select id_ami from utilisateur natural join relation_amicale where id_utilisateur=".$_SESSION['id_utilisateur'].")");
				while ($data=mysqli_fetch_assoc($amis)) {
					?>
					<a href="autreprofil.php?id_utilisateur=<?php echo ($data['id_utilisateur'])?>">
						<div class='contact'>
							<div class='vignette_contact'>
								<img src="<?php echo($data['photo_u']) ?>"/>
							</div>
							<h3 class='nom_contact'><?php echo($data['prenom_u']) ?> <?php echo($data['nom_u']) ?></h3>
						</div>
					</a>
					<?php
				}
			}
				?>
			</div>
		</div>
            <?php include 'footer.php';?>
	</body>
</html>