<?php 
session_start();
$id_utilisateur=$_SESSION['id_utilisateur'];

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
//Suppression de commntaire sur la page d'un event.
mysqli_query($connect_e,"DELETE FROM commente WHERE id_commentaire=".$_GET['i_com']) ;

?>