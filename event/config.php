<?php
	class config{
		function base_url(){
			return $_SERVER['HTTP_HOST']; 
		}
		function image_path(){
			return "assets/images";
		}
		function css_path(){
			return "assets/template/css";
		}
		function db_con(){
			$hostname = "localhost";
			$db_user="root";
			$db_password="";
			$db_name="event";
			// Create connection
			$conn = new mysqli($hostname, $db_user, $db_password, $db_name);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			return $conn;
		}
		function session_config(){
			session_start();
			$_SESSION['logedin']=true;
			return $_SESSION;
		}
	}
	$_config = new config();
	
?>