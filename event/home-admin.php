<?php
	require("config.php");
	$session_data=$_config->session_config();
	echo $session_data['logedin'];
	if(!$session_data['logedin']){
		header("Location:login.php");
	}
	
?>
TEST