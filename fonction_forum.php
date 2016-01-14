<?php 
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect_e,"utf8");

	
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
}

function affichage_topics(){
    global $connect_e;
    $req= mysqli_query($connect_e, "SELECT DISTINCT sujet FROM sujet") OR  die("MsQL Erreur : ".mysqli_errno($connect_e));
    $compteur = 1;
    
    if ($compteur==1){
        while ($sujet=mysqli_fetch_assoc($req)){
            $req2= mysqli_query($connect_e, "SELECT MAX(date) AS date FROM reponse WHERE sujet='".$sujet['sujet']."'");
            $req3= mysqli_query($connect_e, "SELECT COUNT(commentaire_r) AS com FROM reponse WHERE sujet='".$sujet['sujet']."'");
//          if (!$req2) {
//    printf("Error: %s\n", mysqli_error($connect_e));
//    exit();
//}
            
            $tableaureq2=mysqli_fetch_assoc($req2);
            $tableaureq3=mysqli_fetch_assoc($req3);
            echo '<tr>';
            echo '<td class="colonne_topics"><a href="../Vue/Topic.php?sujet="'.$sujet['sujet'].'><div id="Boutonphp">'.$sujet['sujet'].'</div></a></td>';
            echo '<td class="colonne_messages"><div id="Boutonphp2">'.$tableaureq3['com'].'</div></td>';
            echo '<td class="colonne_dernier_message"><div id="Boutonphp2"> dernier message le '.$tableaureq2['date'].'</div></td>';
            echo '</tr>'; 
        }
        
        $compteur= 0 ;
    }
}


/*
function affichage_topics(){
    global $connect_e;
    $req=mysqli_query ($connect_e , "SELECT DISTINCT reponse.sujet , sujet.id_user FROM sujet INNER JOIN reponse WHERE sujet.sujet=reponse.sujet ") or die("MsQL Erreur : ".mysqli_errno($connect_e));
    
    while ($sujet=mysqli_fetch_assoc($req)){
        $r=mysqli_query($connect_e, "SELECT MAX(date) FROM reponse WHERE sujet=".$sujet['sujet']."");
        echo '<tr><td class="colonne_topics"><a href="#"><div id="Boutonphp">'.$sujet['sujet'].'</div></a></td><td class="colonne_messages"><div id="Boutonphp2">'.$sujet['id_user'].'</div></td><td class="colonne_dernier_message"><div id="Boutonphp"> dernier message le 2016-01-12 14:30:23</div></td></tr>';
        
        
        //echo '<tr><td class="colonne_topic" align="center">'.$sujet['sujet'].'</td><td class="colonne_dernier_message">'.$sujet['date'].'</td></tr>';
    }
}
 */