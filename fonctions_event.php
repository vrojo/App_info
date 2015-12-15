<?php

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect_e,"utf8");

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
	
<div style="width:100%;margin:0;text-align:center;display:inline-block;float:left;clear:both;"><h2>Cette page n'existe pas, vous allez être redirigé vers la page d'accueil</h2></div>

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


function carrousselprofiles(){
	global $connect_e;
	global $Event_id;
	$i=0;
	$result=mysqli_query($connect_e,"select id_utilisateur from participation where Event_id=".$Event_id);
	if ($result->num_rows>0 ){
		while (($data = mysqli_fetch_assoc($result))&& $i!=6){
		$id_particip=$data['id_utilisateur'];
		$util=mysqli_fetch_assoc(mysqli_query($connect_e,"SELECT * from utilisateur where id_utilisateur=$id_particip"));
		?>			
			<a href='#'><img src='<?php echo $util['photo_u']?>' class='profpic' style='height:3vw;width:3vw; margin-top:5px'/></a>
		<?php
		$i ++;
	}
	}
}

function coms ($Event_id){
	global $connect_e;
	global $id_utilisateur;
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
				<?php if ($id_commentateur==$id_utilisateur){?>
					<a href="suprcom.php?i_com=<?php echo $data['id_commentaire']?>"><img src="https://www.dropbox.com/s/ug1ko8f86ijv7t4/delete-462216_1280.png?raw=1" style="position:absolute;display:inline-block;height:30px;top:50%;transform:translate(0,-50%)"/></a>
				<?php }?>
			</div>
		</div> 
	<?php
}
	 
} 

?>
