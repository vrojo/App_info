<?php 
session_start();
$id_utilisateur=$_SESSION['id_utilisateur'];

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
//Supression d'une reponse sur un topic
mysqli_query($connect_e,"DELETE FROM rep_topic WHERE id_msgforum=".$_GET['i_com']) ;

?>