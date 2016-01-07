<?php

$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect_e,"utf8");

if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
}


$result="SELECT * FROM utilisateur where id_utilisateur=".$_GET["i"];
$user= mysqli_fetch_assoc(mysqli_query($connect_e, $result));

$come= "SELECT texte_co FROM commente WHERE id_utilisateur=".$_GET["i"]."ORDER BY date_co DESC LIMIT 0, 5";


function recup_com(){
    global $connect_e;
    global $com;
    $req_com= mysqli_query($connect_e, $com);
    while ($data=mysqli_fetch_assoc($req_com['texte_co'])) { ?>
        

        <div class="bandeaucom">
			<div class="bleft" style="width:30%;height:100%">
				<div class="bleft" style="width:50%;height:100%">
					<img src="<?php echo $util["photo_u"]?>" class="profpic" style="float:right; height:90px; width:90px; margin:0; margin-right:20px"/>
				</div>
				<div class="bright" style="width:50%; height:100%">
					<div class="bandeauhaut" style="height:20%;margin-top:10%">
						<p style="top:50%; transform:translate(0,-50%)"><?php echo $util["prenom_u"].' '.$util["nom_u"] ?></p>
					</div>
					<div class="bandeaumilieu" style="height:20%;">
						<p style="font-size:0.6em; text-align:left;"><?php echo $data["date_co"]; ?> </p>
					</div>
					<div class="bandeaubas" style="height:40%;">
						<img src="https://www.dropbox.com/s/43g64iiwsnat9pw/Point-d-exclamation.png?raw=1" class="report" title="Signaler ce commentaire"/>
					</div>
				</div>
			</div>
			<div class="bleft" style="width:50%; height:100%">
				<p style="position:absolute;margin: 0; text-align:left; top:50%; transform:translate(0,-50%)"><?php echo $data["texte_co"]; ?> </p>
			</div>
			<div class="bright" style="width:20%; height:100%">
				<?php 
				if (verifadmin($id_utilisateur)==1 or $id_utilisateur==$Id_crea){?>
	
					<a href=" ../modele/suprcom.php?i_com=<?php echo $data["id_commentaire"]?>"><img src="https://www.dropbox.com/s/ug1ko8f86ijv7t4/delete-462216_1280.png?raw=1" class="report" title="Supprimer ce commentaire" style="max-height:25px"/></a>
				<?php }?>
			</div>
		</div> 
    <?php }
}