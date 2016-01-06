<?php
session_start();
header("Refresh:0 ,url=../Vue/Simplevent.php");
session_destroy();
exit()
?>