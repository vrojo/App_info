<?php 
    require'model.php';
    if(isset($_POST["id"]))
    {
        if($_POST["action"]=="supprimmer")
        {
            suppression_utilisateur($_POST['id']); 
        }
        else if($_POST["action"] == "Retirer le signalement"){
            suppression_signalement_utilisateur($_POST['id']);
        }
    }
    if (isset($_POST["mail"]))
        {
        update_utilisateur($_POST["mail"]);
        }

    header('Location: ../Vue/gestion_utilisateur.php');
    ?>
