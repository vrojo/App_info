<?php

$connect = mysqli_connect("localhost", "root", "", "bddsimplevent");
mysqli_set_charset($connect,"utf8");



function affichage_categ_recherche_avancee(){
    global $connect;
    $result = mysqli_query($connect, "select * from categorie order by nomCat") or die("MsQL Erreur : ".mysqli_errno($connect));
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

function update_categ($nouveauNom, $idcateg){
    global $connect;
    mysqli_query($connect, "update categorie set nomCat='$nouveauNom' where id_categ=".$idcateg) or die("MySQL Erreur : " . mysqli_error($connect));
}

function verification_mdp($adrentre){
    global $connect;
    $result = mysqli_query($connect, "select mot_de_passe,id_utilisateur,admin from utilisateur where mail='$adrentre'") or die("MsQL Erreur : ".mysqli_errno($connect));
    $resultat = mysqli_fetch_assoc($result);
    return $resultat;   
}




function modification_categorie(){
    $result = affichage_categ_recherche_avancee();
                $compteur = 1;
                
                
                if($compteur==1){
                    echo'<div class="nomcateg">';
                    while($categorie = mysqli_fetch_assoc($result)) {
                        echo '<div class="nom_de_categ">'.$categorie['nomCat'].'</div>';
                        }
                    echo'</div>';
                    
                    
                    $result = affichage_categ_recherche_avancee();
                    echo'<div class="zone_input_categ">';
                    
                    while($categorie = mysqli_fetch_assoc($result)) {                
                        
                        echo'<form action="gestion_categorie.php" method="post">';
                        echo'<input type="text" class="zone_modification_categ" placeholder="modification" name='.$categorie['nomCat'].'> ';
                        echo'<input type="submit" value="supprimer/modifier" class="bouton_suppression_categ" name='.$categorie['id_categ'].'>';
                        echo'</form>';
                    }
                    $compteur = 0;
                }
    }



?>


<?php function affichage_utilisateurs(){
    global $connect;
    $result = mysqli_query($connect, "select mail from utilisateur order by mail") or die("MsQL Erreur : ".mysqli_errno($connect));
    return $result;
}


        