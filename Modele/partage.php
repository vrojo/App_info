<?php
session_start();
$id_utilisateur=$_SESSION['id_utilisateur'];

$connect= mysqli_connect("localhost", "root", "", "bddsimplevent");
if (!$connect) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
	$nom_e=mysqli_fetch_assoc(mysqli_query($connect, "select Nom_e from event where Event_id=".$_GET['event']));
	$id_dest=mysqli_fetch_assoc(mysqli_query($connect, "select id_utilisateur from utilisateur where id_utilisateur=".$_GET['ami'].""));
	$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_GET['ami'].""));
	$id_exp=$_SESSION['id_utilisateur'];
	$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=".$_SESSION['id_utilisateur'].""));
	mysqli_query($connect, 
	"insert into messagerie
	(id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte)
	values (".$id_dest['id_utilisateur'].", ".$id_exp.", '".$nom_dest['prenom_u']."', '".$nom_exp['prenom_u']."', ' Invitation à l'événement:". $nom_e['Nom_e']."', 'Allez voir cet événement !')");
?>