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
    <script type="text/javascript" src="../Modele/modificationprofil.js"></script>
    <body>
        <?php include ("../Vue/Header.php"); ?>
        
        <form id="formulaire_modif" action="../Controler/modificationprofilcontroleur.php" method="post" onsubmit="return verifCompletModif(this)">
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
                        <input type="text" name="nom_u" id="nom" placeholder="Dutronc" oninput="verifNom(this)"><span id="erreur_nom"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Prénom :</strong>
                    <div class="input_input_modif">
                        <input type="text" name="prenom_u" id="prenom" placeholder="Jacques" oninput="verifPrenom(this)"><span id="erreur_prenom"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Adresse e-mail :</strong>
                    <div class="input_input_modif">
                        <input type="email" name="mail" id="mail" placeholder="...........................................@.............." oninput='verifMail(this)'><span id="erreur_mail"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Mot de passe :</strong>
                    <div class="input_input_modif">
                        <input type="password" name="mot_de_passe" id="mdpmodif" placeholder="*******" oninput="verifMdp(this)"/><span id="erreur_mdp"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Confirmation du mot de passe :</strong>
                    <div class="input_input_modif">
                        <input type="password" name="confirmation_mdp" id="mdpconfmodif" placeholder="*******" oninput="verifMdpconf(this)"/><span id="erreur_confirmation_mdp"></span>
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
                        <input type="text" name="numero_adresse" id="numero_adresse" placeholder="n° de rue" oninput="verifNumrue(this)"/><span id="erreur_numrue"></span>
                    </div>
                </div>
                <div class="adresse">
                    Rue :
                    <div class="input_input_modif">
                        <input type="text" name="rue_adresse" id="rue_adresse" placeholder="rue du Puits" oninput="verifRue(this)"/><span id="erreur_rue"></span>
                    </div>
                </div>
                <div class="adresse">    
                    Ville :
                    <div class="input_input_modif">
                        <input type="text" name="ville_adresse" id="ville_adresse" placeholder="Paris" oninput="verifVille(this)"/><span id="erreur_ville"></span>
                    </div>
                </div>
                <div class="adresse">    
                    Code postal :
                    <div class="input_input_modif">
                        <input type="text" name="codepostal_adresse" id="codepostal_adresse" placeholder="75" oninput="verifCodepostal(this)"/><span id="erreur_codepostal"></span>
                    </div>
                </div>
                <div class="adresse">    
                    Pays :
                    <div class="input_input_modif">
                        <input type="text" name="pays_adresse" id="pays_adresse" placeholder="France" oninput="verifPays(this)"/><span id="erreur_pays"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Téléphone :</strong>
                    <div class="input_input_modif">
                        <input type="tel" name="telephone" id="telephone" placeholder="06 12 34 56 78" oninput="verifTelephone(this)"/><span id="erreur_telephone"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Date de naissance :</strong>
                    <div class="input_input_modif">
                        <input type="date" name="date_de_naissance" id="date"/>
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
                        <textarea name="description" id="description" placeholder="entrez une petite description de vous..." onblur="verifDescr(this)"></textarea><span id="erreur_description"></span>
                    </div>
                </div>
                <br>
                <div class="input_modifprof">
                    <strong>Lien vers une photo qui vous servira de photo de profil :</strong><br>
                    <div class="input_input_modif">
                        <input type="text" id="ajouterphoto" name="photo_u" onblur="verifUrlphoto(this)"/><span id="erreur_urlphoto"></span>
                    </div>
                </div>
            </div>
        </form>
    </body>
    <?php include("../Vue/footer.php")?>
</html>




