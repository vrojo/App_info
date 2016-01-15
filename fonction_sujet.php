<?php 
include '../Modele/model.php';
function insert_sujet($sujet, $message, $session){
    global $connect;
    $sujete=htmlspecialchars (addslashes($sujet));
    $messagee=htmlspecialchars (addslashes($message));
    $req= "INSERT INTO sujet (sujet, text_s, id_user) values ('$sujete', '$messagee', $_SESSION[id_utilisateur])";
    mysqli_query($connect, $req) or die("MySQL Erreur : " . mysqli_error($connect));
    
    $req2= "INSERT INTO reponse (sujet, commentaire_r, date) values ('$sujete', 0,NOW() )";
    mysqli_query($connect, $req2) or die("MySQL Erreur : " . mysqli_error($connect));
}
