<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/messagerie.css"/>
		<title>Messagerie</title>
	</head>
	
	<?php
	session_start();
	$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");/*
	mysqli_set_charset($connect,"utf8");*/
	?>
	
	<body>
		<?php 
		include("Header.php");
		?>
		
		<div id="choix_messages">
			<form method="get" action="messagerie.php" class="choix">
				</br>
				<input type="hidden" name="but" value="ecrire_un_message" />
				<input type="submit" value="Ecrire un message" class="Bouton_choix"/>
				</br>
			</form>
			<form method="get" action="messagerie.php" class="choix">
				</br>
				<input type="hidden" name="but" value="messages_recus" />
				<input type="submit" value="Messages reçus" class="Bouton_choix"/>
				</br>
			</form>
			<form method="get" action="messagerie.php" class="choix">
				</br>
				<input type="hidden" name="but" value="messages_envoyes" />
				<input type="submit" value="Messages envoyés" class="Bouton_choix"/>
				</br>
			</form>
		</div>
		
		<?php
		if (isset($_POST['id_suppr'])) {
			if ($_POST['type']=="recus") {
				mysqli_query($connect, "update messagerie set id_destinataire=0 where id_message=".$_POST['id_suppr']."");
			}
			else {
				mysqli_query($connect, "update messagerie set id_expediteur=0 where id_message=".$_POST['id_suppr']."");
			}
		}
		
		if ($_GET["but"]=="ecrire_un_message") {
			?>
			<div id="contenant_envoyer_message">
			<?php
			if (isset($_POST["envoye"]) and $_POST["envoye"]=="oui" and $_POST["texte"]!="") {
				$id_dest=mysqli_fetch_assoc(mysqli_query($connect, "select id_utilisateur from utilisateur where id_utilisateur=".$_POST['destinataire'].""));
				$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_POST['destinataire'].""));
				$id_exp=$_SESSION['id_utilisateur'];
				$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
				$sujet=$_POST['sujet'];
				$texte=$_POST['texte'];
				mysqli_query($connect, "insert into messagerie(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte) values (".$id_dest['id_utilisateur'].", ".$id_exp.", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', '".$sujet."', '".$texte."')");
				$message_envoye=mysqli_query($connect, "select exists (select * from messagerie where texte='".$_POST['texte']."')");
			}
			
			if (isset($_POST["envoye"]) and $texte and $message_envoye) {
				?>
				<div class="message_envoye">
					<p>Le message a bien été envoyé !</p>
				</div>
				<?php
			}
			if (isset($_POST["envoye"]) and $message_envoye==false) {
				?>
				<div class="message_envoye">
					<p>Il semblerait que le message n'ait pas pu être envoyé...</p>
				</div>
				<?php
			}
			?>
			
				<form method="post" action="" id="ecriture_message">
					</br>
					</br>
					<label for="destinataire">Contact : </label>
					<select name="destinataire" id="destinataire">
						<?php
						$amis=mysqli_query($connect, "select id_ami from relation_amicale where id_utilisateur=".$_SESSION['id_utilisateur']."");
						while ($data=mysqli_fetch_assoc($amis)) {
							$noms=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u, nom_u from utilisateur natural join relation_amicale where id_utilisateur=".$data['id_ami'].""));
							echo("<option value=".$data['id_ami'].">".$noms['prenom_u']." ".$noms['nom_u']."</option>");
						}
						?>
					</select>
					</br>
					</br>
					<label for="sujet">Sujet : </label>
					<input name="sujet" id="sujet" placeholder="ex : Bonjour" />
					</br>
					</br>
					<label for="texte">Texte : </label>
					<textarea name="texte" id="texte" placeholder="Entrez votre message ici"></textarea>
					</br>
					</br>
					<input type="hidden" name="but" value="ecrire_un_message" />
					<input type="hidden" name="envoye" value="oui" />
					<input type="submit" value="Envoyer" class="bouton_envoyer"/>
					</br>
					</br>
				</form>
			</div>
			
			<?php
		}
		
		if ($_GET["but"]=="messages_recus") {
			$messages_recus=mysqli_query($connect, "select * from messagerie where id_destinataire=".$_SESSION['id_utilisateur']."");
			?>
			
			<div id="contenant_messages_recus">
				<?php
				while ($data=mysqli_fetch_assoc($messages_recus)) {
				$profil=mysqli_fetch_assoc(mysqli_query($connect, "select photo_u, prenom_u from utilisateur where id_utilisateur=".$data['id_expediteur'].""))
				?>
				
				<div class="message">
					<div class="image_expediteur">
						<img src=<?php echo($profil["photo_u"]) ?> />
						<p class="nom_contact"><?php echo($profil["prenom_u"]) ?></p>
					</div>
					<div class="contenu_message">
						<div class="titre_message">
							<h3><?php echo($data["sujet"]) ?></h3>
						</div>
						<div class="texte_message">
							<p><?php echo($data["texte"]) ?></p>
						</div>
						<div class="boutons_messages">
							<form method="POST" action="messagerie.php?but=messages_recus" class="form_boutons">
								<input type="hidden" name="id_reponse" value="<?php echo($data['id_expediteur'])?>"/>
								<input type="hidden" name="nom_reponse" value="<?php echo($profil['prenom_u'])?>"/>
								<input type="hidden" name="sujet_reponse" value="<?php echo($data['sujet'])?>"/>
								<input type="submit" value="Répondre" class="bouton_envoyer"/>
							</form>
							<form method="POST" action="messagerie.php?but=messages_recus" class="form_boutons">
								<input type="hidden" name="type" value="recus" />
								<input type="hidden" name="id_suppr" value="<?php echo($data['id_message'])?>"/>
								<input type="submit" value="Supprimer" class="style_bouton_suppression"/>
							</form>
						</div>
					</div>
				</div>
			<?php
			}
			
			if (isset($_POST['id_reponse'])) {
				?>
				<div id="bloc_reponse">
					</br>
					<p>Réponse à <?php echo($_POST['nom_reponse']) ?></p>
					<p>Sujet : Re : <?php echo($_POST['sujet_reponse'])?></p>
					<form method="POST" action="messagerie.php?but=ecrire_un_message">
						<input type="hidden" name="destinataire" value=<?php echo($_POST['id_reponse']) ?> />
						<input type="hidden" name="sujet" value="RE :<?php echo($_POST['sujet_reponse'])?>" />
						<label for="texte">Texte : </label>
						<textarea name="texte" id="texte" placeholder="Entrez votre message ici"></textarea>
						<input type="hidden" name="envoye" value="oui" />
						<input type="submit" value="Envoyer" class="bouton_envoyer"/>
						</br>
					</form>
					<form method="POST" action="">
						<input type="submit" value="Annuler" class="style_bouton_suppression" />
						</br>
						</br>
					</form>
				</div>
				<?php
			}
			echo("</div>");
		}
		
		if ($_GET["but"]=="messages_envoyes") {
			$messages_recus=mysqli_query($connect, "select * from messagerie where id_expediteur=".$_SESSION['id_utilisateur']."");
			?>
			<div id="contenant_messages_recus">
				<?php
				while ($data=mysqli_fetch_assoc($messages_recus)) {
				$profil=mysqli_fetch_assoc(mysqli_query($connect, "select photo_u, prenom_u from utilisateur where id_utilisateur=".$data['id_destinataire'].""))
				?>
				
				<div class="message">
					<div class="image_expediteur">
						<img src=<?php echo($profil["photo_u"]) ?> />
						<p class="nom_contact"><?php echo($profil["prenom_u"]) ?></p>
					</div>
					<div class="contenu_message">
						<div class="titre_message">
							<h3><?php echo($data["sujet"]) ?></h3>
						</div>
						<div class="texte_message">
							<p><?php echo($data["texte"]) ?></p>
						</div>
						<div class="boutons_messages">
							<form method="POST" action="messagerie.php?but=messages_envoyes">
								<input type="hidden" name="id_suppr" value="<?php echo($data['id_message'])?>"/>
								<input type="hidden" name="type" value="envoyes" />
								<input type="submit" value="Supprimer" class="style_bouton_suppression"/>
							</form>
						</div>
					</div>
				</div>
			<?php
			}
			echo("</div>");
		}
		include('footer.php');
		?>
	</body>
</html>