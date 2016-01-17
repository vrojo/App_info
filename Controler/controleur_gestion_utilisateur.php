<?php 
    require'model.php';
	 // On vérifie que la variable POST id existe
    if(isset($_POST["id"]))
    {	
// On fais des test sur l'action réalisée et on exécute la fonction associée
        if($_POST["action"]=="supprimmer")
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
