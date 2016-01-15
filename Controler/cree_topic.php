<?php session_start();

 require 'fonction_sujet.php';

insert_sujet($_POST['sujet'], $_POST['message'],$_SESSION['id_utilisateur']);


header("Refresh:0 ,url=../Vue/forum.php");





