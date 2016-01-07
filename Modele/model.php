<?php
require '../reste/PHPMailerAutoload.php';

$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");



function affichage_categ_recherche_avancee(){
    global $connect;
    $result = mysqli_query($connect, "select * from categorie order by nomCat") or die("MsQL Erreur : ".mysqli_errno($connect));
    return $result;
}

function insert_categ($nomCat) {
    global $connect;
    mysqli_query($connect, "insert into categorie (nomCat) values ('$nomCat')") or die("MySQL Erreur : " . mysqli_error($connect));
}

function delete_categ($id_categ) {
    global $connect;
    mysqli_query($connect, "delete from categorie where id_categ ='$id_categ'") or die("MySQL Erreur : " . mysqli_error($connect));
}

function update_categ($nouveauNom, $idcateg){
    global $connect;
    mysqli_query($connect, "update categorie set nomCat='$nouveauNom' where id_categ=".$idcateg) or die("MySQL Erreur : " . mysqli_error($connect));
}

function verification_mdp($adrentre){
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
    global $connect;
    mysqli_query($connect, "insert into utilisateur (mail, mot_de_passe, confirmation_inscription, conf_mod_prof) values ('$mail', '$mdp', '$confinsc', '$confmod')") or die("MySQL Erreur : " . mysqli_error($connect));
    $result = mysqli_query($connect, "select id_utilisateur from utilisateur where mail='$mail'") or die("MySQL Erreur : " . mysqli_error($connect));
    $tableauResult = mysqli_fetch_assoc($result);
    $id = $tableauResult['id_utilisateur'];
    mysqli_query($connect, "insert into confirmation_inscription (id_utilisateur) values ('$id')") or die("MySQL Erreur : " . mysqli_error($connect));
}



function verif_confirmation($mail){
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
    $mail = new PHPMailer;
 
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'sitesimplevent@gmail.com';                   // SMTP username
    $mail->Password = 'LeSiteSimpleventVousAccueille';               // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
    $mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
    $mail->setFrom('sitesimplevent@gmail.com', 'Simplevent');     //Set who the message is to be sent from  //Set an alternative reply-to address
    $mail->addAddress($maildestinataire);  // Add a recipient
    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->isHTML(true);                                  // Set email format to HTML
    
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
