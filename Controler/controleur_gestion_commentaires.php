<?php
        require'model.php';
        // On récupère l'id du commentaire signalé et on éxécute l'action décidée
        if(isset($_POST["idcom"])){
            if($_POST["action"]=="Supprimer")
            {
                suppression_commentaire($_POST['idcom']); 
            }
            else if($_POST["action"] == "Retirer le signalement"){
                suppression_signalement_commentaire($_POST['idcom']);
            }
        }
        header('Location: ../Vue/gestion_commentaires.php');
?>

      