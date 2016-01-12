<?php
require 'PHPMailerAutoload.php';

$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");



function affichage_categ_recherche_avancee(){
    global $connect;
    $result = mysqli_query($connect, "select * from categorie order by nomCat") or die("MsQL Erreur : ".mysqli_errno($connect));
    return $result;
}

function insert_categ($nomCat) {
    $nomCat = htmlspecialchars (addslashes($nomCat));
    global $connect;
    mysqli_query($connect, "insert into categorie (nomCat) values ('$nomCat')") or die("MySQL Erreur : " . mysqli_error($connect));
}

function delete_categ($id_categ) {
    $id_categ = htmlspecialchars (addslashes($id_categ));
    global $connect;
    mysqli_query($connect, "delete from categorie where id_categ ='$id_categ'") or die("MySQL Erreur : " . mysqli_error($connect));
}

function update_categ($nouveauNom, $idcateg){
    $nouveauNom = htmlspecialchars (addslashes($nouveauNom));
    $idcateg = htmlspecialchars (addslashes($idcateg)); 
    global $connect;
    mysqli_query($connect, "update categorie set nomCat='$nouveauNom' where id_categ=".$idcateg) or die("MySQL Erreur : " . mysqli_error($connect));
}

function verification_mdp($adrentre){
    $adrentre = htmlspecialchars (addslashes($adrentre));
    global $connect;
    $result = mysqli_query($connect, "select mot_de_passe,id_utilisateur,admin from utilisateur where mail='$adrentre'") or die("MsQL Erreur : ".mysqli_errno($connect));
    $resultat = mysqli_fetch_assoc($result);
    return $resultat;   
}




function modification_categorie(){
    $result = affichage_categ_recherche_avancee();
                $compteur = 1;
                
                
                if($compteur==1){
                    
                    
                    
                    $result = affichage_categ_recherche_avancee();
                    echo'<div class="zone_input_categ">';
                    
                    while($categorie = mysqli_fetch_assoc($result)) {                
                        
                        echo'<form action="gestion_categorie.php" method="post">';
                        echo '<div class="nom_de_categ">'.$categorie['nomCat'].'</div>';
                        echo'<input type="text" class="zone_modification_categ" placeholder="modification" name='.$categorie['nomCat'].'> ';
                        echo'<input type="submit" value="supprimer/modifier" class="bouton_suppression_categ" name='.$categorie['id_categ'].'>';
                        echo'</form>';
                       
                    }
                    $compteur = 0;
                }
    }






function affichage_utilisateurs(){
    global $connect;
    $result = mysqli_query($connect, "select mail from utilisateur order by mail") or die("MsQL Erreur : ".mysqli_errno($connect));
    return $result;
}


function affichage_topics(){
    global $connect;
    $result = mysqli_query($connect, "select * from sujet") or die("MsQL Erreur : ".mysqli_errno($connect));
                $compteur = 1;
                
                
                if($compteur==1){
                    while($topic = mysqli_fetch_assoc($result)) {
                        
                        // ici inclure requete recup reponse par rapport au sujet
                        //recup nombre message
                        //recup derniere 
                        
                        
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

function inscriptionpreleminaire($mail, $mdp, $confinsc, $confmod){
    $mail = htmlspecialchars (addslashes($mail));
    $mdp = htmlspecialchars (addslashes($mdp));
    global $connect;
    mysqli_query($connect, "insert into utilisateur (mail, mot_de_passe, confirmation_inscription, conf_mod_prof) values ('$mail', '$mdp', '$confinsc', '$confmod')") or die("MySQL Erreur : " . mysqli_error($connect));
    $result = mysqli_query($connect, "select id_utilisateur from utilisateur where mail='$mail'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult = mysqli_fetch_assoc($result);
    $id = $tableauResult['id_utilisateur'];
    mysqli_query($connect, "insert into confirmation_inscription (id_utilisateur) values ('$id')") or die("MySQL Erreur : " . mysqli_error($connect));
}



function verif_confirmation($mail){
    $mail = htmlspecialchars (addslashes($mail));
    global $connect;
    $result = mysqli_query($connect, "select confirmation_inscription from utilisateur where mail='$mail'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult = mysqli_fetch_assoc($result);
    
    if ($tableauResult['confirmation_inscription'] == 0){
        return true;
    }
    else{
        return false;
    }
}


function envoimail_confirmation($maildestinataire){
    $maildestinataire = htmlspecialchars (addslashes($maildestinataire));
    $mail = new PHPMailer;
 
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';                       
    $mail->SMTPAuth = true;                               
    $mail->Username = 'sitesimplevent@gmail.com';         
    $mail->Password = 'LeSiteSimpleventVousAccueille';    
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                    
    $mail->setFrom('sitesimplevent@gmail.com', 'Simplevent');
    $mail->addAddress($maildestinataire);  
    $mail->WordWrap = 50;                                 
    $mail->isHTML(true);                                  
    
    $lien = lien_inscription($maildestinataire);
    
    $mail->Subject = 'Votre inscription sur Simplevent';
    $mail->Body    = 'Veuillez vous rendre sur ce lien :'.$lien.'  pour confirmer votre inscription sur Simplevent.';
    $mail->AltBody = 'Veuillez vous rendre sur ce lien :'.$lien.' pour confirmer votre inscription sur Simplevent.';

    if(!$mail->send()) {
        return 0;
    }
    else{
        return 1;
    }
}


function lien_inscription($mail){
    $mail = htmlspecialchars (addslashes($mail));
    global $connect;
    $result = mysqli_query($connect, "select id_utilisateur from utilisateur where mail='$mail'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult = mysqli_fetch_assoc($result);
    $id = $tableauResult['id_utilisateur'];
    $result2 = mysqli_query($connect, "select id_conf from confirmation_inscription where id_utilisateur=$id") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult2 = mysqli_fetch_assoc($result2);
    $idconf = $tableauResult2['id_conf'];
    $message = "http://localhost/Versionsitefinale/confirmation_inscription.php?id=$id&idconf=$idconf";
    return $message;
}

function confirmation_inscription(){
    if(isset($_GET['id']) && $_GET['id'] != 0){
        global $connect;
        $id = $_GET['id'];
        $conf = 1;
        $result = mysqli_query($connect, "select confirmation_inscription from utilisateur where id_utilisateur='$id'") or die("MySQL Erreur : " . mysqli_error($connect));
        $tableauResult = mysqli_fetch_assoc($result);
        if($tableauResult != null){
            mysqli_query($connect, "update utilisateur set confirmation_inscription=$conf where id_utilisateur = $id") or die("MySQL Erreur : " . mysqli_error($connect));
            return false;
        }   
        else{
            return true;        
        }
    }
}

function verif_id($id, $idconf){
    $id = htmlspecialchars (addslashes($id));
    $idconf = htmlspecialchars (addslashes($idconf));
    global $connect;
    $result = mysqli_query($connect, "select * from confirmation_inscription where id_utilisateur=$id and id_conf=$idconf") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult = mysqli_fetch_assoc($result);
    if($tableauResult == null){
        return false;
    }
    else{
        return true;
    }
}

function verfifMailEx($mail){
    $mail =  htmlspecialchars (addslashes($mail));
    global $connect;
    $result = mysqli_query($connect, "select id_utilisateur from utilisateur where mail='$mail'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult = mysqli_fetch_assoc($result);
    if($tableauResult == null){
        return true;
    }
    else{
        return false;
    }
}

function affichage_centre_interet(){
    $result = affichage_categ_recherche_avancee();
    $compteur = 0;
    while($categorie = mysqli_fetch_assoc($result)) {
        if($compteur != 4){
            echo'<div class="checkrecherche"><input type="checkbox" name = '.$categorie['nomCat'].' value='.$categorie['id_categ'].'>'.$categorie['nomCat'].'</div>&nbsp; &nbsp; &nbsp;';                               
            $compteur = $compteur +1;
        }
        else{
            echo'<br> <br>';
            $compteur = 0;
        }
    }
}

function enregistrement_final($id, $nom, $prenom, $mail, $mdp, $numrue, $rue, $ville, $codepostal, $pays, $tel, $datenaissance, $description, $photo, $sexe){
    $id = htmlspecialchars (addslashes($id));
    $nom = htmlspecialchars (addslashes($nom));
    $prenom = htmlspecialchars (addslashes($prenom));
    $mail = htmlspecialchars (addslashes($mail));
    $mdp = htmlspecialchars (addslashes($mdp));
    $numrue = htmlspecialchars (addslashes($numrue));
    $rue = htmlspecialchars (addslashes($rue));
    $ville = htmlspecialchars (addslashes($ville));
    $codepostal = htmlspecialchars (addslashes($codepostal));
    $pays = htmlspecialchars (addslashes($pays));
    $tel = htmlspecialchars (addslashes($tel));
    $description = htmlspecialchars (addslashes($description));
    $photo = htmlspecialchars (addslashes($photo));
    global $connect;
    mysqli_query($connect, "insert into adresse (numerorue, rue, ville, codepostal, pays) values ('$numrue','$rue','$ville','$codepostal','$pays')") or die("MySQL Erreur : " . mysqli_error($connect));  
    $idadresse = mysqli_query($connect, "select id_adresse from adresse where numerorue='$numrue' and rue ='$rue' and ville='$ville' and codepostal='$codepostal' and pays='$pays'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauidadresse = mysqli_fetch_assoc($idadresse);
    $idad = $tableauidadresse['id_adresse'];
    $confmod = 1;
    mysqli_query($connect, "update utilisateur set nom_u = '$nom', prenom_u = '$prenom', date_de_naissance = '$datenaissance', description = '$description', photo_u = '$photo', mail = '$mail', telephone = '$tel', mot_de_passe = '$mdp', sexe = '$sexe', id_adresse = '$idad', conf_mod_prof = '$confmod'  where id_utilisateur = '$id'") or die("MySQL Erreur : " . mysqli_errno($connect));
}

function enregistrement_centreinterets($idutilisateur, $idcateg){
    global $connect;
    mysqli_query($connect, "insert into preference (id_utilisateur, id_categ) values ('$idutilisateur','$idcateg')") or die("MySQL Erreur : " . mysqli_error($connect));      
}


function carrousel_page($event1,$event2,$event3,$event4,$event5,$event6,$event7,$event8,$event9 ){
    global $connect;
            $result = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event1'");
            $result2 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event2'");
            $result3 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event3'");
            $result4 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event4'");
            $result5 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event5'");
            $result6 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event6'");
            $result7 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event7'");
            $result8 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event8'");
            $result9 = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where principale = 1 & Event_id = '$event9'");

            $tableauResult1 = mysqli_fetch_assoc($result);
            $tableauResult2 = mysqli_fetch_assoc($result2);
            $tableauResult3 = mysqli_fetch_assoc($result3);
            $tableauResult4 = mysqli_fetch_assoc($result4);
            $tableauResult5 = mysqli_fetch_assoc($result5);
            $tableauResult6 = mysqli_fetch_assoc($result6);
            $tableauResult7 = mysqli_fetch_assoc($result7);
            $tableauResult8 = mysqli_fetch_assoc($result8);
            $tableauResult9 = mysqli_fetch_assoc($result9);
            
            $urlimg1 = $tableauResult1['urlimg_event'];
            $urlimg2 = $tableauResult2['urlimg_event'];
            $urlimg3 = $tableauResult3['urlimg_event'];
            $urlimg4 = $tableauResult4['urlimg_event'];
            $urlimg5 = $tableauResult5['urlimg_event'];
            $urlimg6 = $tableauResult6['urlimg_event'];
            $urlimg7 = $tableauResult7['urlimg_event'];
            $urlimg8 = $tableauResult8['urlimg_event'];
            $urlimg9 = $tableauResult9['urlimg_event'];
            
            
    echo '  
            

                        <div id="contenant_slider">
                            <div id="limitation">
                                    <div class="contenu">
                                            <a href="Events?id=<?php echo'. $event1.'?><div id="evenement1" class="evenement" style="Background-image:URL=<?php echo '.$urlimg1.' ?>"></div>
                                            <a href="Events?id=<?php echo '.$event2.'?><div id="evenement2" class="evenement" style="Background-image:URL=<?php echo '.$urlimg2.' ?>></div>
                                            <a href="Events?id=<?php echo '.$event3.'?><div id="evenement3" class="evenement" style="Background-image:URL=<?php echo '.$urlimg3.' ?>></div>
                                    </div>
                                    <div class="contenu">
                                            <a href="Events?id=<?php echo '.$event4.'?><div id="evenement4" class="evenement" style="Background-image:URL=<?php echo '.$urlimg4.' ?>></div>
                                            <a href="Events?id=<?php echo '.$event5.'?><div id="evenement5" class="evenement" style="Background-image:URL=<?php echo '.$urlimg5.' ?>></div>
                                            <a href="Events?id=<?php echo '.$event6.'?><div id="evenement6" class="evenement" style="Background-image:URL=<?php echo '.$urlimg6.' ?>></div>
                                    </div>
                                    <div class="contenu">
                                            <a href="Events?id=<?php echo '.$event7.'?><div id="evenement7" class="evenement" style="Background-image:URL=<?php echo '.$urlimg7.' ?>></div>
                                            <a href="Events?id=<?php echo '.$event8.'?><div id="evenement8" class="evenement" style="Background-image:URL=<?php echo '.$urlimg8.' ?>></div>
                                            <a href="Events?id=<?php echo '.$event9.'?><div id="evenement9" class="evenement" style="Background-image:URL=<?php echo '.$urlimg9.' ?>></div>
                                    </div>
                            </div>
                    </div>
                    <div id="points_navigation">
                            <ul>
                                    <li class="itemLinks" data-pos="0%"></li>
                                    <li class="itemLinks" data-pos="-33.2%"></li>
                                    <li class="itemLinks" data-pos="-66.4%"></li>
                            </ul>
                    </div>
                    <script type="text/javascript">
                            Slider();
                    </script>';
}

function carrousel_event($event1){
    global $connect;
    $result = mysqli_query($connect, "SELECT DISTINCT urlimg_event from multimedia where Event_id = '$event1'");       
    $urlimg =[];
    while($tableauResult1 = mysqli_fetch_assoc($result)){
       
            $urlimg[] = $tableauResult1['urlimg_event'];
        }
    
            
            
    echo ' 
                    <div id="contenant_slider">
                            <div id="limitation">
                                    <div class="contenu">
                                            <a href="Events?id=<?php echo ?><div id="evenement1" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[0].' ?>"></div>
                                            <a href="Events?id=<?php echo ?><div id="evenement2" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[1].' ?>></div>
                                            <a href="Events?id=<?php echo ?><div id="evenement3" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[2].' ?>></div>
                                    </div>
                                    <div class="contenu">
                                            <a href="Events?id=<?php echo ?><div id="evenement4" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[3].' ?>></div>
                                            <a href="Events?id=<?php echo ?><div id="evenement5" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[4].' ?>></div>
                                            <a href="Events?id=<?php echo ?><div id="evenement6" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[5].' ?>></div>
                                    </div>
                                    <div class="contenu">
                                            <a href="Events?id=<?php echo ?><div id="evenement7" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[6].' ?>></div>
                                            <a href="Events?id=<?php echo ?><div id="evenement8" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[7].' ?>></div>
                                            <a href="Events?id=<?php echo ?><div id="evenement9" class="evenement" style="Background-image:URL=<?php echo '.$urlimg[9].' ?>></div>
                                    </div>
                            </div>
                    </div>
                    <div id="points_navigation">
                            <ul>
                                    <li class="itemLinks" data-pos="0%"></li>
                                    <li class="itemLinks" data-pos="-33.2%"></li>
                                    <li class="itemLinks" data-pos="-66.4%"></li>
                            </ul>
                    </div>
                    <script type="text/javascript">
                            Slider();
                    </script>';
}


function affichage_utilisateur_signales(){
    global $connect;
    $result = mysqli_query($connect, "SELECT utilisateur.id_utilisateur, nom_u, prenom_u, mail, id_balance FROM utilisateur INNER JOIN signaler ON utilisateur.id_utilisateur = signaler.id_utilisateur") or die("MsQL Erreur : ".mysqli_errno($connect));
        echo'<div class="titre_gestion_utilisateur">Utilisateurs signalés par la communauté :</div>';
        echo'<br>';
        echo "<div id='tableau_utilisateur_signales'>";
        echo "<table><thead><tr><th>Nom </th><th>Prenom </th><th>Mail </th></tr></thead>";
        while($infos = mysqli_fetch_assoc($result)) {
        
        echo "<tr>";
        echo '<td><a href="autreprofil.php?id_utilisateur='.$infos['id_utilisateur'].'">'.$infos['nom_u'].'</a></td>';
        echo '<td><a href="autreprofil.php?id_utilisateur='.$infos['id_utilisateur'].'">'.$infos['prenom_u'].'</a></td>';
        echo '<td><a href="autreprofil.php?id_utilisateur='.$infos['id_utilisateur'].'">'.$infos['mail'].'</a></td>';
        echo '<td><a href="autreprofil.php?id_utilisateur='.$infos['id_balance'].'">'.$infos['id_balance'].'</a></td>';
        echo '<td><form method="POST" action="gestion_utilisateur.php">
                <input type="text" name="id" style="display:none" value='.$infos['id_utilisateur'].'></input>
                <input type="submit" name="action" value="supprimmer" id="bouton_suppression_utilisateur"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';

} 

function suppression_utilisateur($idutilisateur){
    global $connect;
    $id = htmlspecialchars (addslashes($idutilisateur));
    mysqli_query($connect, 'delete from utilisateur where id_utilisateur='.$id) or die("MsQL Erreur : ".mysqli_errno($connect));
}

function update_utilisateur($idutilisateur){
    global $connect;
    $admin = 1;
    $id = htmlspecialchars (addslashes($idutilisateur));
    mysqli_query($connect, 'update utilisateur set admin  = '.$admin.' where id_utilisateur='.$id) or die("MsQL Erreur : ".mysqli_errno($connect));
}
?>  
