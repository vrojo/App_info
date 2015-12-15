<?php 
session_start();
$id_utilisateur=$_SESSION['id_utilisateur'];

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_query($connect_e,"DELETE FROM commente WHERE id_commentaire=".$_GET['i_com']) ;
header("Refresh:0 ,url=".$_SERVER['HTTP_REFERER']);

?>