<?php
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect_e,"utf8");
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
if (isset($_SESSION['id_utilisateur'])==TRUE && isset($_SESSION['mot_de_passe'])==TRUE){
	$id_utilisateur=$_SESSION['id_utilisateur'];
	$mdp=$_SESSION['mot_de_passe'];
}
else{
	$id_utilisateur=0;
	$mdp=0;
}
function verifco($mdp,$id_utilisateur){
	global $connect_e;
	$result=mysqli_query($connect_e, "SELECT mot_de_passe from utilisateur where id_utilisateur=$id_utilisateur");
	$result=mysqli_fetch_assoc($result);
	$motpasse=$result['mot_de_passe'];
	if ($id_utilisateur==0){
		return FALSE;
	}
	elseif($mdp==$motpasse){
		return TRUE;
	}
	else{
		return FALSE;
	}
	
}
if (verifco($mdp,$id_utilisateur)==TRUE){
	global $connect_e;
	$result=mysqli_query($connect_e, "SELECT * from utilisateur where id_utilisateur=$id_utilisateur");
	$result=mysqli_fetch_assoc($result);
	$nom_u=$result['nom_u'];
	$prenom_u=$result['prenom_u'];
	$photo_u=$result['photo_u'];
}
$Nb_event=mysqli_query($connect_e,"select * from event")->num_rows;
$Nb_utilisateurs=mysqli_query($connect_e,"select * from utilisateur")->num_rows;


?>