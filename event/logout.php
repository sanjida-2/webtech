<?php
    ob_start();
	session_start();
	session_destroy();
	ob_end_flush();
	header("Location:login.php");
?>