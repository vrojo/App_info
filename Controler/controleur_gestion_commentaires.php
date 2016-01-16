<?php
        require'model.php';
        
        if(isset($_POST["idcom"])){
            if($_POST["action"]=="supprimmer")
            {
                suppression_commentaire($_POST['idcom']); 
            }
            else if($_POST["action"] == "Retirer le signalement"){
                suppression_signalement_commentaire($_POST['idcom']);
            }
        }
        header('Location: ../Vue/gestion_commentaires.php');
?>

      