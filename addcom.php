<?php 
session_start();

$id_utilisateur=$_SESSION['id_utilisateur'];

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
$Event_id=$_POST['Event_id'];
$com = htmlspecialchars (addslashes($_POST['Commentaire']));

mysqli_query($connect_e,"INSERT INTO commente (texte_co,id_utilisateur,Event_id,date_co) values ('$com','$id_utilisateur','$Event_id',NOW())") ;
header("Refresh:0 ,url=Events.php?Event_id=$Event_id");

?>