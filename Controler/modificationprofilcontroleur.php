<?php
session_start();
require 'model.php';

$result = affichage_categ_recherche_avancee();
    while($categorie = mysqli_fetch_assoc($result)) {
        $nomCat = $categorie['nomCat']; 
        if(isset($_POST[$nomCat])){
            enregistrement_centreinterets($_SESSION['id_utilisateur'], $categorie['id_categ']);                            
        }
        
    }

if(isset($_POST['enregistrer']) and isset($_POST['nom_u']) and isset($_POST['prenom_u']) and isset($_POST['mail']) and isset($_POST['mot_de_passe']) and isset($_POST['confirmation_mdp']) and ($_POST['mot_de_passe']==$_POST['confirmation_mdp']) and isset($_POST['numero_adresse']) and isset($_POST['rue_adresse']) and isset($_POST['ville_adresse']) and isset($_POST['codepostal_adresse']) and isset($_POST['pays_adresse']) and isset($_POST['telephone']) and isset($_POST['date_de_naissance']) and isset($_POST['choixsexe']) and isset($_POST['description']) and isset($_POST['photo_u']) and !empty($_POST['nom_u']) and !empty($_POST['prenom_u']) and !empty($_POST['mail']) and !empty($_POST['mot_de_passe']) and !empty($_POST['confirmation_mdp']) and !empty($_POST['numero_adresse']) and !empty($_POST['rue_adresse']) and !empty($_POST['ville_adresse']) and !empty($_POST['codepostal_adresse']) and !empty($_POST['pays_adresse']) and !empty($_POST['telephone']) and !empty($_POST['date_de_naissance']) and !empty($_POST['description']) and empty($_POST['photo_u'])){
    if($_POST['choixsexe'] == "homme"){
        $sexe = 1;
    }
    else{
        $sexe = 0;
    }
    $url = "test";
    enregistrement_final($_SESSION['id_utilisateur'], $_POST['nom_u'], $_POST['prenom_u'], $_POST['mail'], $_POST['mot_de_passe'], $_POST['numero_adresse'], $_POST['rue_adresse'], $_POST['ville_adresse'], $_POST['codepostal_adresse'], $_POST['pays_adresse'], $_POST['telephone'], $_POST['date_de_naissance'], $_POST['description'], $url, $sexe);
    
    
    }

else if (isset($_POST['enregistrer']) and isset($_POST['nom_u']) and isset($_POST['prenom_u']) and isset($_POST['mail']) and isset($_POST['mot_de_passe']) and isset($_POST['confirmation_mdp']) and ($_POST['mot_de_passe']==$_POST['confirmation_mdp']) and isset($_POST['numero_adresse']) and isset($_POST['rue_adresse']) and isset($_POST['ville_adresse']) and isset($_POST['codepostal_adresse']) and isset($_POST['pays_adresse']) and isset($_POST['telephone']) and isset($_POST['date_de_naissance']) and isset($_POST['choixsexe']) and isset($_POST['description']) and isset($_POST['photo_u']) and !empty($_POST['nom_u']) and !empty($_POST['prenom_u']) and !empty($_POST['mail']) and !empty($_POST['mot_de_passe']) and !empty($_POST['confirmation_mdp']) and !empty($_POST['numero_adresse']) and !empty($_POST['rue_adresse']) and !empty($_POST['ville_adresse']) and !empty($_POST['codepostal_adresse']) and !empty($_POST['pays_adresse']) and !empty($_POST['telephone']) and !empty($_POST['date_de_naissance']) and !empty($_POST['description']) and !empty($_POST['photo_u'])){
    if($_POST['choixsexe'] == "homme"){
        $sexe = 1;
    }
    else{
        $sexe = 0;
    }    
     enregistrement_final($_SESSION['id_utilisateur'], $_POST['nom_u'], $_POST['prenom_u'], $_POST['mail'], $_POST['mot_de_passe'], $_POST['numero_adresse'], $_POST['rue_adresse'], $_POST['ville_adresse'], $_POST['codepostal_adresse'], $_POST['pays_adresse'], $_POST['telephone'], $_POST['date_de_naissance'], $_POST['description'], $_POST['photo_u'], $sexe);
}