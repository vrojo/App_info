<?php 
$connect_e = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect_e,"utf8");

	
if (!$connect_e) {
    printf("Echec de la connexion : %s\n", mysqli_connect_error());
    exit();
}


function affichage_topics(){
    global $connect_e;
    $req=mysqli_query ($connect_e , "SELECT DISTINCT reponse.sujet , sujet.id_user FROM sujet INNER JOIN reponse WHERE sujet.sujet=reponse.sujet ") or die("MsQL Erreur : ".mysqli_errno($connect_e));
    
    while ($sujet=mysqli_fetch_assoc($req)){
        $r=mysqli_query($connect_e, "SELECT MAX(date) FROM reponse WHERE sujet=".$sujet['sujet']."");
        echo '<tr><td class="colonne_topics"><a href="#"><div id="Boutonphp">'.$sujet['sujet'].'</div></a></td><td class="colonne_messages"><div id="Boutonphp2">'.$sujet['id_user'].'</div></td><td class="colonne_dernier_message"><div id="Boutonphp"> dernier message le 2016-01-12 14:30:23</div></td></tr>';
        
        
        //echo '<tr><td class="colonne_topic" align="center">'.$sujet['sujet'].'</td><td class="colonne_dernier_message">'.$sujet['date'].'</td></tr>';
    }
}