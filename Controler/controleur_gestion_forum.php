<?php 
    require'model.php';
    if(isset($_POST["idtopic"]))
    {
        if($_POST["action"]=="supprimmer")
        {
            suppression_topic($_POST['idtopic']); 
        }
        else if($_POST["action"] == "Retirer le signalement"){
            suppression_signalement_topic($_POST['idtopic']);
        }
    }
    if(isset($_POST["idmessage"]))
    {
        if($_POST["action"]=="supprimmer")
        {
            suppression_message($_POST['idmessage']); 
        }
        else if($_POST["action"] == "Retirer le signalement"){
            suppression_signalement_message($_POST['idmessage']);
        }
    }
    
header('Location: ../Vue/gestion_forum.php');
    ?>
