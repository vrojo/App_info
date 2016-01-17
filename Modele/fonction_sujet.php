<?php
include 'model.php';
//Fonction pour insérer un sujet dans la base de données

function insert_sujet($sujet, $message, $id_utilisateur){
    global $connect;
    $sujete=htmlspecialchars (addslashes($sujet));
    $messagee=htmlspecialchars (addslashes($message));
    $req= "INSERT INTO sujet (sujet, text_s, id_utilisateur, date_s) values ('$sujete', '$messagee', '$id_utilisateur', NOW())";
    mysqli_query($connect, $req) or die("MySQL Erreur : " . mysqli_error($connect));
}
//Fonction pour insérer une réponse dans la table appropriée
function insert_reponse($sujete, $id_utilisateur){
    global $connect;
    $req2= "INSERT INTO rep_topic (id_topic, commentaire_r, id_utilisateur , date) values ('$sujete', 0, '$id_utilisateur', NOW() )";
    mysqli_query($connect, $req2) or die("MySQL Erreur : " . mysqli_error($connect));
}
