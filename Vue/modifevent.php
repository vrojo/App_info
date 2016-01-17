<?php
session_start();
require 'model.php';
?>
<!DOCTYPE html>

<html>
 
    <head>
        <meta charset="UTF-8">
           <link type="text/css" rel="stylesheet" href="modifevent.css"/>
           <script type="text/javascript" src="creationevent.js"></script>
        <title>Modification d'événement</title>
    </head>
	
	<body>
		<?php
		$connect = mysqli_connect('localhost', 'root', '', 'bddsimplevent');
		mysqli_set_charset($connect,"utf8");
		include ("Header.php"); 
		
		if (isset($_GET['id_event'])) {
			$event=mysqli_fetch_assoc(mysqli_query($connect, "select * from event join multimedia join adresse where principale=1 and event.Event_id=".$_GET['id_event'].""));
			
			if ($event['id_utilisateur']==$_SESSION['id_utilisateur']) {
		?>
		
		<!-- chaque champs a une vérification en continue pour être sur que ce qui y est entré est attendu -->
		
		<div id="form_crea_event">
			<h1>Modifier un événement:</h1>
			<form action="eventmodifie.php?id_event=<?php echo($_GET['id_event']) ?>" method="POST" enctype="multipart/form-data" id="form_crea_event_form">
				<fieldset>
					<label for="nameevent">Nom de l'événement :</label>
					<input type="text" name="Nom_e" id="nameevent" placeholder="ex : Technoparade" value="<?php echo($event['Nom_e']) ?>" class="input_form_crea_event" oninput="verifNom(this)"/><span id="erreur_nom"></span>
					</br>
					</br>
					<label for="adresseevent1">Adresse :</label>
					<div style="display:inline-block; vertical-align:top;">
						<input type="number" name="numerorue" id="adresseevent1" value="<?php echo($event['numerorue']) ?>" placeholder="n° (non obligatoire)" class="input_form_crea_event" oninput="verifNumrue(this)"/>
						</br>
						<input type="text" name="rue" id="adresseevent3" value="<?php echo($event['rue']) ?>" placeholder="rue" class="input_form_crea_event" oninput="verifRue(this)"/>
						</br>
						<input type="text" name="ville" id="adresseevent1" value="<?php echo($event['ville']) ?>" placeholder="ville" class="input_form_crea_event" oninput="verifVille(this)"/>
						</br>
						<input type="number" name="codepostal" id="adresseevent2" value="<?php echo($event['codepostal']) ?>" placeholder="code postal" class="input_form_crea_event" oninput="verifCodepostal"/>
						</br>
						<input type="text" name="pays" id="adresseevent1" value="<?php echo($event['pays']) ?>" placeholder="pays" class="input_form_crea_event" oninput="verifPays(this)"/>
						</br>
						<span id="erreur_numrue"></span><span id="erreur_rue"></span><span id="erreur_ville"></span><span id="erreur_codepostal"></span><span id="erreur_pays"></span>
					</div>
					</br>
					</br>
					<label for="prix">Prix :</label>
					<input type="number" name="prix" id="prix" placeholder="10€"  value="<?php echo($event['prix']) ?>" class="input_form_crea_event" oninput="verifPrix(this)"/> <span id="erreur_prix"></span>
				</fieldset>
				<fieldset>
					<label for="date_e">Date de l'événement :</label>
					<label>Début :</label><input type="date" value="<?php echo($event['date_e']) ?>" name="date_e" class="input_form_crea_event" id="date_event"/>
					<label>Fin :</label><input type="date" name="date_f" value="<?php echo($event['date_f']) ?>" class="input_form_crea_event" id="date_event"/>
					</br>
					</br>
					<label for="pass2">Horaires :</label>
					<label>début :</label><input type="time" value="<?php echo($event['heuredebut']) ?>" name="heuredebut" class="input_form_crea_event" id="heureevent"/>
					<label>fin :</label><input type="time" value="<?php echo($event['heurefin']) ?>" name="heurefin" class="input_form_crea_event" id="heureevent"/>
				</fieldset>
				<fieldset>
					<label for="nombre">Nombre maximum de participants :</label>
					<input type="number" name="nb_max_participant" value="<?php echo($event['nb_max_participant']) ?>" id="nombre" value="" class="input_form_crea_event" placeholder="25"/>
					</br>
					</br>
					<label for="login">Description :</label>
					<textarea name="description_e" value="<?php echo($event['description_e']) ?>" id="description" class="input_form_crea_event" placeholder="entrez une petite description de l'événement pour inciter les autres utilisateurs à s'inscrire !"><?php echo($event['description_e']) ?></textarea>
					</br>
					</br>
					<label>Image du/des sponsor(s):</label>
					<div style="display:inline-block; vertical-align:top;">
					<?php
					$sponsors=mysqli_fetch_assoc(mysqli_query($connect, "select * from sponsor join sponsorise where Event_id=".$_GET['id_event'].""));
					$compteur=1;
					while($data=$sponsors) {
						$image=$data['img_sponsor'];
						echo("<input type='text' name='sponsor$compteur' class='input_form_crea_event' placeholder='url de l&acute;image' value='$image'>
						</br>");
						$compteur++;
					}
					while ($compteur!=5) {
						echo("<input type='text' name='sponsor$compteur' class='input_form_crea_event' placeholder='url de l&acute;image'>
						</br>");
						$compteur++;
					}
					?>
					</div>
					</br>
					</br>
					<?php
					if ($event['privacy']==1) {
						?>
						<input type="radio" name="privacy" value="1" checked ><label>événement privé</label>
						<input type="radio" name="privacy" value="0"><label>événement public</label>
						<?php
					}
					elseif ($event['privacy']==0) {
						?>
						<input type="radio" name="privacy" value="1"><label>événement privé</label>
						<input type="radio" name="privacy" value="0" checked><label>événement public</label>
						<?php
					}
					?>
				</fieldset>
				<fieldset>
					<label for id="adresseevent">Si l'événement a son propre site Internet :</label>
					<?php
					$site_existant=mysqli_query($connect, "select exists (select urlsite_event from multimedia where event.Event_id=".$_GET['id_event']." and urlsite_event!=NULL");
					if ($site_existant==1) {
						$site=mysqli_fetch_assoc(mysqli_query($connect, "select urlsite_event from multimedia where Event_id=".$_GET['id_event'].""));
						$site=$site['urlsite_event'];
						echo("<input type='text' name='urlsite_event' value='$site' id='adresseevent' class='input_form_crea_event' placeholder='url du site Internet'/>");
					}
					elseif ($site_existant==0) {
						echo("<input type='text' name='urlsite_event' id='adresseevent' class='input_form_crea_event' placeholder='url du site Internet'/>");
					}
					?>
					</br>
					</br>
					<label for id="photo_principale">Photo principale de l'événement :</label>
					<label for id="photo_principale">taille maximale de l'image : 20 mo</label>
					</br>
					</br>
					<input type="file" value="<?php echo($event['urlimg_event']) ?>" name="photo_principale" id="photo_principale" style="color:white;"/>
					</br>
					</br>
					<label for id="photo_secondaire">Autres photos de l'événement :</label>
					</br>
					</br>
					<div style="display:inline-block; vertical-align:top;">
					<?php
					$photos=mysqli_fetch_assoc(mysqli_query($connect, "select * from multimedia where multimedia.Event_id=".$_GET['id_event']." and principale=0"));
					$compteur=1;
					while ($data=$photos and $compteur!=4) {
						if ($compteur==1) {
							echo("<input type='file' name='photo_secondaire'  value=".$data['urlimg_event']." id='photo_secondaire' style='color:white;'/>
							</br>");
						}
						if ($compteur==2) {
							echo("<input type='file' name='photo_trois' value=".$data['urlimg_event']." id='photo_secondaire' style='color:white;'/>
							</br>");
						}
						if ($compteur==3) {
							echo("<input type='file' name='photo_quatre' value=".$data['urlimg_event']." id='photo_secondaire' style='color:white;'/>
							</br>");
						}
						$compteur++;
					}
					while ($compteur!=3) {
						if ($compteur==1) {
							echo("<input type='file' name='photo_secondaire' id='photo_secondaire' style='color:white;'/>
							</br>");
						}
						if ($compteur==2) {
							echo("<input type='file' name='photo_trois' id='photo_secondaire' style='color:white;'/>
							</br>");
						}
						if ($compteur==3) {
							echo("<input type='file' name='photo_quatre' id='photo_secondaire' style='color:white;'/>
							</br>");
						}
						$compteur++;
					}
					?>
					</div>
					</br>
				</fieldset>
				<input type="submit" value="Modifier l'événement" id="bouton_creer_event"/>
				</br>
				</br>
			</form>
		</div>
		<?php 			
			}
			else {
				?>
				<h3 style="background-color:#59b7ff; color:white; text-align:center">Vous ne pouvez pas modifier cet événement, vous n'en êtes pas le créateur</h3>				
				<meta http-equiv="refresh" content="5; URL=Accueil.php" />
				<?php
			}
			
		}
		?>
		<?php include('footer.php') ?>
	</body>
</html>