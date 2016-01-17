<?php 
    require'model.php';
    if(isset($_POST["idcgu"]))
    {
        if($_POST["action"]=="Supprimer")
        {
            suppression_cgu($_POST['idcgu']);
            header('Location: ../Vue/CGU.php');
        }
        else if($_POST["action"] == "Editer"){
            edition_cgu($_POST['idcgu']);
        }
    }
    if(isset($_POST['titre_cgu'])){
        enreg_cgu($_POST['titre_cgu'], $_POST['paragraphe']);
        header('Location: ../Vue/CGU.php');
    }
    
    if(isset($_POST['titre_edit_cgu'])){
        enreg_edit_cgu($_POST['titre_edit_cgu'], $_POST['edit_paragraphe'], $_POST['idcgu']);
        header('Location: ../Vue/CGU.php');
    }
    
    ?>
