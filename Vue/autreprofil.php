	<?php
	session_start();
	if( isset($_SESSION['id_utilisateur']) && $_SESSION['id_utilisateur']==$_GET['id_utilisateur']){
		header("Refresh:0 ,url=../Vue/monprofil.php");
	}
	$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
	mysqli_set_charset($connect,"utf8");
	
	//récupération des informations de l'utilisateur
	$profil = mysqli_fetch_assoc(mysqli_query($connect, "select * from utilisateur where id_utilisateur=".$_GET['id_utilisateur'].""));
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/autreprofil.css"/>
		<script type="text/javascript" src="monprofil.js"></script>
		
		<!-- le titre de la page changera en fonction de l'utilisateur -->
		<title><?php echo($profil['prenom_u'])?> <?php echo($profil['nom_u'])?></title>
	</head>
	
	<body>
	<?php
	include("Header.php");
	?>
	<div id="presentation_autre_profil">
	<?php
	
	//si l'utilisateur clique sur "ajouter en ami", cela envoie un message avec le lien vers le script
	if (isset($_POST['requete'])) {
		if (isset($_POST['ajout']) and isset($_SESSION['id_utilisateur'])) {
			
			//récupération des infos nécessaires à l'ajout des lignes dans la BDD
			$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_POST['destinataire'].""));
			$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
			$sujet="Demande d'ajout en ami";
            $lien="localhost/simplevent/ajoutami.php?id_utilisateur=";
			
			//création du texte et des variables devant transiter dans le lien
			$texte="".$nom_exp['prenom_u']." souhaite devenir votre ami, veuillez suivre le lien suivant pour accepter ! (Vous pouvez également ignonrer sa demande en supprimant ce message)  <a href=".$lien."".$_SESSION['id_utilisateur']."&id_ami=".$_POST['destinataire'].">Ajouter cet ami</a>";
			mysqli_query($connect, "insert into messagerie(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte) values (".$_POST['destinataire'].", ".$_SESSION['id_utilisateur'].", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', '".$sujet."', '".$texte."')");
			echo("<h4 style='background-color:#59b7ff'>La demande d'ami a bien été envoyée</h4>");
		}
		
		//si l'utilisateur a cliqué sur "envoyer un message"
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
		
		//après avoir cliqué sur "envoyer un message" il l'a écrit et envoyé, ces lignes l'ajoutent à la BDD
		elseif (isset($_POST['envoye'])) {
			
			//récupération des noms du destinataire et de l'expéditeur
			$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_POST['destinataire'].""));
			$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
			$sujet=htmlspecialchars(addslashes($_POST['sujet']));
			$texte=htmlspecialchars(addslashes($_POST['texte']));
			//ajout de la ligne dans la BDD
			mysqli_query($connect, "insert into messagerie(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte) values (".$_POST['destinataire'].", ".$_SESSION['id_utilisateur'].", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', '$sujet', '$texte')");
			echo("<h4 style='background-color:#59b7ff'>Le message a bien été envoyé</h4>");
		}
		
		//si l'utilisateur signale le profil
		elseif (isset($_POST['signalement']) and isset($_SESSION['id_utilisateur'])) {
			$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=1"));
			$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
			$sujet="Signalement de l'utilisateur numéro ".$_GET["id_utilisateur"]."";
			$texte="".$_SESSION['id_utilisateur']." souhaite signaler cet utilisateur";
			mysqli_query($connect, "insert into messagerie(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte) values (1, ".$_SESSION['id_utilisateur'].", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', '".$sujet."', '".$texte."')");
			echo("<h4 style='background-color:#59b7ff'>Le signalement a bien été envoyé à un administrateur</h4>");
		}
		
		else {
			//si l'utilisateur n'est pas connecté, on le renvoie vers la page de connexion
			header('Location:connexion.php');
		}
	}
	?>
			<div id="nom_autre_profil">
				<h1><?php echo($profil['prenom_u'])?> <?php echo($profil['nom_u'])?></h1>
			</div>
			<div id="photo_autre_profil">
				<img src="<?php echo($profil['photo_u'])?>" id="photoprof">
			</div>
			<div id="description_autre_profil">
				<h3>Sa description :</h3>
				<p><?php echo($profil['description'])?></p>
			</div>
			<div id="boutons_autre_profil">
				<?php 
				$rel_ami=mysqli_query($connect, "select count(id_utilisateur) as ami from relation_amicale Where id_utilisateur=$id_utilisateur and id_ami=".$_GET['id_utilisateur']);
				$rel_ami=mysqli_fetch_assoc($rel_ami);
				
				//teste si les utilisateurs sont déjà amis ou non
				if($rel_ami['ami']!=1){	
				?>
				<form method="post" action=	"ajoutami.php?id_utilisateur='.$_SESSION['id_utilisateur'].'&id_ami='.$_POST['destinataire'].">
					<input type="hidden" name="requete" value="oui">
					<input type="hidden" name="ajout" value="oui">
					<input type="hidden" name="destinataire" value="<?php echo($profil['id_utilisateur']) ?>">
					<input type="submit" value="Demander en ami" class="bouton_autre_profil">
				</form>
				<?php }?>
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
					<input type="submit" value="Signaler l'utilisateur" class="bouton_autre_profil_signal" onclick="report('util',<?php echo $_GET['id_utilisateur']?>)">
				</form>
			</div>
		</div>
		<div id="participation_evenements">
			<h2>Evénements futurs : </h2>
			<?php
			$date=date("Y-m-d");
			
			//ne sélectionne que les évenements dans le futur
			$evenements=mysqli_query($connect, "select * from event natural join multimedia natural join participation where id_participant=".$_GET['id_utilisateur']." and date_e>'".$date."'");
			$compteur1=0;
			while ($data=mysqli_fetch_assoc($evenements)) {
				$compteur1 ++;
				
				//le compteur permet de savoir à partir de quand cacher les entrées. Le reste sera visible grâce au JS
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
				//si aucun événement
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
			
			//évenements où l'id utilisateur est celui du profil visionné
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
			
			//selectionne les commentaires s'il y en a
			$commentaires=mysqli_query($connect, "select * from commente inner join multimedia on multimedia.Event_id=commente.Event_id inner join event on event.Event_id=commente.Event_id where commente.id_utilisateur =".$_GET['id_utilisateur']." and principale=1 order by date_co desc");
			$compteur3=0;
			$compteur4=0;
			
			//n'en affiche que 3
			while (($data=mysqli_fetch_assoc($commentaires)) && $compteur3<3) {
				$compteur3 ++;
				if ($data['texte_co']!=NULL) {
					
					?>
					<div class="commentaire">
					<a href="Events.php?Event_id=<?php echo($data["Event_id"]) ?>">
						<div class="vignette_commentaire">
							<img src="<?php echo($data['urlimg_event']) ?>" />
						</div>
					</a>
						<div class="texte_commentaire">
							<h4><?php echo($data['Nom_e']) ?></h4>
							<p style="word-wrap:break-word"><?php echo($data['texte_co']) ?></p>
						</div>
					</div>
					<?php
					$compteur4 ++;
				}
				
			}
			
			if ($compteur4==0) {
				echo("<p>Aucun commentaire récent à afficher</p>");
			}
			?>
		</div>
		
		<?php include('footer.php') ?>
		
			<script type="text/javascript">
		profpic();
		//<!--
		fermeture_init("#cache1");
		fermeture_init("#cache2");
		//-->
		profpic();
	</script>
	</body>
</html>