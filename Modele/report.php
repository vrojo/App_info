<?php 
session_start();
$id_utilisateur=$_SESSION['id_utilisateur'];

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
	$idrep=$_GET['id'];
	$typerep=$_GET['type'];
	if ($typerep=="util"){
		mysqli_query($connect_e,"insert into signaler (id_utilisateur, id_balance) values ('$idrep','$id_utilisateur')");
	}
	elseif($typerep=="event"){
		mysqli_query($connect_e,"insert into signaler (Event_id, id_balance) values ('$idrep','$id_utilisateur')") ;
	}
	elseif($typerep=="com"){
		mysqli_query($connect_e,"insert into signaler (id_commentaire, id_balance) values ('$idrep','$id_utilisateur')") ;
	}
	elseif($typerep=="sujet"){
		mysqli_query($connect_e,"insert into signaler (sujet, id_balance) values ('$idrep','$id_utilisateur')") ;
	}
	elseif($typerep=="texte"){
		mysqli_query($connect_e,"insert into signaler (commentaire_r, id_balance) values ('$idrep','$id_utilisateur')");
	}
?>