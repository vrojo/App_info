<?php 
session_start();

$id_utilisateur=$_SESSION['id_utilisateur'];
// On se connecte à la base de donnée
$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");
$Event_id=$_POST['Event_id'];
$Event_id=htmlspecialchars (addslashes($Event_id));
// On ajoute les balises devant les charactères spéciaux et les sauts de ligne puis on insère le commentaire dans la base de données
$com = nl2br(htmlspecialchars (addslashes($_POST['Commentaire'])));
if (!empty($com)){
mysqli_query($connect,"INSERT INTO commente (texte_co,id_utilisateur,Event_id,date_co) values ('$com','$id_utilisateur','$Event_id',NOW())") ;
}
header("Refresh:0 ,url=../Vue/Events.php?Event_id=$Event_id");

?>