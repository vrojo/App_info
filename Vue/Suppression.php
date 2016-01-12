<?php
session_start();
require '../Modele/model.php';
suppression_utilisateur($_SESSION['id_utilisateur']);
echo'<meta http-equiv="refresh" content="0 : URL=../Vue/Simplevent.php">';
?>
