<?php

$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");



function affichage_categ_recherche_avancee(){
    global $connect;
    $result = mysqli_query($connect, "select * from categorie") or die("MsQL Erreur : ".mysqli_errno($connect));
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

function update_categ($nouveauNom, $nomcateg){
    global $connect;
    mysqli_query($connect, "update categorie set nomCat =$nouveauNom where nomCat=$nomcateg") or die("MySQL Erreur : " . mysqli_error($connect));
}

function verification_mdp($adrentre){
    global $connect;
    $result = mysqli_query($connect, "select mot_de_passe,id_utilisateur,admin from utilisateur where mail='$adrentre'") or die("MsQL Erreur : ".mysqli_errno($connect));
    $resultat = mysqli_fetch_assoc($result);
    return $resultat;   
}




function recherche_avancee (){
    global $connect;
    }



?>





        