<?php 
    require'model.php';
    if(isset($_POST["idevent"]))
    {
        if($_POST["action"]=="Supprimer")
        {
            suppression_event($_POST['idevent']); 
        }
        else if($_POST["action"] == "Retirer le signalement"){
            suppression_signalement_event($_POST['idevent']);
        }
    }

    header('Location: ../Vue/gestion_event.php');
    ?>
