<?php

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}

if(isset($_GET['Event_id'])&&  event_existe($_GET['Event_id'])==TRUE){
	$Event_id=$_GET['Event_id'];
		
}
else{
	ob_start(); 
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Evénements</title>	
	</head>
	<body>
	<?php include ("Header.php") ?>
		<div style="width:100%;margin:0;text-align:center;display:inline-block;float:left;clear:both;"><h2>Cette page n'existe pas, vous allez être redirigé vers la page d'accueil</h2></div>
	</body>
</html>
	<?php
	header("Refresh: 5, url=../ACCUEIL/Accueil.php");
	ob_flush();
	exit();
	
}
function event_existe($Event_id){
	global $connect_e;
	$result=mysqli_query($connect_e,"select * from event where Event_id=".$Event_id);
	if(($result->num_rows) > 0)
{
 
	$existe=TRUE;
}
else
{
	$existe=FALSE;
}
return $existe;
}


function select_event($Event_id) {
    global $connect_e;
     $result=mysqli_query($connect_e,"select * from event where Event_id=".$Event_id) or die("MySQL Erreur : " . mysqli_error());
     return $result;
}

$result = select_event($_GET['Event_id']);
$event = mysqli_fetch_assoc($result);
$nom_e = $event['Nom_e'];
$description = $event['description_e'];
$prix =$event['prix'];
$privacy=$event['privacy'];
$Id_crea=$event['id_utilisateur'];

?>