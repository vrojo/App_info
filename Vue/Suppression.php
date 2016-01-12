<?php
session_start();
require '../Modele/model.php';
suppression_utilisateur($_SESSION['id_utilisateur']);
session_abort();
header ("Refresh: 0 ; URL=simplevent.php");
?>
