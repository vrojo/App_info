<?php	
$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");

$Topic=mysqli_query($connect,"SELECT * from sujet where id_topic=".$_GET['Topic']);
$Topic=mysqli_fetch_assoc($Topic);
$sujet=$Topic['sujet'];
$texte_s=$Topic['text_s'];
$date_s=$Topic['date_s'];
$id_crea=$Topic['id_utilisateur'];
$crea=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * from utilisateur where id_utilisateur=$id_crea"));

function coms ($Topic_id){
	global $connect;
	global $id_utilisateur;
	$result=mysqli_query($connect,"SELECT * from rep_topic where id_topic=$Topic_id");
while ($data = mysqli_fetch_assoc($result)) {
	$id_commentateur=$data['id_utilisateur'];
	$util=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * from utilisateur where id_utilisateur=$id_commentateur"));
	?> <div class="bandeaucom">
			<div class="bleft" style="display:block;width:30%;height:125px;">
				<div class="bleft" style="width:50%;height:100%;">
					<a href="autreprofil.php?id_utilisateur=<?php echo $util['id_utilisateur']?>"><img src="<?php echo $util['photo_u']?>" class="profpic" style="float:right; height:90px; margin:0; margin-right:20px;"/></a>
				</div>
				<div class="bright" style="width:50%; height:100%; min-height:125px">
					<div class="bandeauhaut" style="height:20%;margin-top:10%">
						<p style="margin:0;top:50%; transform:translate(0,-50%)"><?php echo $util["prenom_u"].' '.$util["nom_u"] ?></p>
					</div>
					<div class="bandeaumilieu" style="height:20%;">
						<p style="margin:0;font-size:0.6em; text-align:left;"><?php echo $data['date']; ?> </p>
					</div>
					<div class="bandeaubas" style="height:30%;">
						<p style="Font-size:0.6em">Signaler ce <br>commentaire:</p> 
						<img src="../reste/images/exclam.png" class="report" title="Signaler ce commentaire" onclick="report('texte',<?php echo $data['id_msgforum']?>)"/>
					</div>
				</div>
			</div>
			<div class="bleft" style="width:50%; height:auto; min-height:125px">
				<p style="position:relative;display:inline-block;height:auto;width:100%;margin: 0;margin-top:10px; text-align:left;word-wrap: break-word;"><?php echo $data['commentaire_r']; ?> </p>
			</div>
			<div class="bright" style="width:20%; height:125px;">
				<?php 
				if ($id_commentateur==$id_utilisateur or verifadmin($id_utilisateur)==1){?>
	
					<img  src="../reste/images/delete.png" class="report" title="Supprimer ce commentaire" style="max-height:25px;cursor:pointer;" onclick="supprfor(<?php echo $data['id_msgforum']?>)"/>
				<?php }?>
			</div>
		</div> 
	<?php
				}
				}
	?>