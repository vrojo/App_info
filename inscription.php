<?php

require 'fonctions_inscription.php';
?>
<!DOCTYPE html>
<html>

    <head>
    
        <title>Inscription</title>
        <meta charset="utf8"
    
    </head>
    <link type="text/css" rel="stylesheet" href="Inscription.css"/>
    <body background="http://images.forwallpaper.com/files/thumbs/preview/72/727174__background-graphics-wallpaper-screensaver-blue-pictures_p.jpg">
        <?php include ("Header.php"); ?>
        <form action="inscriptionfaite.php" method="POST">

            <table cellspacing="30"  align="center" id="table1">                           <!-- revoir cette ligne pour aligner le block complet-->
            
            <td>
                <img src="https://www.plug-it.com/assets/img/owncloud/owncloud3.png" border="3"/><br>
                <h3>Inscrivez-vous<br> et rejoigniez le mouvement!!</h3><br>
                <img id="picnic" src="http://www.ville-st-privat-des-vieux.com/sites/www.ville-st-privat-des-vieux.com/IMG/jpg/03e8000004233056-photo-pique-nique.jpg" border=3 />
            </td>
            
            
                
            <td><em><h1>Inscription : </h1><br>*Veillez à bien remplir votre formulaire car il vous permettra utiliser de manière optimale Simpl'event</em><br>&nbsp;
                <table  >
                
                <tr>
            
                <td height=25 align="center"><label for="login"><strong>Nom :</strong></label></td>
                <td align="left"><?php echo'<input type="text" name="nom_u" id="name" placeholder="Dutronc">'; ?></td>
            
                </tr>
                <td></td>
                <tr>
            
                <td height=25 align="center"><label for="login"><strong>Prénom :</strong></label></td>
                <td align="left"><?php echo'<input type="text" name="prenom_u" id="firstname" placeholder="Jacques">'; ?></td>
            
                </tr>
                <td></td>
                <tr>
            
                <td height=25 align="center"><label for="login"><strong>Adresse :</strong></label></td>
                <td align="left"><input type="text" name="adresse" id="firstname" placeholder="123 rue Charles de Gaulle, Paris"/></td>
            
                </tr>
                <td></td>
                <tr>
            
                <td height=25 align="center"><label for="login"><strong>Adresse e-mail :</strong></label></td>
                <td align="left"><?php echo'<input type="email" name="mail" id="mail" placeholder="...................@.............."  value='.$_POST['adrinscri'].'>'; ?></td>
            
                </tr>
                <td></td>
                <tr>
            
                <td height=25 align="center"><label for="login"><strong>téléphone :</strong></label></td>
                <td align="left"><input type="tel" name="telephone" id="mail" placeholder="06 12 34 56 78"/></td>
            
                </tr>
                <td></td>
                <tr>
            
                <td height=25 align="center"><label for="login"><strong>Mot de passe :</strong></label></td>
                <td align="left"><input type="password" name="mot_de_passe" id="pass" placeholder="*******"/></td>
            
                </tr>            
                <td></td>
                <tr>
            
                <td height=25 align="right"><label for="pass"><strong>Confirmation du mot de passe :</strong></label></td>
                <td align="left"><input type="password" name="confirmation_mdp" id="passpass" placeholder="*******"/></td>
                    
                </tr>
                <td></td>
                <tr>
            
                <td height=25 align="center"><label for="pass2"><strong>Date de naissance :</strong></label></td>
                <td align="left"><input type="date" name="date_de_naissance" id="date" /></td>
                </tr>
                <td></td>
                <tr>
            
                <td height=25 align="center"><label for="login"><strong>Centres d'intérêt :</strong></label></td>
                                        <td align="left"><table ><tr><td><!--<input type="text" name="login" id="login"/>-->
                                        <FORM class="miseenforme">
                                                            <INPUT type="checkbox" name="sport" value="1">sport &nbsp; &nbsp; &nbsp;
							    <INPUT type="checkbox" name="repas" value="2">repas &nbsp; &nbsp; &nbsp;
							    <INPUT type="checkbox" name="cinéma" value="3">cinéma &nbsp; &nbsp; &nbsp;
                                                            <INPUT type="checkbox" name="danse" value="6">danse
                                        </FORM>
                                        <br>
					<br><FORM class="miseenforme">	 
							<INPUT type="checkbox" name="sortie" value="4">sortie &nbsp; &nbsp; &nbsp;
							<INPUT type="checkbox" name="exposition" value="5">expo &nbsp; &nbsp; &nbsp;
							<INPUT type="checkbox" name="festival" value="6">festival &nbsp; &nbsp; &nbsp;
					    	<!--<INPUT type="checkbox" name="dégustation" value="7">dégustation fin du test-->
                                        </FORM><!--fin du test--> </td></tr></table></td>
            
                </tr>
                <td></td>
                <tr>
            
                    <td height=25 align="center"><label for="login"><strong>Description :</strong><br><br><em>**Ecrivez une petite des-<br> cription qui vous défini<br>et pourra être vue par<br>les autres utilisateurs sur <br> votre profil.</em></label></td>
                <td align="left"><textarea name="description" id="description" placeholder="entrez une petite description de vous..."></textarea></td>
                </tr>
                
            </table></td>
                
            <td>
                <img id="profil" src="profil4.png" border="4"/><br>Ajouter une photo
                &nbsp;<br>
                <br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                <INPUT type="file" id="ajouterphoto" name="photo_u"/>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                <a href="#" id="bouton" style="color:black"><strong><u><em><input type="submit" id="go" name="register" value="S'inscrire"/></em></u></strong></a>
            </td>
                
                
                
                
                

            </table></td>
            </table>
        
        <input type="submit" name="register" value="S'inscrire"/>
        
        </form>
    </body>

</html>




