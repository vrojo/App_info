<?php
session_start();
include'Header.php';
include'model.php';
?>
    <!DOCTYPE html>
<html>

    <head>
    
        <title>Modification du profil</title>
        
        
    
    </head>
    <link type="text/css" rel="stylesheet" href="../Style/CGU.css"/>
    <body>
        
        <div class="gestion_cgu">
<?php
if (verifadmin($id_utilisateur) != 1){
    affichage_contenu_cgu();
}

else{
    affichage_mise_en_place_cgu();
    ?>
<form method="post" action="../Controler/controleur_cgu.php" id="form_cgu">
        Titre :<input type="text" name="titre_cgu" id="titre_cgu">
        <input type="submit" name="action" value="enregistrer" id="bouton_enregistrer">
        <br>
        <br>
        <br>
        <label>Paragraphe :</label><textarea name="paragraphe" form="form_cgu"></textarea>
    </form>    
    <?php
}
?>

        </div>
        <?php include'footer.php';?>