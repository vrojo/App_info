<?php 
session_start();

$id_utilisateur=$_SESSION['id_utilisateur'];

	$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
	if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
	$Event_id=$_GET['Event_id'];
	$particip=mysqli_query($connect_e,"select * from participation WHERE (Event_id=$Event_id AND id_participant=$id_utilisateur)")->num_rows;
	if ($particip == 1){
		mysqli_query($connect_e,"DELETE FROM participation WHERE (Event_id=$Event_id AND id_participant=$id_utilisateur)");
	}
	else{
		mysqli_query($connect_e,"INSERT INTO participation (Event_id, id_participant)values('$Event_id','$id_utilisateur')");
	}
	
	?>