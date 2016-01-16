<?php
session_start();
$id_utilisateur=$_SESSION['id_utilisateur'];

$connect= mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");
if (!$connect) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
	$idevent=$_GET['event'];
	$ami=$_GET['ami'];
	$nom_e=mysqli_fetch_assoc(mysqli_query($connect, "select Nom_e from event where Event_id=$idevent"));
	$nom_e=$nom_e["Nom_e"];
	$nom_dest=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=$ami"));
	$nom_dest=$nom_dest['prenom_u'];
	$nom_exp=mysqli_fetch_assoc(mysqli_query($connect, "select prenom_u from utilisateur where id_utilisateur=$id_utilisateur"));
	$nom_exp=$nom_exp['prenom_u'];
	$sujet=addslashes("Invitation à l'événement:".$nom_e);
	$texte=addslashes("Cet événement pourrait vous intéresser:<a href=../Vue/Events.php?Event_id=".$idevent.">".$nom_e."</a>");
	mysqli_query($connect, 
	"insert into messagerie (id_destinataire, id_expediteur, nom_destinataire, nom_expediteur, sujet, texte)
	values ('$ami','$id_utilisateur','$nom_dest','$nom_exp','$sujet','$texte')");
?>