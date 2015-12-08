<?php
$connect = mysqli_connect('localhost', 'root', '', 'bddsimplevent');
if (!$connect) {
    printf('‰chec de la connexion : %s\n', mysqli_connect_error());
    exit();
}

function insert_utilisateur($nom_u ,$prenom_u, $adresse, $mail, $telephone, $mot_de_passe, $date_de_naissance, $description, $photo_u) {
    global $connect;
    $req2=" INSERT INTO utilisateur (nom_u, prenom_u, adresse, mail, telephone, mot_de_passe, date_de_naissance, description, photo_u) values ('$nom_u', '$prenom_u', '$adresse', '$mail', '$telephone', '$mot_de_passe', '$date_de_naissance', '$description', '$photo_u')";
    //echo $req2;
    mysqli_query($connect, $req2) or die("MySQL Erreur : " . mysqli_error($connect));
}
?>