<?php if (isset($_GET['t']) && $_GET['t']=='MesEvents'){
			$tout_evenement=mysqli_query($connect, 
			"select * from event 
			natural join multimedia 
			natural join adresse 
			natural join participation 
			where id_utilisateur=$id_utilisateur
			GROUP BY event.Event_id");
		$cacher=1;
		}
		elseif(isset($_GET['t']) && $_GET['t']=='Eventscrees'){
			$tout_evenement=mysqli_query($connect, 
			"SELECT * from event 
			inner join multimedia on event.Event_id = multimedia.Event_id
			inner join adresse on event.id_adresse=adresse.id_adresse
			WHERE id_utilisateur=$id_utilisateur
			GROUP BY event.Event_id");
		$cacher=1;
		}
		elseif(!isset($_POST['ville_evenement']) or !isset($_POST['departement_evenement']) or !isset($_POST['date_debut']) or !isset($_POST['date_fin'])){
				$_POST['ville_evenement']=$_POST['mot_clef'];
				$_POST['departement_evenement']=$_POST['mot_clef'];
				$_POST['date_debut']=$_POST['mot_clef'];
				$_POST['date_fin']=$_POST['mot_clef'];
				$tout_evenement=mysqli_query($connect, 
					"select * from event 
					natural join multimedia 
					natural join adresse 
					where Nom_e like '%".$_POST['mot_clef']."%' 
					or description_e like '%".$_POST['mot_clef']."%' 
					or ville like '".$_POST['mot_clef']."' 
					or codepostal like '".$_POST['mot_clef']."%'");

			$cacher=0;
			}
		else{
			$tout_evenement=mysqli_query($connect, 
		'select * from event 
		natural join multimedia 
		natural join adresse 
		where Nom_e like "%'.$_POST['mot_clef'].'%" 
		or description_e like "%'.$_POST['mot_clef'].'%" and ville like "'.$_POST['ville_evenement'].'" and codepostal like "'.$_POST['departement_evenement'].'%" and date_e between "'.$_POST['date_debut'].'" and "'.$_POST['date_fin'].'"');
		$cacher=0;
		}
?>