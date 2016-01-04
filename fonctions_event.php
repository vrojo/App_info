<?php

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");/*
mysqli_set_charset($connect_e,"utf8");*/
?>
	
<?php
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
	
<div style="width:100%;margin:0;text-align:center;display:inline-block;float:left;clear:both;">
	<h2>Cette page n'existe pas, vous allez être redirigé vers la page d'accueil</h2>
</div>

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

$particip=mysqli_query($connect_e,"select * from participation WHERE (Event_id=$Event_id AND id_utilisateur=$id_utilisateur)")->num_rows;

function des_inscrire(){
	global $particip;
	if($particip!=0){
		echo"Se désinscrire de l'événement";
	}
	else{
		echo"S'inscrire à l'événement";
	}
	
}

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
			<a href="user.php?i=<?php echo $util['id_utilisateur']?>"><img src='<?php echo $util['photo_u']?>' class='profpic' style='height:75%; width:10%;margin-top:5px'/></a>
			
		<?php
		$i ++;
	}
	}
}
function categories ($Event_id){
	global $connect_e;
	$result=mysqli_query($connect_e,"SELECT * from typeevent where Event_id=$Event_id");
	while ($data = mysqli_fetch_assoc($result)) {
		$categ=mysqli_query($connect_e,"SELECT * from categorie where id_categ=".$data['id_categ']);
		$categ=mysqli_fetch_assoc($categ);
		echo $categ['nomCat'];
		
	}
}
function coms ($Event_id){
	global $connect_e;
	global $id_utilisateur;
	global $Id_crea;
	$result=mysqli_query($connect_e,"SELECT * from commente where Event_id=$Event_id");
	
while ($data = mysqli_fetch_assoc($result)) {
	$id_commentateur=$data['id_utilisateur'];
	$util=mysqli_fetch_assoc(mysqli_query($connect_e,"SELECT * from utilisateur where id_utilisateur=$id_commentateur"));
	?> <div class="bandeaucom">
			<div class="bleft" style="width:30%;height:100%">
				<div class="bleft" style="width:50%;height:100%">
					<a href="user.php?i=<?php echo $util['id_utilisateur']?>"><img src="<?php echo $util['photo_u']?>" class="profpic" style="float:right; height:90px; width:90px; margin:0; margin-right:20px"/></a>
				</div>
				<div class="bright" style="width:50%; height:100%">
					<div class="bandeauhaut" style="height:20%;margin-top:10%">
						<p style="top:50%; transform:translate(0,-50%)"><?php echo $util["prenom_u"].' '.$util["nom_u"] ?></p>
					</div>
					<div class="bandeaumilieu" style="height:20%;">
						<p style="font-size:0.6em; text-align:left;"><?php echo $data['date_co']; ?> </p>
					</div>
					<div class="bandeaubas" style="height:40%;">
						<img src="https://www.dropbox.com/s/43g64iiwsnat9pw/Point-d-exclamation.png?raw=1" class="report" title="Signaler ce commentaire"/>
					</div>
				</div>
			</div>
			<div class="bleft" style="width:50%; height:100%">
				<p style="position:absolute;margin: 0; text-align:left; top:50%; transform:translate(0,-50%)"><?php echo $data['texte_co']; ?> </p>
			</div>
			<div class="bright" style="width:20%; height:100%">
				<?php 
				if ($id_commentateur==$id_utilisateur or verifadmin($id_utilisateur)==1 or $id_utilisateur==$Id_crea){?>
	
					<a href="suprcom.php?i_com=<?php echo $data['id_commentaire']?>"><img src="https://www.dropbox.com/s/ug1ko8f86ijv7t4/delete-462216_1280.png?raw=1" class="report" title="Supprimer ce commentaire" style="max-height:25px"/></a>
				<?php }?>
			</div>
		</div> 
	<?php
}
	 
} 
$Nb_comment=125*mysqli_query($connect_e,"select * from commente where Event_id='$Event_id' and texte_co IS NOT NULL")->num_rows;

		$h=0;
		if ($privacy == 1 && $Id_crea==$id_utilisateur){
			$h=18;
		} 
		elseif ($privacy == 0 && $Id_crea==$id_utilisateur OR $privacy == 1 && $Id_crea!=$id_utilisateur){
			$h=23;
		}
		else{
	$h=32;
		}
		if (verifco($mdp,$id_utilisateur)==TRUE){
			$hbandeaupres=700;
			
		}
		else {
			$hbandeaupres=600;
	 
		}
function notationphp($Event_id){
	global $connect_e;
	global $id_utilisateur;
	if (isset ($id_utilisateur ) && mysqli_query($connect_e,"select Note from participation WHERE (Event_id=$Event_id AND id_utilisateur=$id_utilisateur)")->num_rows>0){
		$note=mysqli_fetch_assoc(mysqli_query($connect_e,"Select Note from participation Where Event_id=$Event_id AND id_utilisateur=$id_utilisateur"));
		$note=$note['Note'];
		if ($note==NULL){
			$note=mysqli_fetch_assoc(mysqli_query($connect_e,"Select AVG(Note) from participation Where Event_id=$Event_id "));
			$note=$note['AVG(Note)'];
		}
	}
	else{
		$note=mysqli_fetch_assoc(mysqli_query($connect_e,"Select AVG(Note) from participation Where Event_id=$Event_id "));
		$note=$note['AVG(Note)'];
	}

	if ($note>=4.5){
		return("['star1','star2','star3','star4','star5']");		
	}
	elseif($note>=3.5){
		return("['star1','star2','star3','star4']");		
	}
	elseif($note>=2.5){
		return("['star1','star2','star3']");		
	}
	elseif($note>=1.5){
		return("['star1','star2']");		
	}
	else{
		return("['star1']");		
	}

	}
?>
