<?php
        if(isset($_POST["idcom"])){
            if($_POST["action"]=="supprimer")
            {
                suppression_commentaire($_POST['idcom']); 
            }
        }
?>

      