


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <link type="text/css" rel="stylesheet" href="Header.css"/>
       <?php include ("Header.php"); ?>
        <?php
require 'fonctions_crea_event.php';
insert_event($_POST['Nom_e'], $_POST['lieu'], $_POST['prix'], $_POST['date_e'], $_POST['heuredebut'], $_POST['heurefin'], $_POST['nb_max_participant'], $_POST['description_e'], $_POST['privacy'],$_SESSION['id_utilisateur']);

?>
        <?php 
        header("Refresh:0, url = Accueil.php");
        exit();
        ?>
        
    </body>
</html>