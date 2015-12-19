<?php

session_start();

	$id_utilisateur=$_SESSION['id_utilisateur'];

	$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
	if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
	$note=$_GET['note'];
	$Event_id=$_GET['Event_id'];
	$particip=mysqli_query($connect_e,"select * from participation WHERE (Event_id=$Event_id AND id_utilisateur=$id_utilisateur)")->num_rows;
	if ($particip == 1){
		mysqli_query($connect_e,"UPDATE participation SET Event_id=$Event_id, id_utilisateur=$id_utilisateur, Note=$note");
	}
	else{
		echo '<script type="text/javascript"> alert("erreur")</script>';
	}

	


	
?>