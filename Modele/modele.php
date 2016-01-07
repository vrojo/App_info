<?php
session_start();
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
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

if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
	}
$Nb_event=mysqli_query($connect_e,"select * from event")->num_rows;
$Nb_utilisateurs=mysqli_query($connect_e,"select * from utilisateur")->num_rows;



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
	header("Refresh: 3, url=../Vue/Accueil.php");
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
			<div class="bleft" style="width:15%;height:100%">
				<div class="bandeauhaut" style="height:80%;">
				<img src="<?php echo $util['photo_u']?>" style="float:right;width:35%; height:100%; margin:0; margin-right:20px"/>
				</div>
				<div class="bandeaubas" style="height:20%">
				</div>
			</div>
			<div class="bright" style="width:85%">
			<p><?php echo $data['texte_co']; ?> </p>
			</div>
		</div> 
	<?php
}
	 
} 

function insert_utilisateur($nom_u ,$prenom_u, $adresse, $mail, $telephone, $mot_de_passe, $date_de_naissance, $description, $photo_u) {
    global $connect_e;
    $req2=" INSERT INTO utilisateur (nom_u, prenom_u, adresse, mail, telephone, mot_de_passe, date_de_naissance, description, photo_u) values ('$nom_u', '$prenom_u', '$adresse', '$mail', '$telephone', '$mot_de_passe', '$date_de_naissance', '$description', '$photo_u')";
    //echo $req2;
    mysqli_query($connect_e, $req2) or die("MySQL Erreur : " . mysqli_error($connect_e));
}

function insert_event($Nom_e ,$lieu, $prix, $date_e, $heuredebut, $heurefin, $nb_max_participant, $description_e, $privacy, $session) {
    global $connect_e;
    $req1 ="  INSERT INTO event (Nom_e, lieu, prix, date_e, heuredebut, heurefin, nb_max_participant, description_e, privacy, id_utilisateur) values ('$Nom_e', '$lieu', '$prix', '$date_e', '$heuredebut', '$heurefin', '$nb_max_participant', '$description_e', '$privacy','$session')"; 
    //echo $req1;                                                                                                                                                                                 
    mysqli_query($connect_e, $req1) or die("MySQL Erreur : " . mysqli_error($connect_e));

//    mysqli_query($connect_e, "  INSERT INTO multimedia (urlimg_event, urlvid_event, urlsite_event, Event_id) values ('$urlimg_event', '$urlvid_event', '$urlsite_event', '$Event_id')") or die("MySQL Erreur : " . mysqli_error($connect_e));
}

function affichage_categ_recherche_avancee(){
    global $connect_e;
    $result = mysqli_query($connect_e, "select * from categorie order by nomCat") or die("MsQL Erreur : ".mysqli_errno($connect_e));
    return $result;
}

function insert_categ($nomCat) {
    global $connect_e;
    mysqli_query($connect_e, "insert into categorie (nomCat) values ('$nomCat')") or die("MySQL Erreur : " . mysqli_error($connect_e));
}

function delete_categ($id_categ) {
    global $connect_e;
    mysqli_query($connect_e, "delete from categorie where id_categ ='$id_categ'") or die("MySQL Erreur : " . mysqli_error($connect_e));
}

function update_categ($nouveauNom, $idcateg){
    global $connect_e;
    mysqli_query($connect_e, "update categorie set nomCat='$nouveauNom' where id_categ=".$idcateg) or die("MySQL Erreur : " . mysqli_error($connect_e));
}

function verification_mdp($adrentre){
    global $connect_e;
    $result = mysqli_query($connect_e, "select mot_de_passe,id_utilisateur,admin from utilisateur where mail='$adrentre'") or die("MsQL Erreur : ".mysqli_errno($connect_e));
    $resultat = mysqli_fetch_assoc($result);
    return $resultat;   
}




function modification_categorie(){
    $result = affichage_categ_recherche_avancee();
                $compteur = 1;
                
                
                if($compteur==1){
                    echo'<div class="nomcateg">';
                    while($categorie = mysqli_fetch_assoc($result)) {
                        echo '<div class="nom_de_categ">'.$categorie['nomCat'].'</div>';
                        }
                    echo'</div>';
                    
                    
                    $result = affichage_categ_recherche_avancee();
                    echo'<div class="zone_input_categ">';
                    
                    while($categorie = mysqli_fetch_assoc($result)) {                
                        
                        echo'<form action="gestion_categorie.php" method="post">';
                        echo'<input type="text" class="zone_modification_categ" placeholder="modification" name='.$categorie['nomCat'].'> ';
                        echo'<input type="submit" value="supprimer/modifier" class="bouton_suppression_categ" name='.$categorie['id_categ'].'>';
                        echo'</form>';
                    }
                    $compteur = 0;
                }
    }






function affichage_utilisateurs(){
    global $connect_e;
    $result = mysqli_query($connect_e, "select mail from utilisateur order by mail") or die("MsQL Erreur : ".mysqli_errno($connect_e));
    return $result;
}


function affichage_topics(){
    global $connect_e;
    $result = mysqli_query($connect_e, "select * from sujet") or die("MsQL Erreur : ".mysqli_errno($connect_e));
    $ersult_message= mysqli_query($connect_e, "select * from ");            
                $compteur = 1;
                
                
                if($compteur==1){
                    while($topic = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td class="colonne_topics">'.$topic['sujet'].'</td>';
                        echo '<td class="colonne_messages">'.$nb_messages.'</td>';
                        echo '<td class="colonne_dernier_message">'.$date_dernier_message.'</td>';
                        echo '</tr>';
                        }
                    echo'</div>';
                    
                    
                   
                    $compteur = 0;
                }        
}        

?>