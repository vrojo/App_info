<?php
session_start();
// On redirige vers SImplevent.php
header("Refresh:0 ,url=../Vue/Simplevent.php");
// On détruit la session en cours
session_destroy();
exit()
?>