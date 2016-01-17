<?php 
session_start();

$id_utilisateur=$_SESSION['id_utilisateur'];
// Même principe que pour les commentaire
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
$topic=$_POST['Topic'];
$topic=htmlspecialchars (addslashes($topic));
$com = htmlspecialchars (addslashes($_POST['Commentaire']));
if (!empty($com)){
mysqli_query($connect_e,"INSERT INTO rep_topic (commentaire_r,id_utilisateur,id_topic,date) values ('$com','$id_utilisateur','$topic',NOW())") ;
}

header("Refresh:0 ,url=../Vue/Topic.php?Topic=$topic");
?>