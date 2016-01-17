<?php
session_start();
include'Header.php';
include'model.php';


if (verifadmin($id_utilisateur) != 1){
    affichage_contenu_cgu();
}

else{
    affichage_mise_en_place_cgu();
    ?>
<form method="post" action="../Controler/controleur_cgu.php" id="form_cgu">
        Titre :<input type="text" name="titre_cgu" id="titre_cgu">
        <input type="submit" name="action" value="enregistrer" id="bouton_enregistrer">
    </form>    
        Paragraphe :<textarea name="paragraphe" form="form_cgu">Paragraphe de cgu :</textarea>
    <?php
}