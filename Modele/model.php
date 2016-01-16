
<?php

require'PHPMailerAutoload.php';

$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf-8");



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
    $message = "http://localhost/App_info/Vue/confirmation_inscription.php?id=$id&idconf=$idconf";
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
    $description = nl2br(htmlspecialchars (addslashes($description)));
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


function affichage_utilisateur_signales(){
    global $connect;
    $result = mysqli_query($connect, "SELECT utilisateur.id_utilisateur, nom_u, prenom_u, mail, id_balance FROM utilisateur INNER JOIN signaler ON utilisateur.id_utilisateur = signaler.id_utilisateur") or die("MsQL Erreur : ".mysqli_errno($connect));
        echo'<div class="titre_gestion_utilisateur">Utilisateurs signalés par la communauté :</div>';
        echo'<br>';
        echo "<div id='tableau_utilisateur_signales'>";
        echo "<table><thead><tr><th>Prenom </th><th>Nom </th><th>Mail </th></tr></thead>";
        while($infos = mysqli_fetch_assoc($result)) {
        
        echo "<tr>";
        echo '<td><a href="autreprofil.php?id_utilisateur='.$infos['id_utilisateur'].'">'.$infos['prenom_u'].'</a></td>';
        echo '<td><a href="autreprofil.php?id_utilisateur='.$infos['id_utilisateur'].'">'.$infos['nom_u'].'</a></td>';
        echo '<td><a href="autreprofil.php?id_utilisateur='.$infos['id_utilisateur'].'">'.$infos['mail'].'</a></td>';
        echo '<td><form method="POST" action="../Controler/controleur_gestion_utilisateur.php">
                <input type="text" name="id" style="display:none" value='.$infos['id_utilisateur'].'></input> 
                <input type="submit" name="action" value="supprimmer" id="bouton_suppression_utilisateur"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';

} 

function suppression_utilisateur($idutilisateur){
    global $connect;
    $id = htmlspecialchars (addslashes($idutilisateur));
    $idbanni = 17;
    mysqli_query($connect, "update commente set id_utilisateur = $idbanni where id_utilisateur = $id") or die("Ms1QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update confirmation_inscription set id_utilisateur = $idbanni where id_utilisateur = $id")or die("Ms2QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update event set id_utilisateur = $idbanni where id_utilisateur = $id")or die("Ms3QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update messagerie set id_destinataire = $idbanni, id_expediteur = $idbanni where id_destinataire = $id or id_expediteur = $id")or die("Ms4QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update participation set id_participant = $idbanni where id_participant = $id") or die("Ms5QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update preference set id_utilisateur = $idbanni where id_utilisateur = $id")or die("Ms6QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update rep_topic set id_utilisateur = $idbanni where id_utilisateur = $id")or die("Ms8QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update signaler set id_utilisateur = $idbanni where id_utilisateur = $id")or die("Ms9QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update signaler set id_balance = $idbanni where id_balance = $id")or die("Ms10QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "update sujet set id_utilisateur = $idbanni where id_utilisateur = $id")or die("Ms11QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, 'delete from utilisateur where id_utilisateur='.$id) or die("Ms12QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, 'delete from relation_amicale where id_utilisateur='.$id) or die("Ms15QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, 'delete from relation_amicale where id_ami='.$idbanni) or die("Ms16QL Erreur : ".mysqli_errno($connect));  
    mysqli_query($connect, 'delete from participation where id_participant='.$idbanni) or die("Ms14QL Erreur : ".mysqli_errno($connect));
    
}


function suppression_signalement_utilisateur($idutilisateur){
    global $connect;
    mysqli_query($connect, "delete from signaler where id_utilisateur = $idutilisateur") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function update_utilisateur($mail){
    global $connect;
    $admin = 1;
    echo $mail;
    mysqli_query($connect, "update utilisateur set admin = $admin where mail = '$mail'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function select_categ($id, $categ){
    global $connect;
    $result = mysqli_query($connect, 'select * from preference where id_utilisateur = '.$id.' and id_categ='.$categ) or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresult = mysqli_fetch_assoc($result);
    
    if($tableauresult == null){
        return true;
    }
    else{
        return false;
    }
}

function suppression_categ($id, $categ){
    global $connect;
    mysqli_query($connect, "delete from preference where id_utilisateur = '$id' and id_categ='$categ'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function remplissage_modifprofil($id){
    global $connect;
    $resultutilisateur = mysqli_query($connect, 'select * from utilisateur where id_utilisateur = '.$id) or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresultutilisateur = mysqli_fetch_assoc($resultutilisateur);
    return $tableauresultutilisateur;
}
function remplissage_modifprofil_adresse($id){
    global $connect;
    $resultutilisateur = mysqli_query($connect, 'select * from utilisateur where id_utilisateur = '.$id) or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresultutilisateur = mysqli_fetch_assoc($resultutilisateur);
    $resultadresse = mysqli_query($connect, 'select * from adresse where id_adresse = '.$tableauresultutilisateur['id_adresse']) or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresultadresse = mysqli_fetch_assoc($resultadresse);
    return $tableauresultadresse;
}


function modification_commentaires(){
    global $connect;
    $commentaires_signales = mysqli_query($connect, "SELECT commente.id_commentaire, texte_co FROM commente INNER JOIN signaler ON signaler.id_commentaire = commente.id_commentaire") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo'<div class="titre_gestion_commentaires">Commentaires signalés par la communauté :</div>';
    echo'<br>';
    echo "<div id='tableau_commentaires_signales'>";
    echo "<table><thead><tr><th>Détails du commentaire </th></thead>";
    while($tableau_commentaires_signales = mysqli_fetch_assoc($commentaires_signales)) {        
        echo "<tr>";
        echo '<td>'.$tableau_commentaires_signales['texte_co'].'</td>';
        echo '<td><form method="POST" action="../Controler/controleur_gestion_commentaires.php">
                <input type="hidden" value="'.$tableau_commentaires_signales['id_commentaire'].'" name="idcom">
                <input type="submit" name="action" value="supprimmer" id="bouton_suppression_commentaire"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';
}

function suppression_commentaire($id){
    global $connect;
    mysqli_query($connect, "delete from commente where id_commentaire = '$id'") or die("MsQL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from signaler where id_commentaire = '$id'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function suppression_signalement_commentaire($idcom){
    global $connect;
    mysqli_query($connect, "delete from signaler where id_commentaire = $idcom") or die("MsQL Erreur : ".mysqli_errno($connect));
}


function affichage_event_signales(){
    global $connect;
    $event_signales = mysqli_query($connect, "SELECT event.Event_id, Nom_e FROM event INNER JOIN signaler ON signaler.Event_id = event.Event_id") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo'<div class="titre_gestion_event">Evénements signalés par la communauté :</div>';
    echo'<br>';
    echo "<div id='tableau_event_signales'>";
    echo "<table><thead><tr><th> Nom de l'événement : </th></thead>";
    while($tableau_event_signales = mysqli_fetch_assoc($event_signales)) {        
        echo "<tr>";
        echo '<td><a href="Events.php?Event_id='.$tableau_event_signales['Event_id'].'">'.$tableau_event_signales['Nom_e'].'</a></td>';
        echo '<td><form method="POST" action="../Controler/controleur_gestion_event.php">
                <input type="hidden" value="'.$tableau_event_signales['Event_id'].'" name="idevent">
                <input type="submit" name="action" value="supprimmer" id="bouton_suppression_event"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';
}

function suppression_event($idevent){
    global $connect;
    mysqli_query($connect, "delete from commente where Event_id = '$idevent'") or die("Ms1QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from multimedia where Event_id = '$idevent'") or die("Ms2QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from participation where Event_id = '$idevent'") or die("Ms3QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from sponsorise where Event_id = '$idevent'") or die("Ms4QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from typeevent where Event_id = '$idevent'") or die("Ms5QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from signaler where Event_id = '$idevent'") or die("Ms6QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from event where Event_id = '$idevent'") or die("Ms7QL Erreur : ".mysqli_errno($connect));  
}

function suppression_signalement_event($idevent){
    global $connect;
    mysqli_query($connect, "delete from signaler where Event_id = $idevent") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function liste_admin(){
    global $connect;
    $resultadmin = mysqli_query($connect, "select * from utilisateur where admin = 1") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo '<form action="../Controler/controleur_gestion_utilisateur.php" method="post">';
    echo'<select name="select_admin" id="select_admin">';
    while($tableau_resultadmin = mysqli_fetch_assoc($resultadmin)){
        echo'<option value="'.$tableau_resultadmin['id_utilisateur'].'">'.$tableau_resultadmin['mail'].'</option>'; 
    }
    echo '</select>';
    echo '<br>';
    echo '<br>';
    echo'<input type="submit" name="action" value="Retirer les droits" id="bouton_suppression_admin"/>';
    echo '</form>';
}

function suppression_droits($idutilisateur){
    global $connect;
    mysqli_query($connect, "update utilisateur set admin='0' where id_utilisateur = '$idutilisateur'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

?>  

