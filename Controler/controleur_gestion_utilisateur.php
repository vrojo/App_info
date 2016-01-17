<?php 
    require'model.php';
    if(isset($_POST["id"]))
    {
        if($_POST["action"]=="Supprimer")
        {
            suppression_utilisateur($_POST['id']); 
        }
        else if($_POST["action"] == "Retirer le signalement"){
            suppression_signalement_utilisateur($_POST['id']);
        }
    }
    
    if($_POST['action'] == "Retirer les droits"){
            suppression_droits($_POST["select_admin"]);
        }
        
    if (isset($_POST["mail"]))
        {
        update_utilisateur($_POST["mail"]);
        }
header('Location: ../Vue/gestion_utilisateur.php');
    ?>
