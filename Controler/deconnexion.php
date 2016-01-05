<?php
session_start();
header("Refresh:0 ,url=Simplevent.php");
session_destroy();
exit()
?>