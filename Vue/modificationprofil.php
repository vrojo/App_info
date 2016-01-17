<?php
session_start();

require 'model.php';

?>
<!DOCTYPE html>
<html>

    <head>
    
        <title>Modification du profil</title>
        <meta charset="utf8">
        
    
    </head>
    <link type="text/css" rel="stylesheet" href="../Style/modificationprofil.css"/>
    <script type="text/javascript" src="../Controler/modificationprofil.js"></script>
	
	<body>
        <?php include ("Header.php"); ?>
        <?php $donnees_utilisateur = remplissage_modifprofil($id_utilisateur);
              $donnees_adresse = remplissage_modifprofil_adresse($id_utilisateur);
        ?>
		<div id="form_modif_profil">
			<h3>Modifiez votre profil et rejoignez le mouvement !!</h3>
			<p>Enregistrement : *Veillez à bien remplir votre formulaire car il vous permettra d'utiliser de manière optimale SimplEvent.</p>
			<form onsubmit="return verifCompletModif()" enctype="multipart/form-data" id="formulaire_modif" action="../Controler/modificationprofilcontroleur.php" method="post"  id="form_modif_profil_form">
				<fieldset>
					<label>Informations de base :</label>
					</br>
					</br>
					<label for id="nom">Nom:</label>
					<input type="text" name="nom_u" id="nom" placeholder="Dutronc" class="input_form_modif_profil" value="<?php echo$donnees_utilisateur['nom_u'] ?>" oninput="verifNom(this)"><span id="erreur_nom"></span>
					</br>
					<label for id="prenom">Prénom:</label>
					<input type="text" name="prenom_u" id="prenom" placeholder="Jacques" class="input_form_modif_profil" value = "<?php echo $donnees_utilisateur['prenom_u'] ?>"oninput="verifPrenom(this)"><span id="erreur_prenom"></span>
					</br>
					<label for id="mail">Mail :</label>
					<input type="email" name="mail" id="mail" class="input_form_modif_profil" placeholder="...........................................@.............." value = "<?php echo $donnees_utilisateur['mail'] ?>" oninput='verifMail(this)'><span id="erreur_mail"></span>
				    </br>
				    </br>
					<label for id="mdpmodif">Nouveau mot de passe :</label>
					<input type="password" name="mot_de_passe" id="mdpmodif" placeholder="*******" class="input_form_modif_profil" value = "<?php echo $donnees_utilisateur['mot_de_passe'] ?>"oninput="verifMdp(this)"/><span id="erreur_mdp"></span>
					</br>
					<label for id="mdpconfmodif">Confirmation :</label>
					<input type="password" name="confirmation_mdp" id="mdpconfmodif" placeholder="*******" class="input_form_modif_profil" value = "<?php echo $donnees_utilisateur['mot_de_passe'] ?>"oninput="verifMdpconf(this)"/><span id="erreur_confirmation_mdp"></span>
					</br>
				</fieldset>
				<fieldset>
					<label for id="adresse_complete">Veuillez entrer une adresse complète :</label>
					</br>
					</br>
					<div id="adresse_complete" style="display:inline-block; vertical-align:top;">
						<input type="text" class="input_form_modif_profil" value = "<?php echo $donnees_adresse['numerorue'] ?>" name="numero_adresse" id="numero_adresse" placeholder="n° de rue" oninput="verifNumrue(this)"/><span id="erreur_numrue"></span>
						</br>
						<input type="text" class="input_form_modif_profil" name="rue_adresse" value = "<?php echo $donnees_adresse['rue'] ?>"id="rue_adresse" placeholder="rue du Puits" oninput="verifRue(this)"/><span id="erreur_rue"></span>
						</br>
						<input type="text" class="input_form_modif_profil" name="ville_adresse" value = "<?php echo $donnees_adresse['ville'] ?>" id="ville_adresse" placeholder="Paris" oninput="verifVille(this)"/><span id="erreur_ville"></span>
						</br>
						<input type="text" class="input_form_modif_profil" name="codepostal_adresse" value = "<?php echo $donnees_adresse['codepostal'] ?>" id="codepostal_adresse" placeholder="75" oninput="verifCodepostal(this)"/><span id="erreur_codepostal"></span>
						</br>
						<input type="text" class="input_form_modif_profil" name="pays_adresse" id="pays_adresse" value = "<?php echo $donnees_adresse['pays'] ?>"placeholder="France" oninput="verifPays(this)"/><span id="erreur_pays"></span>
						</br>
					</div>
				</fieldset>
				<fieldset>
					<label>Autres informations :</label>
					</br>
					</br>
					<label for id="telephone">Téléphone :</label>
					<input type="tel" name="telephone" class="input_form_modif_profil" id="telephone" placeholder="0612345678" value="0<?php echo $donnees_utilisateur['telephone']?>" oninput="verifTelephone(this)"/><span id="erreur_telephone"></span>
					</br>
					<label for id="date">Date de naissance :</label>
					<input type="date" class="input_form_modif_profil" name="date_de_naissance" value="<?php echo $donnees_utilisateur['date_de_naissance'] ?>" id="date" onblur="verifDate(this)"/>
                    <input type="hidden" class="input_form_modif_profil" id="verifdate" name="verifdate" value="<?php echo $date = date(DATE_ATOM);?>">
                    <span id="erreur_date"></span>
					</br>
					<label>Sexe :</label>
					<select name="choixsexe">
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                    </select>
					</br>
					<label>Centres d'intérêt :</label>
					</br>
					</br>
					<div style="display:inline-block; vertical-align:top;">
					<?php affichage_centre_interet() ?>
					</div>
					</br>
					</br>
					<label for id="description">Description</label>
					<textarea name="description" id="description" placeholder="entrez une petite description de vous..."><?php echo $donnees_utilisateur['description'] ?></textarea><span id="erreur_description"></span>
					</br>
					</br>
					<label>Photo de profil :</label>
					<input name="photo_utilisateur" type="file" />
					</br>
				</fieldset>
				<input id="bouton_modif" type="submit" name="enregistrer" value="Enregistrer"/>
				<input type="submit" name="desinscrire" value="Se désinscrire" id="bouton_desinscrire">
			</form>