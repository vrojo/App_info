<?php
session_start();
include'Header.php';
include'model.php';
?>
    <!DOCTYPE html>
<html>

    <head>
    
        <title>Modification du profil</title>
        <meta charset="utf-8">
        
    
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
        <label for id="titre_cgu">Titre :</label>
		<input type="text" name="titre_cgu" id="titre_cgu">
        <input type="submit" name="action" value="enregistrer" id="bouton_enregistrer">
        <br>
        <br>
        <br>
        <label style="vertical-align:top">Paragraphe :</label>
		<textarea name="paragraphe" form="form_cgu"></textarea>
    </form>    
    <?php
}
?>

        </div>
        <?php include'footer.php';?>