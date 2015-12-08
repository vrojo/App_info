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
	header("Refresh: 3, url=Accueil.php");
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

function carroussel($Id_particip){
	$i=0;
	while ($i!=6)
	{
		echo("<a href='#'><div class='Eventcarr' style='background-image:url(http://media.melty.fr/article-1896793-so/media.jpg);'></div></a>");
		$i ++;
	}	
}

function coms ($Event_id){
	global $connect_e;
	$result=mysqli_query($connect_e,"SELECT * from commente where Event_id=$Event_id");
	
while ($data = mysqli_fetch_assoc($result)) {
	$id_commentateur=$data['id_utilisateur'];
	$util=mysqli_fetch_assoc(mysqli_query($connect_e,"SELECT * from utilisateur where id_utilisateur=$id_commentateur"));
	?> <div class="bandeaucom">
			<div class="bleft" style="width:30%;height:100%">
				<div class="bleft" style="width:50%;height:100%">
					<img src="<?php echo $util['photo_u']?>" class="profpic" style="float:right; height:90px; width:90px; margin:0; margin-right:20px"/>	
				</div>
				<div class="bright" style="width:50%; height:100%">
					<div class="bandeauhaut" style="height:20%; padding-top:10%;">
						<p style="top:50%; transform:translate(0,-50%)"><?php echo $util["prenom_u"].' '.$util["nom_u"] ?></p>
					</div>
					<div class="bandeaumilieu" style="height:40%; ">
						<p style="font-size:0.6em; text-align:left;"><?php echo $data['date_co']; ?> </p>
					</div>
					<div class="bandeaubas" style="height:30%">
						
					</div>
				</div>
			</div>
			<div class="bleft" style="width:50%; height:100%">
				<p style="position:absolute;margin: 0; text-align:left; top:50%; transform:translate(0,-50%)"><?php echo $data['texte_co']; ?> </p>
			</div>
			<div class="bright" style="width:20%; height:100%">
			</div>
		</div> 
	<?php
}
	 
} 

?>
