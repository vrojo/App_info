<?php
$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");
if (!$connect) {
    printf("Echec de la connexion : %s\n", mysqli_connectrror());
    exit();
	}
//Vérification de la présence d'un utilisateur connecté ou non
        
if (isset($_SESSION['id_utilisateur'])==TRUE && isset($_SESSION['mot_de_passe'])==TRUE){
	$id_utilisateur=$_SESSION['id_utilisateur'];
	$mdp=$_SESSION['mot_de_passe'];
//Si il y a déjà une session en cous, on enregistre les paramètre
        
}
else{
	$id_utilisateur=0;
	$mdp=0;
        //Sinon on les initialise à 0
}
// Cette fonction vérifie si l'utilisateur connecté est bien connecté comme il faut
function verifco($mdp,$id_utilisateur){
	global $connect;
	$result=mysqli_query($connect, "SELECT * from utilisateur where id_utilisateur=$id_utilisateur");
	$result=mysqli_fetch_assoc($result);
	$motpasse=$result['mot_de_passe'];
	$conf_mod_prof=$result['conf_mod_prof'];
	if ($id_utilisateur==0){  //Si pas d'utilisateur connecté, renvoi False
		return FALSE;
	}
	elseif($mdp==$motpasse && $conf_mod_prof==0 && !isset($_GET['modif'])){ //Si utilisateur connecté, mais pas encore de profil complet, renvoi modif
		return 'MODIF';
	}
	elseif($mdp==$motpasse && $conf_mod_prof==1 OR $mdp==$motpasse && $conf_mod_prof==0 && isset($_GET['modif'])){
		return 'CONNECTE'; //Si utilisateur connecté avec profil coplet, ou connecté et en train de compléter profil, renvoi connecté
	}
	else{
		return 'PASCONNECTE';//Sinon renvoi pas connecte
	}
	
}

//Cette fonction vérifie les droits d'un utilisateur connecté.

function verifadmin ($id_utilisateur){
	global $connect;
	$admin=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * from utilisateur where id_utilisateur=$id_utilisateur"));
	if ($admin['admin']==1){
		return 1;		
	}
	else{
		return 0;
	}
        //Si il est admin renvoie 1, sinon renvoie 0.
}
function blocresum($type,$id){
	global $connect;
	global $id_utilisateur;
	if($type=='message'){
		$i=0;
		$result=mysqli_query($connect,"SELECT * from messagerie where id_destinataire=$id_utilisateur Order by id_message desc");
		while (($data = mysqli_fetch_assoc($result)) && $i!=4) {
			$image_util=mysqli_query($connect,"SELECT * from utilisateur where id_utilisateur=".$data['id_expediteur']);
			$image_util=mysqli_fetch_assoc($image_util);
			?>
		<a href="messagerie.php?but=messages_recus"><div class="petitblocresum">
			<div class="bleft">
				<div class="bandeauhaut" style="height:25%;">
					<p style="font-size:0.4em;text-align:center;margin:0"><?php echo $data['nom_expediteur']?></p>
					
				</div>
				<div class="bandeaubas" style="height:75%">
					<img src="<?php echo $image_util['photo_u'] ?>" class="imgblocresum" style="width:75px;height:75px;border-radius:100%"/>
				</div>
			</div>
			<div class="bright">
				<p style="font-size:0.4em"><?php echo $data['sujet']?></p>
				<p style="font-size:0.4em"><?php echo $data['texte']?></p>
			</div>
			
		</div></a>
		
<?php $i++;	
}
		
	}
	elseif($type=='eventcree'){
		$result=mysqli_query($connect,"SELECT * from event where id_utilisateur=$id_utilisateur order by Event_id desc");
		$i=0;
		while (($data = mysqli_fetch_assoc($result)) && $i!=4) {
			$image_event=mysqli_query($connect,"SELECT * from multimedia where principale=1 and Event_id=".$data['Event_id']);
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
		
<?php	$i++;
}
	}
	elseif($type=='eventparticipe'){
		$result=mysqli_query($connect,"SELECT * from participation natural join event where id_participant=$id_utilisateur order by Event_id desc");
		$i=0;
		while (($data = mysqli_fetch_assoc($result)) && $i!=4) {
			$image_event=mysqli_query($connect,"SELECT * from multimedia where principale=1 and Event_id=".$data['Event_id']);
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
		
<?php	$i++;
}
	}
}



if (verifco($mdp,$id_utilisateur)==TRUE){//Si l'utilisateur est bien connecté, on récupère ses info pour les afficher dans le header
	global $connect;
	$result=mysqli_query($connect, "SELECT * from utilisateur where id_utilisateur=$id_utilisateur");
	$result=mysqli_fetch_assoc($result);
	$nom_u=$result['nom_u'];
	$prenom_u=$result['prenom_u'];
	$photo_u=$result['photo_u'];
}
$Nb_event=mysqli_query($connect,"select * from event")->num_rows;
$Nb_utilisateurs=mysqli_query($connect,"select * from utilisateur")->num_rows;


?>