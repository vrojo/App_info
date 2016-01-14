<?php
session_start();

require '../Modele/model.php';

?>
<!DOCTYPE html>
<html>

    <head>
    
        <title>Modification du profil</title>
        <meta charset="utf8"
        
    
    </head>
    <link type="text/css" rel="stylesheet" href="../Style/modificationprofil.css"/>
        <script type="text/javascript" src="../Controler/modificationprofil.js"></script>
    <body>
        <?php include ("../Vue/Header.php"); ?>
        <?php $donnees_utilisateur = remplissage_modifprofil($_SESSION['id_utilisateur']);
              $donnees_adresse = remplissage_modifprofil_adresse($_SESSION['id_utilisateur']);
        ?>
        <form enctype="multipart/form-data" id="formulaire_modif" action="../Controler/modificationprofilcontroleur.php" method="post" onsubmit="return verifCompletModif(this)">
            <br>
            <br>
            <span id="titre_modif_princ">Modifiez votre profil et rejoignez le mouvement !!</span><br>
            <span id="titre_modif_sec"><em>Enregistrement : *Veillez à bien remplir votre formulaire car il vous permettra d'utiliser de manière optimale SimplEvent.</em></span>
            <br>
            <br>
            <div id="bloc_modif1">
                <div class="input_modifprof">
                    <strong>Nom :</strong>
                    <div class="input_input_modif">
                        <input type="text" name="nom_u" id="nom" placeholder="Dutronc" value="<?php echo$donnees_utilisateur['nom_u'] ?>" oninput="verifNom(this)"><span id="erreur_nom"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Prénom :</strong>
                    <div class="input_input_modif">
                        <input type="text" name="prenom_u" id="prenom" placeholder="Jacques" value = "<?php echo $donnees_utilisateur['prenom_u'] ?>"oninput="verifPrenom(this)"><span id="erreur_prenom"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Adresse e-mail :</strong>
                    <div class="input_input_modif">
                        <input type="email" name="mail" id="mail" placeholder="...........................................@.............." value = "<?php echo $donnees_utilisateur['mail'] ?>" oninput='verifMail(this)'><span id="erreur_mail"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Mot de passe :</strong>
                    <div class="input_input_modif">
                        <input type="password" name="mot_de_passe" id="mdpmodif" placeholder="*******" value = "<?php echo $donnees_utilisateur['mot_de_passe'] ?>"oninput="verifMdp(this)"/><span id="erreur_mdp"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Confirmation du mot de passe :</strong>
                    <div class="input_input_modif">
                        <input type="password" name="confirmation_mdp" id="mdpconfmodif" placeholder="*******" value = "<?php echo $donnees_utilisateur['mot_de_passe'] ?>"oninput="verifMdpconf(this)"/><span id="erreur_confirmation_mdp"></span>
                    </div>
                </div>
                <br>
            </div>
            <div id="bloc_modif2">
                <div class="input_modifprof">
                    <strong>Veuillez entrer une adresse complète :</strong>
                </div>
                <br>
                <div class="adresse">
                    Numéro de rue :
                    <div class="input_input_modif">
                        <input type="text" value = "<?php echo $donnees_adresse['numerorue'] ?>" name="numero_adresse" id="numero_adresse" placeholder="n° de rue" oninput="verifNumrue(this)"/><span id="erreur_numrue"></span>
                    </div>
                </div>
                <div class="adresse">
                    Rue :
                    <div class="input_input_modif">
                        <input type="text" name="rue_adresse" value = "<?php echo $donnees_adresse['rue'] ?>"id="rue_adresse" placeholder="rue du Puits" oninput="verifRue(this)"/><span id="erreur_rue"></span>
                    </div>
                </div>
                <div class="adresse">    
                    Ville :
                    <div class="input_input_modif">
                        <input type="text" name="ville_adresse" value = "<?php echo $donnees_adresse['ville'] ?>" id="ville_adresse" placeholder="Paris" oninput="verifVille(this)"/><span id="erreur_ville"></span>
                    </div>
                </div>
                <div class="adresse">    
                    Code postal :
                    <div class="input_input_modif">
                        <input type="text" name="codepostal_adresse" value = "<?php echo $donnees_adresse['codepostal'] ?>" id="codepostal_adresse" placeholder="75" oninput="verifCodepostal(this)"/><span id="erreur_codepostal"></span>
                    </div>
                </div>
                <div class="adresse">    
                    Pays :
                    <div class="input_input_modif">
                        <input type="text" name="pays_adresse" id="pays_adresse" value = "<?php echo $donnees_adresse['pays'] ?>"placeholder="France" oninput="verifPays(this)"/><span id="erreur_pays"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Téléphone :</strong>
                    <div class="input_input_modif">
                        <input type="tel" name="telephone" id="telephone" placeholder="0612345678" value="0<?php echo $donnees_utilisateur['telephone']?>" oninput="verifTelephone(this)"/><span id="erreur_telephone"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Date de naissance :</strong>
                    <div class="input_input_modif">
                        <input type="date" name="date_de_naissance" value="<?php echo $donnees_utilisateur['date_de_naissance'] ?>" id="date"/>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Choix du sexe :</strong>
                    <br>
                    <select name="choixsexe">
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                    </select>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="input_modifprof">
                    <input id="bouton_modif" type="submit" name="enregistrer" value="Enregistrer"/>
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div id="bloc_modif3">
                <div class="input_modifprof">
                    <strong>Centres d'intérêt :</strong>
                    <div class="input_input_modif">
                        <div id="liste_categ"> 
                            <?php affichage_centre_interet() ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Description :</strong><br><em>**Ecrivez une petite description qui vous défini et pourra être vue parles autres utilisateurs sur votre profil.</em><br>
                    <div class="input_input_modif">
                        <textarea value = "<?php echo $donnees_utilisateur['description'] ?>" name="description" id="description" placeholder="entrez une petite description de vous..."></textarea><span id="erreur_description"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Sélectionnez une photo qui vous servira de photo de profil :</strong><br>
                    <div class="input_input_modif">
                       <input name="photo_utilisateur" type="file" />
                    </div>
                </div>
            </div>
        </form>
        <form id="formulaire_modif2" action="../Vue/Suppression.php">
            <input type="submit" name="desinscrire" value="Se désinscrire" id="bouton_desinscrire">
            <br>
            <br>
        </form>
    </body>
    <?php include("../Vue/footer.php")?>
</html>



