<?php
session_start();
require 'model.php';
?>
<!DOCTYPE html>

<html>
 
    <head>
        <meta charset="UTF-8">
           <link type="text/css" rel="stylesheet" href="../Style/creationevent.css"/>
           <script type="text/javascript" src="creationevent.js"></script>
        <title>Création d'événement</title>
    </head>
	
	<body>
		<?php include ("Header.php"); ?>
		
		<!-- chaque champs a une vérification en continue pour être sur que ce qui y est entré est attendu -->
		
		<div id="form_crea_event">
			<h1>Créer un événement:</h1>
			<p>Créez rapidement un événement privé ou visible par tous en remplissant les champs suivants :</p>
			<p style="color:red">Les champs marqués d'une * sont obligatoires</p>
			<form action="../Controler/eventcree.php" method="POST" enctype="multipart/form-data" id="form_crea_event_form">
				<fieldset>
					<label for="nameevent">Nom de l'événement <span style="color:red">*</span> :</label>
					<input type="text" name="Nom_e" id="nameevent" placeholder="ex : Technoparade" class="input_form_crea_event" oninput="verifNom(this)"/><span id="erreur_nom"></span>
					</br>
					</br>
					<label for="adresseevent1">Adresse <span style="color:red">*</span> :</label>
					<div style="display:inline-block; vertical-align:top;">
						<input type="number" name="numerorue" id="adresseevent1" placeholder="n° (non obligatoire)" class="input_form_crea_event" value='' oninput="verifNumrue(this)"/>
						</br>
						<input type="text" name="rue" id="adresseevent3" placeholder="rue" class="input_form_crea_event" oninput="verifRue(this)"/>
						</br>
						<input type="text" name="ville" id="adresseevent1" placeholder="ville" class="input_form_crea_event" oninput="verifVille(this)"/>
						</br>
						<input type="number" name="codepostal" id="adresseevent2" placeholder="code postal" class="input_form_crea_event" oninput="verifCodepostal"/>
						</br>
						<input type="text" name="pays" id="adresseevent1" placeholder="pays" class="input_form_crea_event" oninput="verifPays(this)"/>
						</br>
						<span id="erreur_numrue"></span><span id="erreur_rue"></span><span id="erreur_ville"></span><span id="erreur_codepostal"></span><span id="erreur_pays"></span>
					</div>
					</br>
					</br>
					<label for="prix">Prix :</label>
					<input type="number" name="prix" id="prix" placeholder="10€"  value='' class="input_form_crea_event" oninput="verifPrix(this)"/> <span id="erreur_prix"></span>
				</fieldset>
				<fieldset>
					<label for="date_e">Date de l'événement :</label>
					<label>Début <span style="color:red">*</span> :</label><input type="date" name="date_e" class="input_form_crea_event" id="date_event"/>
					<label>Fin :</label><input type="date" name="date_f" value='' class="input_form_crea_event" id="date_event"/>
					</br>
					</br>
					<label for="pass2">Horaires :</label>
					<label>début <span style="color:red">*</span> :</label><input type="time" name="heuredebut" class="input_form_crea_event" id="heureevent"/>
					<label>fin <span style="color:red">*</span> :</label><input type="time" name="heurefin" class="input_form_crea_event" id="heureevent"/>
				</fieldset>
				<fieldset>
					<label for="nombre">Nombre maximum de participants :</label>
					<input type="number" name="nb_max_participant" id="nombre" value="" class="input_form_crea_event" placeholder="25"/>
					</br>
					</br>
					<label for="checkbox">Catégorie de l'event :</label>
					</br>
					<label for="checkbox" style="font-size:0.5em;">Attention, les catégories ne seront pas modifiables plus tard.</label>
					<?php 
					
					//récupère les catégories, qui ne sont pas fixées
					
					$result = affichage_categ_recherche_avancee();
                                 $compteur = 0;
								 
								 //affiche autant de checkbox que nécessaire
                                 while($categorie = mysqli_fetch_assoc($result)) {
                                     if($compteur != 4){
                                        echo'<div class="checkrecherche"><input type="checkbox" class="input_form_crea_event" value='.$categorie['id_categ'].' name='.$categorie['nomCat'].'><label>'.$categorie['nomCat'].'</label></div>&nbsp; &nbsp; &nbsp;';                               
                                        $compteur = $compteur +1;
                                 }
                                     else{
                                         echo'<br> <br>';
                                         $compteur = 0;
                                        }
                                 }
								
								mysqli_free_result($result); 
					?>
					</br>
					</br>
					<label for="login">Description <span style="color:red">*</span> :</label>
					<textarea name="description_e" id="description" class="input_form_crea_event" placeholder="entrez une petite description de l'événement pour inciter les autres utilisateurs à s'inscrire !"></textarea>
					</br>
					</br>
					<label>Image du/des sponsor(s):</label>
					</br>
					<label style="font-size:0.5em;">Attention, les sponsors ne seront pas modifiables plus tard.</label>
					<div style="display:inline-block; vertical-align:top;">
						<input type="text" name="sponsor1" class="input_form_crea_event" placeholder="url de l'image">
						</br>
						<input type="text" name="sponsor2" class="input_form_crea_event" placeholder="url de l'image">
						</br>
						<input type="text" name="sponsor3" class="input_form_crea_event" placeholder="url de l'image">
						</br>
						<input type="text" name="sponsor4" class="input_form_crea_event" placeholder="url de l'image">
						</br>
					</div>
					</br>
					</br>
					<input type="radio" name="privacy" value="1"><label>événement privé</label>
					<input type="radio" name="privacy" value="0" checked><label>événement public</label>
				</fieldset>
				<fieldset>
					<label for id="adresseevent">Si l'événement a son propre site Internet :</label>
					<input type="text" name="urlsite_event" id="adresseevent" class="input_form_crea_event" placeholder="url du site Internet"/>
					</br>
					</br>
					<label for id="photo_principale">Photo principale de l'événement <span style="color:red">*</span> :</label>
					</br>
					<label for id="photo_principale">taille maximale de l'image : 20 mo</label>
					</br>
					<label for id="photo_principale" style="font-size:0.5em;">Attention, les photos ne seront pas modifiables plus tard.</label>
					</br>
					</br>
					<input type="file" name="photo_principale" id="photo_principale" style="color:white;"/>
					</br>
					</br>
					<label for id="photo_secondaire">Autres photos de l'événement :</label>
					</br>
					</br>
					<div style="display:inline-block; vertical-align:top;">
						<input type="file" name="photo_secondaire" id="photo_secondaire" style="color:white;"/>
						</br>
						<input type="file" name="photo_trois" id="photo_trois" style="color:white;"/>
						</br>
						<input type="file" name="photo_quatre" id="photo_quatre" style="color:white;"/>
						</br>
					</div>
					</br>
				</fieldset>
				<input type="submit" value="Créer l'événement" id="bouton_creer_event"/>
				</br>
				</br>
			</form>
		</div>
		<?php include('footer.php') ?>
	</body>
</html>