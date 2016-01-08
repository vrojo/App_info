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
	$result=mysqli_query($connect_e, "SELECT * from utilisateur where id_utilisateur=$id_utilisateur");
	$result=mysqli_fetch_assoc($result);
	$motpasse=$result['mot_de_passe'];
	$conf_mod_prof=$result['conf_mod_prof'];
	if ($id_utilisateur==0){
		return FALSE;
	}
	elseif($mdp==$motpasse && $conf_mod_prof==0 && !isset($_GET['modif'])){
		return 'MODIF';
	}
	elseif($mdp==$motpasse && $conf_mod_prof==1 OR $mdp==$motpasse && $conf_mod_prof==0 && isset($_GET['modif'])){
		return 'CONNECTE';
	}
	else{
		return 'PASCONNECTE';
	}
	
}
function verifadmin ($id_utilisateur){
	global $connect_e;
	$admin=mysqli_fetch_assoc(mysqli_query($connect_e,"SELECT * from utilisateur where id_utilisateur=$id_utilisateur"));
	if ($admin['admin']==1){
		return 1;		
	}
	else{
		return 0;
	}
}
function blocresum($type,$id){
	global $connect_e;
	global $id_utilisateur;
	if($type=='message'){
		$result=mysqli_query($connect_e,"SELECT * from messagerie where id_destinataire=$id_utilisateur");
		while ($data = mysqli_fetch_assoc($result)) {
			$image_util=mysqli_query($connect_e,"SELECT * from utilisateur where id_utilisateur=".$data['id_expediteur']);
			$image_util=mysqli_fetch_assoc($image_util);
			?>
		<a href="messagerie.php?but=messages_recus"><div class="petitblocresum">
			<div class="bleft">
				<div class="bandeauhaut" style="height:25%;">
					<p style="font-size:0.4em;text-align:center;margin:0"><?php echo $data['nom_expediteur']?></p>
					
				</div>
				<div class="bandeaubas" style="height:75%">
					<img src="<?php echo $image_util['photo_u'] ?>" class="imgblocresum"/>
				</div>
			</div>
			<div class="bright">
				<p style="font-size:0.4em"><?php echo $data['sujet']?></p>
				<p style="font-size:0.4em"><?php echo $data['texte']?></p>
			</div>
			
		</div></a>
		
<?php	
}
		
	}
	elseif($type=='eventcree'){
		$result=mysqli_query($connect_e,"SELECT * from event where id_utilisateur=$id_utilisateur");
		while ($data = mysqli_fetch_assoc($result)) {
			$image_event=mysqli_query($connect_e,"SELECT * from multimedia where Event_id=".$data['Event_id']);
			$image_event=mysqli_fetch_assoc($image_event);
			?>
		<a href="Events.php?Event_id=<?php echo $data['Event_id']?>"><div class="petitblocresum">
			<div class="bleft">
				<div class="bandeauhaut" style="height:25%;">
					<p style="font-size:0.4em;text-align:center;margin:0"><?php echo $data['Nom_e']?></p>
				</div>
				<div class="bandeaubas" style="height:75%">
					<img src="<?php echo $image_event['urlimg_event'] ?>" class="imgblocresum"/>
				</div>
			</div>
			<div class="bright">
				<p style="font-size:0.4em"><?php echo $data['description_e']?></p>
			</div>
			
		</div></a>
		
<?php	
}
	}
	elseif($type=='eventparticipe'){
		$result=mysqli_query($connect_e,"SELECT * from participation where id_participant=$id_utilisateur");
		$result=mysqli_fetch_assoc($result);
		$result=$result['Event_id'];
		$result=mysqli_query($connect_e,"SELECT * from event where Event_id=$result");
		while ($data = mysqli_fetch_assoc($result)) {
			$image_event=mysqli_query($connect_e,"SELECT * from multimedia where Event_id=".$data['Event_id']);
			$image_event=mysqli_fetch_assoc($image_event);
			
			?>
		<a href="../Vue/Events.php?Event_id=<?php echo $data['Event_id']?>"><div class="petitblocresum">
			<div class="bleft">
				<div class="bandeauhaut" style="height:25%;">
					<p style="font-size:0.4em;text-align:center;margin:0"><?php echo $data['Nom_e']?></p>
				</div>
				<div class="bandeaubas" style="height:75%">
					<img src="<?php echo $image_event['urlimg_event'] ?>" class="imgblocresum"/>
				</div>
			</div>
			<div class="bright">
				<p style="font-size:0.4em"><?php echo $data['description_e']?></p>
			</div>
			
		</div></a>
		
<?php	
}
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