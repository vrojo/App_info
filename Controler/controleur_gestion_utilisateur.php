<?php 
    require'model.php';
    if(isset($_POST["id"]))
    {
        if($_POST["action"]=="supprimer")
        {
            suppression_utilisateur($_POST['id']); 
        }
        
    }
    if (isset($_POST["mail"]))
        {
        update_utilisateur($_POST["mail"]);
        }
    header('Location: ../Vue/gestion_utilisateur.php');
    ?>
