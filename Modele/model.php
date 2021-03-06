
<?php

require'PHPMailerAutoload.php';

$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf-8");



function affichage_categ_recherche_avancee(){
    global $connect;
    $result = mysqli_query($connect, "select * from categorie order by nomCat") or die("MsQL Erreur : ".mysqli_errno($connect));
    return $result; //Selectionne les categorie d'event
}

function insert_categ($nomCat) {
    $nomCat = htmlspecialchars (addslashes($nomCat));
    global $connect;
    mysqli_query($connect, "insert into categorie (nomCat) values ('$nomCat')") or die("MySQL Erreur : " . mysqli_error($connect));
}//Ajoute une categorie d'event

function delete_categ($id_categ) {
    $id_categ = htmlspecialchars (addslashes($id_categ));
    global $connect;
    mysqli_query($connect, "delete from categorie where id_categ ='$id_categ'") or die("MySQL Erreur : " . mysqli_error($connect));
}//Supprime une cat�gorie d'event

function update_categ($nouveauNom, $idcateg){
    $nouveauNom = htmlspecialchars (addslashes($nouveauNom));
    $idcateg = htmlspecialchars (addslashes($idcateg)); 
    global $connect;
    mysqli_query($connect, "update categorie set nomCat='$nouveauNom' where id_categ=".$idcateg) or die("MySQL Erreur : " . mysqli_error($connect));
}//Modifie une categorie d'event

function verification_mdp($adrentre){
    $adrentre = htmlspecialchars (addslashes($adrentre));
    global $connect;
    $result = mysqli_query($connect, "select mot_de_passe,id_utilisateur,admin from utilisateur where mail='$adrentre'") or die("MsQL Erreur : ".mysqli_errno($connect));
    $resultat = mysqli_fetch_assoc($result);
    return $resultat;//Verif que le mot de passe est bien celui li� � l'adresse mail
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
                } //AFfiche les categories dans le backoffice gestion categ
    }






function affichage_utilisateurs(){
    global $connect;
    $result = mysqli_query($connect, "select mail from utilisateur order by mail") or die("MsQL Erreur : ".mysqli_errno($connect));
    return $result; //Affiche les utilisateur de la BDD
}


     

function inscriptionpreleminaire($mail, $mdp, $confinsc, $confmod){//Inscrit l'utilisateur depuis la page connexion/inscription
    $mail = htmlspecialchars (addslashes($mail));
    $mdp = htmlspecialchars (addslashes($mdp));
    global $connect;
    mysqli_query($connect, "insert into utilisateur (mail, mot_de_passe, confirmation_inscription, conf_mod_prof) values ('$mail', '$mdp', '$confinsc', '$confmod')") or die("MySQL Erreur : " . mysqli_error($connect));
    $result = mysqli_query($connect, "select id_utilisateur from utilisateur where mail='$mail'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult = mysqli_fetch_assoc($result);
    $id = $tableauResult['id_utilisateur'];
    $alea = rand(1,999999999); 
    $compteur = 0;
    
    while ($compteur == 0){
        $result = mysqli_query($connect, "select * from confirmation_inscription where id_conf = $alea");
        $row = mysqli_fetch_assoc($result);
        if($row == null){
            mysqli_query($connect, "insert into confirmation_inscription (id_conf,id_utilisateur) values ('$alea','$id')") or die("MySQL Erreur : " . mysqli_error($connect)); 
            $compteur = 1;
        }
    }
}//CReation d'un id_conf solide pour le lien d'activation du compte



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
    //Fonction qui v�rifie que l'utilisateur a bien valid� son compte, qu'il est actif sur le site.
}


function envoimail_confirmation($maildestinataire){ //Fonction qui initialise l'envoi d'un mail de confirmation d'inscription
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


function lien_inscription($mail){ //Fonction qui cr�e le lien d'activation de compte
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

function confirmation_inscription(){ //Fonction qui confirle l'inscription d'un utilisateur apr�s activation du lien
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

function verif_id($id, $idconf){//Fonction qui v�rifie que le lien de confirmation d'inscription n'ait pas �t� alt�r�
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

function verfifMailEx($mail){//Fonction qui v�rifie l'existance d'une adresse mail dans la base de donn�es
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

function affichage_centre_interet(){//Fonction qui affiche les categorie possible de centre interet pour un utilisateur sur la page modif profil
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
    //On enregistrera au fur et � mesure dans l'ordre les informations fourni par le client sur la page modifprofil
    mysqli_query($connect, "insert into adresse (numerorue, rue, ville, codepostal, pays) values ('$numrue','$rue','$ville','$codepostal','$pays')") or die("MySQL Erreur : " . mysqli_error($connect));  
    $idadresse = mysqli_query($connect, "select id_adresse from adresse where numerorue='$numrue' and rue ='$rue' and ville='$ville' and codepostal='$codepostal' and pays='$pays'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauidadresse = mysqli_fetch_assoc($idadresse);
    $idad = $tableauidadresse['id_adresse'];
    $confmod = 1;
    mysqli_query($connect, "update utilisateur set nom_u = '$nom', prenom_u = '$prenom', date_de_naissance = '$datenaissance', description = '$description', photo_u = '$photo', mail = '$mail', telephone = '$tel', mot_de_passe = '$mdp', sexe = '$sexe', id_adresse = '$idad', conf_mod_prof = '$confmod'  where id_utilisateur = '$id'") or die("MySQL Erreur : " . mysqli_errno($connect));
}

function enregistrement_centreinterets($idutilisateur, $idcateg){
    //Enregistreent des centre d'interet d'un utilisateur dans la base
    global $connect;
    mysqli_query($connect, "insert into preference (id_utilisateur, id_categ) values ('$idutilisateur','$idcateg')") or die("MySQL Erreur : " . mysqli_error($connect));      
}


function affichage_utilisateur_signales(){//Tableau du back office pour les utilisateur signal�s
    global $connect;
    $result = mysqli_query($connect, "SELECT utilisateur.id_utilisateur, nom_u, prenom_u, mail, id_balance FROM utilisateur INNER JOIN signaler ON utilisateur.id_utilisateur = signaler.id_utilisateur") or die("MsQL Erreur : ".mysqli_errno($connect));
        echo'<div class="titre_gestion_utilisateur">Utilisateurs signal�s par la communaut� :</div>';
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
                <input type="submit" name="action" value="Supprimer" id="bouton_suppression_utilisateur"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';

} 

function suppression_utilisateur($idutilisateur){//Fonction de suppression d'un utilisateur, beaucoup de requete dans un ordre pr�cis
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


function suppression_signalement_utilisateur($idutilisateur){//DEscativation d'un signalement dans le backoffice
    global $connect;
    mysqli_query($connect, "delete from signaler where id_utilisateur = $idutilisateur") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function update_utilisateur($mail){//Fonction pour donnner des droit � un utilisateur (back office)
    global $connect;
    $admin = 1;
    echo $mail;
    mysqli_query($connect, "update utilisateur set admin = $admin where mail = '$mail'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function select_categ($id, $categ){//Verifie l'existance d'une liaison entre utilisateur et categorie
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

function suppression_categ($id, $categ){//Supprime la preference d'un utilisateur pour une categorie
    global $connect;
    mysqli_query($connect, "delete from preference where id_utilisateur = '$id' and id_categ='$categ'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function remplissage_modifprofil($id){//Pour remplir le formulaire de modification du profil
    global $connect;
    $resultutilisateur = mysqli_query($connect, 'select * from utilisateur where id_utilisateur = '.$id) or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresultutilisateur = mysqli_fetch_assoc($resultutilisateur);
    return $tableauresultutilisateur;
}
function remplissage_modifprofil_adresse($id){//Pour remplir le formulaire au niveau des adresses
    global $connect;
    $resultutilisateur = mysqli_query($connect, 'select * from utilisateur where id_utilisateur = '.$id) or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresultutilisateur = mysqli_fetch_assoc($resultutilisateur);
    $resultadresse = mysqli_query($connect, 'select * from adresse where id_adresse = '.$tableauresultutilisateur['id_adresse']) or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresultadresse = mysqli_fetch_assoc($resultadresse);
    return $tableauresultadresse;
}


function modification_commentaires(){//Tableau du back office pour les commentaires signal�s
    global $connect;
    $commentaires_signales = mysqli_query($connect, "SELECT commente.id_commentaire, texte_co FROM commente INNER JOIN signaler ON signaler.id_commentaire = commente.id_commentaire") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo'<div class="titre_gestion_commentaires">Commentaires signal�s par la communaut� :</div>';
    echo'<br>';
    echo "<div id='tableau_commentaires_signales'>";
    echo "<table><thead><tr><th>D�tails du commentaire </th></thead>";
    while($tableau_commentaires_signales = mysqli_fetch_assoc($commentaires_signales)) {        
        echo "<tr>";
        echo '<td>'.$tableau_commentaires_signales['texte_co'].'</td>';
        echo '<td><form method="POST" action="../Controler/controleur_gestion_commentaires.php">
                <input type="hidden" value="'.$tableau_commentaires_signales['id_commentaire'].'" name="idcom">
                <input type="submit" name="action" value="Supprimer" id="bouton_suppression_commentaire"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';
}

function suppression_commentaire($id){//Fonction de suppression d'un commentaire
    global $connect;
    mysqli_query($connect, "delete from commente where id_commentaire = '$id'") or die("MsQL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from signaler where id_commentaire = '$id'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function suppression_signalement_commentaire($idcom){//Fonction de suppression du signalement d'un com
    global $connect;
    mysqli_query($connect, "delete from signaler where id_commentaire = $idcom") or die("MsQL Erreur : ".mysqli_errno($connect));
}


function affichage_event_signales(){//Tableau du back office pour les events signal�s
    global $connect;
    $event_signales = mysqli_query($connect, "SELECT event.Event_id, Nom_e FROM event INNER JOIN signaler ON signaler.Event_id = event.Event_id") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo'<div class="titre_gestion_event">Evénements signal�s par la communaut� :</div>';
    echo'<br>';
    echo "<div id='tableau_event_signales'>";
    echo "<table><thead><tr><th> Nom de l'�v�nement : </th></thead>";
    while($tableau_event_signales = mysqli_fetch_assoc($event_signales)) {        
        echo "<tr>";
        echo '<td><a href="Events.php?Event_id='.$tableau_event_signales['Event_id'].'">'.$tableau_event_signales['Nom_e'].'</a></td>';
        echo '<td><form method="POST" action="../Controler/controleur_gestion_event.php">
                <input type="hidden" value="'.$tableau_event_signales['Event_id'].'" name="idevent">
                <input type="submit" name="action" value="Supprimer" id="bouton_suppression_event"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';
}

function suppression_event($idevent){//Suppression d'un event
    global $connect;
    mysqli_query($connect, "delete from commente where Event_id = '$idevent'") or die("Ms1QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from multimedia where Event_id = '$idevent'") or die("Ms2QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from participation where Event_id = '$idevent'") or die("Ms3QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from sponsorise where Event_id = '$idevent'") or die("Ms4QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from typeevent where Event_id = '$idevent'") or die("Ms5QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from signaler where Event_id = '$idevent'") or die("Ms6QL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from event where Event_id = '$idevent'") or die("Ms7QL Erreur : ".mysqli_errno($connect));  
}

function suppression_signalement_event($idevent){//Suppression du signalement d'un event
    global $connect;
    mysqli_query($connect, "delete from signaler where Event_id = $idevent") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function liste_admin(){//Affiche une lise d'admin
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

function suppression_droits($idutilisateur){//REtire les droits d'un admin
    global $connect;
    mysqli_query($connect, "update utilisateur set admin='0' where id_utilisateur = '$idutilisateur'") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function modification_topic(){//Tableau du back office pour les topics signal�s
    global $connect;
    $topic_signales = mysqli_query($connect, "SELECT sujet.id_topic, sujet FROM sujet INNER JOIN signaler ON signaler.id_topic = sujet.id_topic") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo'<div class="titre_gestion_forum">Topics signal�s par la communaut� :</div>';
    echo'<br>';
    echo "<div id='tableau_topics_signales'>";
    echo "<table><thead><tr><th> Nom du topic : </th></thead>";
    while($tableau_topic_signales = mysqli_fetch_assoc($topic_signales)) {        
        echo "<tr>";
        echo '<td><a href="Topic.php?Topic='.$tableau_topic_signales['id_topic'].'">'.$tableau_topic_signales['sujet'].'</a></td>';
        echo '<td><form method="POST" action="../Controler/controleur_gestion_forum.php">
                <input type="hidden" value="'.$tableau_topic_signales['id_topic'].'" name="idtopic">
                <input type="submit" name="action" value="Supprimer" id="bouton_suppression_forum"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';
}

function modification_reponse(){
    global $connect;
    $message_signales = mysqli_query($connect, "SELECT rep_topic.id_msgforum, commentaire_r, rep_topic.id_topic FROM rep_topic INNER JOIN signaler ON signaler.id_msgforum = rep_topic.id_msgforum") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo'<div class="titre_gestion_forum">Messages des topics signal�s par la communaut� :</div>';
    echo'<br>';
    echo "<div id='tableau_messages_signales'>";
    echo "<table><thead><tr><th> Message du topic : </th></thead>";
    while($tableau_topic_signales = mysqli_fetch_assoc($message_signales)) {        
        echo "<tr>";
        echo '<td><a href="Topic.php?Topic='.$tableau_topic_signales['id_topic'].'">'.$tableau_topic_signales['commentaire_r'].'</a></td>';
        echo '<td><form method="POST" action="../Controler/controleur_gestion_forum.php">
                <input type="hidden" value="'.$tableau_topic_signales['id_msgforum'].'" name="idmessage">
                <input type="submit" name="action" value="Supprimer" id="bouton_suppression_forum"/>
                <input type="submit" name="action" value="Retirer le signalement" id="bouton_suppression_signalement"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';
}

function suppression_topic($idtopic){
    global $connect;
    mysqli_query($connect, "delete from rep_topic where id_topic = '$idtopic'") or die("MsQL Erreur : ".mysqli_errno($connect));
    mysqli_query($connect, "delete from sujet where id_topic = '$idtopic'") or die("MsQL Erreur : ".mysqli_errno($connect));

}
function suppression_message($idmessage){
    global $connect;
    mysqli_query($connect, "delete from sujetrep_topic where id_msgforum = '$idmessage'") or die("MsQL Erreur : ".mysqli_errno($connect));
}
function suppression_signalement_topic($idtopic){
    global $connect;
    mysqli_query($connect, "delete from signaler where id_topic = $idtopic") or die("MsQL Erreur : ".mysqli_errno($connect));
}
function suppression_signalement_message($idmessage){
    global $connect;
    mysqli_query($connect, "delete from signaler where id_msgforum = $idmessage") or die("MsQL Erreur : ".mysqli_errno($connect));
}

function affichage_choix_recherche(){
    global $connect;
    $result = mysqli_query($connect, "select * from categorie order by nomCat") or die("MsQL Erreur : ".mysqli_errno($connect));
    $compteur = 0;
    while($categorie = mysqli_fetch_assoc($result)) {
        if($compteur != 4){
            echo'<div class="checkrecherche"><input type="checkbox" value='.$categorie['id_categ'].'>'.$categorie['nomCat'].'</div>&nbsp; &nbsp; &nbsp;';                               
            $compteur = $compteur +1;
        }
        else{
            echo'<br> <br>';
            $compteur = 0;
        }
    }
}

function affichage_contenu_cgu(){
    global $connect;
    $result = mysqli_query($connect, "select * from cgu") or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableauresult = mysqli_fetch_assoc($result);
    if($tableauresult == null){
        echo'Cette page est vide pour le moment';
    }
    else{
        $compteur = 1;
        $cgu = mysqli_query($connect, "select * from cgu order by id_paragraphe") or die("MsQL Erreur : ".mysqli_errno($connect));
        while($affichage_cgu = mysqli_fetch_assoc($result)){
            echo'<h1>'.$compteur.' '.$affichage_cgu['titre_cgu'].'</h1>';
            echo'<br>';
            echo'<div class="paragraphe_cgu">'.$affichage_cgu['paragraphe_cgu'].'</div>';
            echo'<br>';
            echo'<br>';
            $compteur = $compteur + 1;
        }
    }
}

function affichage_mise_en_place_cgu(){
    global $connect;
    $result = mysqli_query($connect, "select * from cgu") or die("MsQL Erreur : ".mysqli_errno($connect));
    
    echo'<div class="titre_cgu"> Liste des paragraphes de CGU existants :</div>';
    echo'<br>';
    echo "<div id='tableau_cgu'>";
    echo "<table><thead><tr><th> Titre du pragraphe : </th></thead>";
    while($tableau_cgu = mysqli_fetch_assoc($result)) {        
        echo "<tr>";
        echo '<td>'.$tableau_cgu['titre_cgu'].'</td>';
        echo '<td><form method="POST" action="../Controler/controleur_cgu.php">
                <input type="hidden" value="'.$tableau_cgu['id_paragraphe'].'" name="idcgu">
                <input type="submit" name="action" value="Supprimer" id="bouton_suppression_cgu"/>
                <input type="submit" name="action" value="Editer" id="bouton_edition_cgu"/></form></td></tr>';
       

        }
    echo "</table>";
    echo "</div>";
    echo'<br>';
    echo'<br>';
    
}

function suppression_cgu($idcgu){
    global $connect;
    mysqli_query($connect, "delete from cgu where id_paragraphe = '$idcgu'") or die("MsQL Erreur : ".mysqli_errno($connect));
}
function edition_cgu($idcgu){
    global $connect;
    $result = mysqli_query($connect, "select * from cgu where id_paragraphe = $idcgu") or die("MsQL Erreur : ".mysqli_errno($connect));
    $tableau_cgu = mysqli_fetch_assoc($result);
  
    echo'<form method="post" action="controleur_cgu.php" id="form_edit_cgu">';
    echo'<input type="text" value = "'.$tableau_cgu['titre_cgu'].'" id = "titre_edit_cgu" name="titre_edit_cgu">';
    echo'<input type="submit" name="action" value="enregistrer" id="bouton_enregistrer_edit">';
    echo'<input type="hidden" name="idcgu" value="'.$tableau_cgu['id_paragraphe'].'">';
    echo'</form>';
    echo'<textarea name="edit_paragraphe" form="form_edit_cgu">'.$tableau_cgu['paragraphe_cgu'].'</textarea>';
}
function enreg_cgu($titre, $para){
    global $connect;
    mysqli_query($connect, "insert into cgu (titre_cgu, paragraphe_cgu) values ('$titre','$para')") or die("MySQL Erreur : " . mysqli_error($connect));      
}

function enreg_edit_cgu($titre, $para, $id){
    global $connect;
    mysqli_query($connect, "update cgu set titre_cgu = '$titre',paragraphe_cgu = '$para' where id_paragraphe = '$id'") or die("MySQL Erreur : " . mysqli_error($connect));      
}
?>  

