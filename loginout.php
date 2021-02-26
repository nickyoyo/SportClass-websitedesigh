<?php
session_start();
session_destroy();
$_SESSION['checkloginout']=0;
header("refresh:1;url=topic1.html");


?>
