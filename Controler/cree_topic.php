<?php session_start();

require 'fonction_sujet.php';
// On insère le sujet dans la base de donnée grace aux variables POST fournies
insert_sujet($_POST['sujet'], $_POST['message'],$_SESSION['id_utilisateur']);


header("Refresh:0 ,url=../Vue/forum.php");





