<?php 
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect_e,"utf8");

	
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
}
//FOnction pour afficher les topics sur la page de forum
function affichage_topics(){
    global $connect_e;
	//On récupère tous les topics, et on les classe par date, du plus récent au plus ancien.
    $req= mysqli_query($connect_e, "SELECT * FROM sujet ORDER BY date_s DESC") OR  die("MsQL Erreur : ".mysqli_error($connect_e));
    $compteur = 1;
    
    if ($compteur==1){
        while ($sujet=mysqli_fetch_assoc($req)){
            $req2= mysqli_query($connect_e, "SELECT MAX(date) AS date FROM rep_topic WHERE id_topic='".$sujet['id_topic']."'");
            $req3= mysqli_query($connect_e, "SELECT COUNT(commentaire_r) AS com FROM rep_topic WHERE id_topic='".$sujet['id_topic']."'");
//          if (!$req2) {
//    printf("Error: %s\n", mysqli_error($connect_e));
//    exit();
//}
            //On récupère la date u dernier message du topic ainsi que son nombre de commentaires
            $tableaureq2=mysqli_fetch_assoc($req2);
            $tableaureq3=mysqli_fetch_assoc($req3);
			$sujet_topic=$sujet['id_topic'];
            echo '<tr>';
            echo '<td class="colonne_topics"><a href="../Vue/Topic.php?Topic='.$sujet_topic.'"><div id="Boutonphp">'.$sujet['sujet'].'</div></a></td>';
            echo '<td class="colonne_messages"><div id="Boutonphp2">'.$tableaureq3['com'].'</div></td>';
            echo '<td class="colonne_dernier_message"><div id="Boutonphp2">';
			if (empty($tableaureq2['date'])){
				echo 'dernier message le '.$sujet['date_s'].';</div></td>';
			}
			else{
				echo'dernier message le '.$tableaureq2['date'].'</div></td>';
			}
            echo '</tr>'; 
        }
        //Les données sont affichées dans un tableau.
        $compteur= 0 ;
    }
}