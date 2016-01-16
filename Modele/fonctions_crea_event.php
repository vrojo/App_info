<?php

$connect = mysqli_connect('localhost', 'root', '', 'bddsimplevent');
if (!$connect) {
    printf('‰chec de la connexion : %s\n', mysqli_connect_error());
}

function insert_event($url_sponsor1,$url_sponsor2,$url_sponsor3,$url_sponsor4, $codepostal, $numerorue, $pays, $rue, $ville, $date_e, $date_f, $description_e, $heuredebut, $heurefin, $nb_max, $Nom_e, $privacy, $prix, $urlsite) {
    global $connect;
	/*sponsor/ adresse/ event/ multimedia / sponsorise/ typeevent*/
    $compteur=0;
	if ($url_sponsor1!='') {
		mysqli_query($connect, "insert into sponsor(img_sponsor) values ('$url_sponsor1')");
		$compteur=1;
		if ($url_sponsor2!='') {
			mysqli_query($connect, "insert into sponsor(img_sponsor) values ('$url_sponsor2')");
			$compteur=2;
			if ($url_sponsor3!='') {
				mysqli_query($connect, "insert into sponsor(img_sponsor) values ('$url_sponsor3')");
				$compteur=3;
				if ($url_sponsor4!='') {
					mysqli_query($connect, "insert into sponsor(img_sponsor) values ('$url_sponsor4')");
					$compteur=4;
				}
			}
		}
	}
	
	mysqli_query($connect, "insert into adresse(codepostal, numerorue, pays, rue, ville) values('$codepostal', '$numerorue', '$pays', '$rue', '$ville')");
	$id_adresse=mysqli_fetch_assoc(mysqli_query($connect, "select max(id_adresse) as max from adresse"));
        $idadresse = $id_adresse['max'];
        $idutilisateur = $_SESSION['id_utilisateur'];
	mysqli_query($connect, "insert into event(date_e, date_f, description_e, heuredebut, heurefin, id_adresse, id_utilisateur, nb_max_participant, Nom_e, privacy, prix) values('$date_e', '$date_f', '$description_e', '$heuredebut', '$heurefin', '$idadresse', '$idutilisateur', '$nb_max', '$Nom_e', '$privacy', '$prix')"); 
	$id_event = mysqli_fetch_assoc(mysqli_query($connect, "select max(Event_id) as max from event"));
        $idevent=$id_event['max'];
	
	if ($urlsite!="") {
            
                $idevent = $id_event['max'];
		mysqli_query($connect, "insert into multimedia(Event_id, principale, urlsite_event, principale) values ('$idevent', '$urlsite', 0)");
	}
	
	/*sponsor/ adresse/ event/ multimedia / sponsorise/ typeevent*/
	
	$i=0;
	while ($i!=$compteur) {
		$sponsor = mysqli_fetch_assoc(mysqli_query($connect, "select idSponsor from sponsor where idSponsor=(max(idSponsor)-$i)"));
                $sponsor = $sponsor['idSponsor'];
		mysqli_query($connect, "insert into sponsorise(Event_id, idSponsor) values ('$idevent', '$sponsor')");
		$i++;
	}
	require("../Modele/model.php");
        
	$result = affichage_categ_recherche_avancee();
    while($categorie = mysqli_fetch_assoc($result)) {
		if (isset($_POST[$categorie['nomCat']])) {
                    $nomcateg = $_POST[$categorie['nomCat']];
			mysqli_query($connect, "insert into typeevent(Event_id, id_categ) values ('$idevent', '$nomcateg')");
		}
    }
}
?>