<?php if (isset($_GET['t']) && $_GET['t']=='MesEvents'){
			$tout_evenement=mysqli_query($connect, 
			"select * from event 
			natural join multimedia 
			natural join adresse 
			natural join participation 
			where (principale=1 and urlimg_event IS NOT NULL and id_utilisateur=$id_utilisateur)
			GROUP BY event.Event_id");
		$cacher=1;
		} //Selection des events lié à l'utilisateur connecté
		elseif(isset($_GET['t']) && $_GET['t']=='Eventscrees'){
			$tout_evenement=mysqli_query($connect, 
			"SELECT * from event 
			inner join multimedia on event.Event_id = multimedia.Event_id
			inner join adresse on event.id_adresse=adresse.id_adresse
			WHERE (principale=1 and urlimg_event IS NOT NULL and id_utilisateur=$id_utilisateur)
			GROUP BY event.Event_id");
		$cacher=1;
		}//Selection des events que l'utilisateur a créé
		elseif(isset($_GET['t']) && $_GET['t']=="Search"){
				$tout_evenement=mysqli_query($connect, 
					"select * from event 
					natural join multimedia 
					natural join adresse 
					where principale=1 and urlimg_event IS NOT NULL and (Nom_e like '%".$_POST['mot_clef']."%' 
					or description_e like '%".$_POST['mot_clef']."%' 
					or ville like '%".$_POST['mot_clef']."%' 
					or codepostal like '".$_POST['mot_clef']."%')
					");

			$cacher=0;//SElection par la recherche des mots clés en recherche simple
			}
		elseif (isset($_GET['t']) && $_GET['t']=="TousEvent"){
			$_POST['mot_clef']="";
			$_POST['ville_evenement']="%";
			$_POST['departement_evenement']="%";
			$_POST['date_debut']=date("Y-m-d");
			$_POST['date_fin']="8000-12-31";
			$tout_evenement=mysqli_query($connect, 
		'select * from event 
		natural join multimedia 
		natural join adresse 
		where (principale=1 and urlimg_event IS NOT NULL )');
		$cacher=0;
		}//Affichage de tous les events sans distinction
		else{
		$_POST['mot_clef']=htmlspecialchars(addslashes($_POST['mot_clef']));
		$_POST['ville_evenement']=htmlspecialchars(addslashes($_POST['ville_evenement']));
		$_POST['departement_evenement']=htmlspecialchars(addslashes($_POST['departement_evenement']));
		$tout_evenement=mysqli_query($connect, 
		'select * from event 
		natural join multimedia 
		natural join adresse 
		where (principale=1 and urlimg_event IS NOT NULL and Nom_e like "%'.$_POST['mot_clef'].'%" 
		or description_e like "%'.$_POST['mot_clef'].'%" 
		and ville like "'.$_POST['ville_evenement'].'" and codepostal like "'.$_POST['departement_evenement'].'%" and date_e between "'.$_POST['date_debut'].'" and "'.$_POST['date_fin'].'")');
		$cacher=0;
		}//Selection par la recherche avancée
		 
		$listeadresse=array("");
		// while($resultatadr = mysqli_fetch_assoc($tout_evenement)){
			 // $listeadresse[]=$resultatadr['numerorue']." ".$resultatadr['rue']." ".$resultatadr['ville']." ".$resultatadr['pays'];
		 // }
		// print_r($listeadresse);
		// $jsadresses=json_encode($listeadresse);
		?>