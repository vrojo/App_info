<!-- script permettant l'ajout d'un ami -->

<!-- lorsqu'une demande est envoyée, le lien sur lequel il faut cliquer contient les id des deux futurs amis. -->

<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../Style/ajoutami.css"/>
		<title>Ajout d'ami</title>
	</head>
	
	<body>
		<?php
		include("Header.php");
		$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
		mysqli_set_charset($connect,"utf8");
		
		//test permettant de vérifier que l'url de la page contient bien les champs nécessaires
		if (isset($_GET['id_utilisateur']) and isset($_GET['id_ami'])) {
			
			//vérfie si la ligne n'existe pas déjà dans la BDD, pour savoir qu'ils ne sont pas déjà amis
			$exist=mysqli_query($connect, "select exists (select * from relation_amicale where id_utilisateur=".$_GET['id_utilisateur']." and id_ami=".$_GET['id_ami'].") as exist");
			
			//s'ils ne sont pas amis, alors $exist=0
			if ($exist['exist']==0) {
				
				//ces deux requêtes permettent de créer les deux lignes reliant les deux utilisateurs en temps qu'amis
				mysqli_query($connect, "insert into relation_amicale(id_utilisateur, id_ami) values (".$_GET['id_utilisateur'].", ".$_GET['id_ami'].")");
				mysqli_query($connect, "insert into relation_amicale(id_utilisateur, id_ami) values (".$_GET['id_ami'].", ".$_GET['id_utilisateur'].")");
			?>
			<div id="ajoutami">
				<h3>Cet utilisateur a bien été ajouté à vos amis !</h3>
				<h3>Vous allez être redirigé vers la page d'accueil de Simplevent</h3>
			</div>
			<?php
			}
			else {
				?>
				<div id="ajoutami">
					<h3>Cet utilisateur est déjà votre ami !</h3>
					<h3>Vous allez être redirigé vers la page d'accueil de Simplevent</h3>
				</div>
				<?php
			}
		}
		
		//si le lien est faux, alors on prévient l'utilisateur
		else {
			?>
			<div id="ajoutami">
				<h3>L'URL est faux !</h3>
				<h3>Vous allez être redirigé vers la page d'accueil de Simplevent</h3>
			</div>
			<?php
		}
		
		<?php include('carrousel2.php');?>
		//utilisation de header pour retourner à la page d'accueil, après 5 secondes
		header ("Refresh: 5 ; URL=accueil.php");
		include('footer.php');
		?>
	</body>
</html>