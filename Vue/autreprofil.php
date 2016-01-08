	<?php
	$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
	mysqli_set_charset($connect,"utf8");
	
	$profil = mysqli_fetch_assoc(mysqli_query($connect, "select * from utilisateur where id_utilisateur=".$_GET['id_utilisateur'].""));
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/autreprofil.css"/>
		<script type="text/javascript" src="monprofil.js"></script>
		<title><?php echo($profil['prenom_u'])?> <?php echo($profil['nom_u'])?></title>
	</head>
	
	<body>
	<?php
	include("Header.php");
	?>
	<div id="presentation_autre_profil">
	<?php
	if (isset($_POST['requete'])) {
		if (isset($_POST['ajout']) and isset($_SESSION['id_utilisateur'])) {
			$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_POST['destinataire'].""));
			$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
			$sujet="Demande d'ajout en ami";
			$texte="".$nom_exp." souhaite devenir votre ami, veuillez suivre le lien suivant pour accepter ! (Vous pouvez également ignonrer sa demande en supprimant ce message)";
			mysqli_query($connect, "insert into messagerie(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte) values (".$_POST['destinataire'].", ".$_SESSION['id_utilisateur'].", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', '".$sujet."', '".$texte."')");
			echo("<h4 style='background-color:#74DEF1'>La demande d'ami a bien été envoyée</h4>");
		}
		
		elseif (isset($_POST['message']) and isset($_SESSION['id_utilisateur'])) {
			?>
			<div id="bloc_envoi_message">
						</br>
						<form method="POST" action="">
							<input type="hidden" name="destinataire" value=<?php echo($_POST['destinataire']) ?> />
							<label for="sujet">Sujet : </label>
							<input type="text" name="sujet" placeholder="ex : Bonjour" />
							</br>
							</br>
							<label for="texte">Texte : </label>
							<textarea name="texte" id="texte" placeholder="Entrez votre message ici"></textarea>
							</br>
							</br>
							<input type="hidden" name="envoye" value="oui" />
							<input type="submit" value="Envoyer" class="bouton_autre_profil"/>
							</br>
						</form>
						<form method="POST" action="">
							<input type="submit" value="Annuler" class="bouton_autre_profil_signal" />
							</br>
							</br>
						</form>
					</div>
			<?php
		}
		
		elseif (isset($_POST['envoye'])) {
			$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_POST['destinataire'].""));
			$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
			mysqli_query($connect, "insert into messagerie(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte) values (".$_POST['destinataire'].", ".$_SESSION['id_utilisateur'].", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', '".$_POST['sujet']."', '".$_POST['texte']."')");
			echo("<h4 style='background-color:#74DEF1'>Le message a bien été envoyé</h4>");
		}
		
		elseif (isset($_POST['signalement']) and isset($_SESSION['id_utilisateur'])) {
			$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=1"));
			$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
			$sujet="Signalement de l'utilisateur numéro ".$_GET["id_utilisateur"]."";
			$texte="".$_SESSION['id_utilisateur']." souhaite signaler cet utilisateur";
			mysqli_query($connect, "insert into messagerie(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte) values (1, ".$_SESSION['id_utilisateur'].", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', '".$sujet."', '".$texte."')");
			echo("<h4 style='background-color:#74DEF1'>Le signalement a bien été envoyé à un administrateur</h4>");
		}
		
		else {
			header('Location:connexion.php');
		}
	}
	?>
			<div id="nom_autre_profil">
				<h1><?php echo($profil['prenom_u'])?> <?php echo($profil['nom_u'])?></h1>
			</div>
			<div id="photo_autre_profil">
				<img src="<?php echo($profil['photo_u'])?>">
			</div>
			<div id="description_autre_profil">
				<h3>Sa description :</h3>
				<p><?php echo($profil['description'])?></p>
			</div>
			<div id="boutons_autre_profil">
				<form method="post" action="">
					<input type="hidden" name="requete" value="oui">
					<input type="hidden" name="ajout" value="oui">
					<input type="hidden" name="destinataire" value="<?php echo($profil['id_utilisateur']) ?>">
					<input type="submit" value="Demander en ami" class="bouton_autre_profil">
				</form>
				</br>
				</br>
				</br>
				<form method="post" action="">
					<input type="hidden" name="requete" value="oui">
					<input type="hidden" name="message" value="oui">
					<input type="hidden" name="destinataire" value="<?php echo($profil['id_utilisateur']) ?>">
					<input type="submit" value="Envoyer un message" class="bouton_autre_profil">
				</form>
				</br>
				</br>
				</br>
				<form method="post" action="">
					<input type="hidden" name="requete" value="oui">
					<input type="hidden" name="signalement" value="oui">
					<input type="hidden" name="destinataire" value="1">
					<input type="submit" value="Signaler l'utilisateur" class="bouton_autre_profil_signal">
				</form>
			</div>
		</div>
		<div id="participation_evenements">
			<h2>Evénements futurs : </h2>
			<?php
			$date=date("Y-m-d");
			$evenements=mysqli_query($connect, "select * from event natural join multimedia natural join participation where id_participant=".$_GET['id_utilisateur']." and date_e>'".$date."'");
			$compteur1=0;
			while ($data=mysqli_fetch_assoc($evenements)) {
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
				echo("<p>Aucun événement à venir</p>");
			}
			
			if ($compteur1>3) {
			?>
			<span onclick="ouvrirfermer('#cache1', 'afficher_plus1')">
			<div class="afficher_plus" id="afficher_plus1">
				<div class="bouton_autre_profil"><p>Afficher plus</p></div>
			</div>
			</span>
			<?php
			}
			?>
		</div>
		
		<div id="evenements_crees">
			<h2>Evénements créés : </h2>
			<?php
			$evenements=mysqli_query($connect, "select * from event natural join multimedia natural join participation where id_utilisateur=".$_GET['id_utilisateur']." order by date_e desc");
			$compteur2=0;
			while ($data=mysqli_fetch_assoc($evenements)) {
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
				echo("<p>Aucun événement créé par cet utilisateur</p>");
			}
			
			if ($compteur2>3) {
			?>
			<span onclick="ouvrirfermer('#cache2', 'afficher_plus2')">
			<div class="afficher_plus" id="afficher_plus2">
				<div class="bouton_autre_profil"><p>Afficher plus</p></div>
			</div>
			</span>
			<?php
			}
			?>
		</div>
		
		<div id="commentaires">
			<h2>Derniers commentaires : </h2>
			<?php
			$commentaires=mysqli_query($connect, "select Commentaire, Nom_e, Event_id, urlimg_event from participation natural join multimedia natural join event where id_participant =".$_GET['id_utilisateur']." order by id_participation desc");
			$compteur3=0;
			$compteur4=0;
			while ($data=mysqli_fetch_assoc($commentaires) and $compteur3<3) {
				$compteur3 ++;
				if ($data['Commentaire']!=NULL) {
					?>
					<div class="commentaire">
					<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
						<div class="vignette_commentaire">
							<img src="<?php echo($data['urlimg_event']) ?>" />
						</div>
					</a>
						<div class="texte_commentaire">
							<h4><?php echo($data['Nom_e']) ?></h4>
							<p><?php echo($data['Commentaire']) ?></p>
						</div>
					</div>
					<?php
				}
				
				else {
					$compteur4 ++;
				}
			}
			
			if ($compteur4==3) {
				echo("<p>Aucun commentaire récent à afficher</p>");
			}
			?>
		</div>
		
		<?php include('footer.php') ?>
		
			<script type="text/javascript">
		//<!--
		fermeture_init("#cache1");
		fermeture_init("#cache2");
		//-->
	</script>
	</body>
</html>