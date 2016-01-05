<?php
$connect = mysqli_connect('localhost', 'root', '', 'bddsimplevent');
if (!$connect) {
    printf('‰chec de la connexion : %s\n', mysqli_connect_error());
    exit();
}

function insert_event($Nom_e ,$lieu, $prix, $date_e, $heuredebut, $heurefin, $nb_max_participant, $description_e, $privacy, $session) {
    global $connect;
    $req1 ="  INSERT INTO event (Nom_e, lieu, prix, date_e, heuredebut, heurefin, nb_max_participant, description_e, privacy, id_utilisateur) values ('$Nom_e', '$lieu', '$prix', '$date_e', '$heuredebut', '$heurefin', '$nb_max_participant', '$description_e', '$privacy','$session')"; 
    //echo $req1;                                                                                                                                                                                 
    mysqli_query($connect, $req1) or die("MySQL Erreur : " . mysqli_error($connect));

//    mysqli_query($connect, "  INSERT INTO multimedia (urlimg_event, urlvid_event, urlsite_event, Event_id) values ('$urlimg_event', '$urlvid_event', '$urlsite_event', '$Event_id')") or die("MySQL Erreur : " . mysqli_error($connect));
}
?>