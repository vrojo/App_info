<?php
// Connexion à la BDD
$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");
?>
	
<?php
// Message d'erreur si a connexion n'aboutit pas
if (!$connect) {
    printf("Echec de la connexion : %s\n", mysqli_connectrror());
    exit();
	}
// On vérifie si l'id de l'événement présent dans l'url corrspond à un événement de la BDD
if(isset($_GET['Event_id'])&&  event_existe($_GET['Event_id'])==TRUE){
	$Event_id=$_GET['Event_id'];
	// Si c'est le cas on attribue cet ID à la variable $Event_id
}
else{
// Si ce n'est pas le cas on redirige l'utilisateur vers la page d'acuueil en lui affichant un message d'erreur	
	?>
	
<div style="width:100%;margin:0;text-align:center;display:inline-block;float:left;clear:both;">
	<h2>Cette page n'existe pas, vous allez être redirigé vers la page d'accueil</h2>
</div>

	<?php
	header("Refresh: 2, url=Accueil.php");	
}
// Fonction vérifiant l'existance de l'événement renvoie TRUE s'il existe et FALSE sinon
function event_existe($Event_id){
	global $connect;
	$result=mysqli_query($connect,"select * from event where Event_id=".$Event_id);
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

// Fonction selectionnant tous les éléments d'un événement
function select_event($Event_id) {
    global $connect;
     $result=mysqli_query($connect,"select * from event natural join adresse natural join multimedia where Event_id=".$Event_id) or die("MySQL Erreur : " . mysqli_error());
     return $result;
}
// On créé un tableau associatif de l'événement
$result = select_event($_GET['Event_id']);
$event = mysqli_fetch_assoc($result);

// On récupère L'url de l'événement, l'adresse associée à l'événement, le nom, la desciption, le prix,etc...
$URLevent=("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$adresse="'".$event['numerorue'].' '.$event['rue'].' '.$event['ville']."'";
$nom_e = $event['Nom_e'];
$description = $event['description_e'];
$prix =$event['prix'];
$privacy=$event['privacy'];
$Id_crea=$event['id_utilisateur'];
// On regarde si l'utilisateur participe à l'événement (renvoie 1 si oui et 0 dans l'autre cas)
$particip=mysqli_query($connect,"select * from participation WHERE (Event_id=$Event_id AND id_participant=$id_utilisateur)")->num_rows;

// Fonction permettant de modifier le bouton d'inscription
function des_inscrire(){
	global $particip;
	if($particip!=0){
		echo"Se désinscrire de l'événement";
	}
	else{
		echo"S'inscrire à l'événement";
	}
	
}
// Fonction affichant els utilisateur participant à l'événement un maximu de 6 ets affiché
function carrousselprofiles(){
	global $connect;
	global $Event_id;
	$i=0;
	// On sélectionne tous les participants
	$result=mysqli_query($connect,"select id_participant from participation where Event_id=".$Event_id);
	if ($result->num_rows>0 ){
		// On parcourt la liste des participants puis on récupère les informations des participants
		while (($data = mysqli_fetch_assoc($result))&& $i!=6){
		$id_particip=$data['id_participant'];
		$util=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * from utilisateur where id_utilisateur=$id_particip"));
		?>			
			<a href="autreprofil.php?id_utilisateur=<?php echo $util['id_utilisateur']?>"><img src='<?php echo $util['photo_u']?>' class='profpic' style='height:75%; width:10%;margin-top:5px'/></a>
			
		<?php
		$i ++;
	}
	}
}
// Fonction permettant d'afficher toutes les catégories de l'événement
function categories ($Event_id){
	global $connect;
	$result=mysqli_query($connect,"SELECT * from typeevent where Event_id=$Event_id");
	while ($data = mysqli_fetch_assoc($result)) {
		$categ=mysqli_query($connect,"SELECT * from categorie where id_categ=".$data['id_categ']);
		$categ=mysqli_fetch_assoc($categ);
		echo $categ['nomCat'].' ';
		
	}
}
// Fonction permettant d'afficher la liste des contacts pour le partage de l'événement
function fonctioncontact($id_utilisateur){
	global $connect;
	global $Event_id;
	// On sélectionne tous les contacts puis leurs informations
	$result=mysqli_query($connect,"SELECT * from relation_amicale where id_utilisateur=$id_utilisateur");
		while ($data = mysqli_fetch_assoc($result)) {
			$ami=mysqli_query($connect,"SELECT * from utilisateur where id_utilisateur=".$data['id_ami']);
			$ami=mysqli_fetch_assoc($ami);
				?>					
					<div class="bandeaubas" style="height:20px; color:inherit">
						<div class="bleft" style="width:40%">
							<a href="autreprofil.php?id_utilisateur=<?php echo $ami['id_utilisateur'];?>"><img src="<?php echo $ami['photo_u'];?>" class="profpic" style="height:100%"/></a>
						</div>
						<!--Si l'on clique sur ce div on éxécute la fonction de partage d'événement --> 
							<div class="bright" style="width:60%; color:inherit; cursor:pointer;" onclick="partage(<?php echo $Event_id ?>,<?php echo $ami['id_utilisateur']?>)">
								<p style="left:5%; font-size:0.4em"><?php echo $ami['prenom_u'].' '.$ami['nom_u'];?></p>
							</div>	
						</div>

					<?php }
}
// Fonction permettant d'afficher tous les commentaires d'un événement
function coms ($Event_id){
	global $connect;
	global $id_utilisateur;
	global $Id_crea;
	$result=mysqli_query($connect,"SELECT * from commente where Event_id=$Event_id");
	// On sélectionne tous les commentaires puis les informations des commentateurs
while ($data = mysqli_fetch_assoc($result)) {
	$id_commentateur=$data['id_utilisateur'];
	$util=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * from utilisateur where id_utilisateur=$id_commentateur"));
	?> <div class="bandeaucom">
			<div class="bleft" style="display:block;width:30%;height:125px; ">
				<div class="bleft" style="width:50%;height:100%;">
					<a href="autreprofil.php?id_utilisateur=<?php echo $util['id_utilisateur']?>"><img src="<?php echo $util['photo_u']?>" class="profpic" style="float:right; height:90px; margin:0; margin-right:20px;"/></a>
				</div>
				<div class="bright" style="width:50%; height:100%; min-height:125px">
					<div class="bandeauhaut" style="height:20%;margin-top:10%">
						<p style="margin:0;top:50%; transform:translate(0,-50%)"><?php echo $util["prenom_u"].' '.$util["nom_u"] ?></p>
					</div>
					<div class="bandeaumilieu" style="height:20%;">
						<p style="margin:0;font-size:0.6em; text-align:left;"><?php echo $data['date_co']; ?> </p>
					</div>
					<div class="bandeaubas" style="height:30%;">
						<p style="Font-size:0.6em">Signaler ce <br>commentaire:</p> 
						<!-- Si on clique sur cette image on éxecute la fonction de signalement e commentaire -->
						<img src="../reste/images/exclam.png" class="report" title="Signaler ce commentaire" onclick="report('com',<?php echo $data['id_commentaire']?>)"/>
					</div>
				</div>
			</div>
			<div class="bleft" style="width:50%; height:auto; min-height:125px">
				<p style="position:relative;display:inline-block;height:auto;width:100%;margin: 0;margin-top:10px; text-align:left;word-wrap: break-word;"><?php echo $data['texte_co']; ?> </p>
			</div>
			<div class="bright" style="width:20%; height:125px;">
				<?php 
				// On vérifie que l'utilisateur soit un admin, le créateur de l'événement ou ai écrit le commentaire pour qu'en cliquant sur l'image il puisse supprimer son commentaire
				if ($id_commentateur==$id_utilisateur or verifadmin($id_utilisateur)==1 or $id_utilisateur==$Id_crea){?>
	
					<img onclick="supprcom(<?php echo $data['id_commentaire']?>)" src="../reste/images/delete.png" class="report" title="Supprimer ce commentaire" style="max-height:25px;cursor:pointer;" />
				<?php }?>
			</div>
		</div> 
	<?php
}
	 
} 
$Nb_comment=125*mysqli_query($connect,"select * from commente where Event_id='$Event_id' and texte_co IS NOT NULL")->num_rows;

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
	global $connect;
	global $id_utilisateur;
	if (isset ($id_utilisateur ) && mysqli_query($connect,"select Note from participation WHERE (Event_id=$Event_id AND id_participant=$id_utilisateur)")->num_rows>0){
		$note=mysqli_fetch_assoc(mysqli_query($connect,"Select Note from participation Where Event_id=$Event_id AND id_participant=$id_utilisateur"));
		$note=$note['Note'];
		if ($note==NULL){
			$note=mysqli_fetch_assoc(mysqli_query($connect,"Select AVG(Note) from participation Where Event_id=$Event_id "));
			$note=$note['AVG(Note)'];
		}
	}
	else{
		$note=mysqli_fetch_assoc(mysqli_query($connect,"Select AVG(Note) from participation Where Event_id=$Event_id "));
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
function carroussel_event($Event_id){
	global $connect;
	$result=mysqli_query($connect,"SELECT * from multimedia where Event_id=$Event_id");
	while($data=mysqli_fetch_assoc($result)){
		?><div class="photo_car">
			<img style="background-color:white;" src="<?php echo $data['urlimg_event']?>" class="photo_car2"/>
		</div>
		<?php
	}	
}
function carroussel_sponsors($Event_id){
	global $connect;
	$result=mysqli_query($connect,"SELECT * from sponsor natural join sponsorise where Event_id=$Event_id");
	while($data=mysqli_fetch_assoc($result)){
		?><div style="height:100%; width:20%; display:inline-block; position:relative">
			<img src="<?php echo $data['img_sponsor']?>" class="photo_car2"/>
		</div>
		<?php
	}	
}
?>
