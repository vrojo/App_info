<?php
session_start();
require '../Modele/fonctions_crea_event.php';
require '../Modele/model.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
 
    <head>
        <meta charset="UTF-8">
           <link type="text/css" rel="stylesheet" href="../Vue/creationevent.css"/>
           <script type="text/javascript" src="../Vue/creationevent.js"></script>
        <title>Création d'événement</title>
    </head>
    
        <body>
            <?php include ("Header.php"); ?>
            <form action="../Modele/eventcree.php" method="POST">

            <table align="center" id="table1">
            
                <td align='center'><em><h1>Créer un événement:</h1><br>*créez rapidement un événement privé ou visible par tous en remplissant ce formulaire</em><br>&nbsp;
                    <table>
                
                        <tr>
            
                        <td height=25 align="center"><label for="login"><strong>Nom de l'événement:</strong></label></td>
                        <td align="left"><input type="text" name="Nom_e" id="nameevent" placeholder="Technoparade" oninput="verifNom(this)"/><span id="erreur_nom"></span></td>
            
                        </tr>
                        <td></td>
                        <tr>
            
                        <td height=25 align="center"><label for="login"><strong>Adresse :</strong></label></td>
                        <td align="left"><input type="number" name="numerorue" id="adresseevent1" placeholder="n°" oninput="verifNumrue(this)"/>&nbsp; <input type="text" name="rue" id="adresseevent3" placeholder="rue" oninput="verifRue(this)"/> &nbsp; <input type="text" name="ville" id="adresseevent1" placeholder="ville" oninput="verifVille(this)"/> &nbsp; <input type="number" name="codepostal" id="adresseevent2" placeholder="code postal" oninput="verifCodepostal"/> &nbsp; <input type="text" name="pays" id="adresseevent1" placeholder="pays" oninput="verifPays(this)"/><br>
                            <span id="erreur_prix"></span><span id="erreur_numrue"></span><span id="erreur_rue"></span><span id="erreur_ville"></span><span id="erreur_codepostal"></span><span id="erreur_pays"></span></td>
            
                        </tr>
                        <td></td>
                        <tr>
            
                        <td height=25 align="center"><label for="login"><strong>Prix :</strong></label></td>
                        <td align="left"><input type="number" name="prix" id="prix" placeholder="10€" oninput="verifPrix(this)"/> <span id="erreur_prix"></span> </td>
            
                    </tr>
                    <tr>
                        <td colspan='2' align='center'>_______________________</td>
                    </tr>
                    <td colspan='2' align='center'>_________________________________________________________________________________________</td>
                    <tr>
                        <td colspan='2' align='center'>_______________________<br><br><br>&nbsp;</td>
                    </tr>
                    <tr>
            
                    <td height=25 align="center" colspan='2'><label for="pass"><strong>Date de l'événement :</strong></label></td>
                    </tr>
                    <tr>
                    <td align="right">début:<br><input type="date" name="date_e" id="date_event"/></td>
                    <td align="center">fin:<br><input type="date" name="date_f" id="date_event"/></td>
                    
                    </tr>
                    <td>&nbsp;<br>&nbsp;</td>
                    <tr>
            
                    <td height=25 align="center" colspan='2'><label for="pass2"><strong>horaires :</strong></label></td>
                    </tr>
                    <tr>
                    <td align="center" colspan='2'>début: &nbsp;<input type="time" name="heuredebut" id="heureevent"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; fin: &nbsp;&nbsp;<input type="time" name="heurefin" id="heureevent"/></td>
                    </tr>
                    <td>&nbsp;<br>&nbsp;</td>
                    <tr>
            
                    <td height=25 align="center" colspan='2'><label for="pass"><strong>Nombre maximum de participants :</strong></label>&nbsp;&nbsp;&nbsp;<input type="number" name="nb_max_participant" id="nombre" placeholder="25"/></td>
                    
                    </tr>
                    <td>&nbsp;<br>&nbsp;</td>
                    <tr>
            
                    <td height=25 align="center"><label for="login"><strong>Catégorie de l'event :</strong></label></td>
                    <td align="left"><!--<table ><tr><td>
                                        
                                                            <INPUT type="checkbox" name="sport" value="1">sport &nbsp; &nbsp; &nbsp;
							    <INPUT type="checkbox" name="repas" value="2">repas &nbsp; &nbsp; &nbsp;
							    <INPUT type="checkbox" name="cinéma" value="3">cinéma &nbsp; &nbsp; &nbsp;
                                                            <INPUT type="checkbox" name="danse" value="6">danse
                                                                                <br>
					<br>	 
							<INPUT type="checkbox" name="sortie" value="4">sortie &nbsp; &nbsp; &nbsp;
							<INPUT type="checkbox" name="exposition" value="expo">expo &nbsp; &nbsp; &nbsp;
							<INPUT type="checkbox" name="festival" value="6">festival &nbsp; &nbsp; &nbsp;
					    	<INPUT type="checkbox" name="dégustation" value="7">dégustation
</td></tr></table>--><?php $result = affichage_categ_recherche_avancee();
                                 $compteur = 0;
                                 while($categorie = mysqli_fetch_assoc($result)) {
                                     if($compteur != 4){
                                        echo'<div class="checkrecherche"><input type="checkbox" value='.$categorie['id_categ'].' name='.$categorie['nomCat'].'>'.$categorie['nomCat'].'</div>&nbsp; &nbsp; &nbsp;';                               
                                        $compteur = $compteur +1;
                                 }
                                     else{
                                         echo'<br> <br>';
                                         $compteur = 0;
                                        }
                                 }
                                    ?>
                            <?php mysqli_free_result($result); ?></td>
            
                    </tr>
                    <td>&nbsp;<br>&nbsp;</td>
                    <tr>
                    <tr>
                    <td height=25 align="center"><label for="login"><strong>Description :</strong><br><br><em>*Ecrivez une petite description de l'événement<br>qui pourra être vue par les autres utilisateurs sur <br> la page de l'événement.</em></label></td>
                    <td align="left">&nbsp;&nbsp;<textarea name="description_e" id="description" placeholder="entrez une petite description de l'événement pour inciter les autres utilisateurs à s'inscrire !"></textarea></td>
                    </tr>
                    <td height='25'>&nbsp;</td><tr></tr>
                    <tr><td align="center"><strong>Image du/des sponsor(s):</strong></td><td align='left'><input type="text" name="sponsor" placeholder="url de l'image"><input type="text" name="sponsor2" placeholder="url de l'image"><br><input type="text" name="sponsor3" placeholder="url de l'image"><input type="text" name="sponsor" placeholder="url de l'image"><br></td></tr>
                    <td>&nbsp;</td>
                    <tr>
                    <td align="right" >&nbsp;<em>**Créez un événement privé pour lequel <br>vous pourrez désigner les personnes ayant la <br>possibilité de voir l'événement sur le site</em></td><td id="prive" align="left"><INPUT type="checkbox" name="privacy" value="10"> <strong>événement privé</strong>
                
                    </td>
                    </tr>
                    
                    
                    
                    
                    
                    
                    
                    <tr>
                        <table cellspacing="50">
                            <tr>
                                <td align="left">
                                    <strong>url de l'image principale</strong>
                                    <br>
                                    <input type="text" name="urlimg_event" id="adresseevent" placeholder=""/><img id="plus" src="http://www.icone-png.com/png/20/20012.png"/>
                                    <br><br>
                                    <strong>url d'images suplémentaires</strong>
                                    <br>
                                    <input type="text" name="urlimg_event1" id="adresseevent" placeholder=""/><img id="plus" src="http://www.icone-png.com/png/20/20012.png"/>
                                    <br>
                                    <input type="text" name="urlimg_event2" id="adresseevent" placeholder=""/><img id="plus" src="http://www.icone-png.com/png/20/20012.png"/>
                                    <br>
                                    <input type="text" name="urlimg_event3" id="adresseevent" placeholder=""/><img id="plus" src="http://www.icone-png.com/png/20/20012.png"/>
                                </td>
                                <td>
                                    <strong>url du site</strong>
                                    <br>
                                    <input type="text" name="urlsite_event" id="adresseevent" placeholder=""/><img id="plus" src="http://www.icone-png.com/png/20/20012.png"/>
                                </td>
                            </tr>
                            <tr>
                                <td id="creer" colspan="2" align="right">
                                    <a href="BDDevent.php" id="bouton" style="color:black"><strong><u><em><input type="submit" value="créer" id="go"/></em></u></strong></a>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <td colspan="2"><?php include '../Vue/footer.php';?></td>
                    </tr>
                    
                </table>    
    </body>
</html>