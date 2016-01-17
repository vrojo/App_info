<?php

session_start();
	if (isset($_SESSION['id_utilisateur'])){
	$id_utilisateur=$_SESSION['id_utilisateur'];
	}
	$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
	if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
	$Event_id=$_GET['Event_id'];
	function notationphp($Event_id){
	if (isset ($id_utilisateur ) && mysqli_query($connect_e,"select Note from participation WHERE (Event_id=$Event_id AND id_utilisateur=$id_utilisateur)")->num_rows>0){
		$note=mysqli_fetch_assoc(mysqli_query($connect_e,"Select Note from participation Where Event_id=$Event_id AND id_utilisateur=$id_utilisateur"));
	}
	else{
		$note=mysqli_fetch_assoc(mysqli_query($connect_e,"Select AVG Note from participation Where Event_id=$Event_id "));
	}
        //Vérification de la note déjà existante pour l'utilisateur
        //Si elle n'existe pas, on prend la moyenne des notes attribuée

	if ($note>=4.5){
		$listenote= array('star1','star2','star3','star4','star5');		
	}
	elseif($note>=3.5){
		$listenote= array('star1','star2','star3','star4');		
	}
	elseif($note>=2.5){
		$listenote= array('star1','star2','star3');		
	}
	elseif($note>=1.5){
		$listenote= array('star1','star2');		
	}
	else{
		$listenote= array('star1');		
	}

	}
?>