<?php
	require("config.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login | Event Management</title>
    <!-- Bootstrap and head files -->
	<?php require("assets/library/header-library.php");?>
	<link rel="stylesheet" href="<?php echo $_config->css_path();?>/style.css">
  </head>
  <body>
    <div class="container">
		<!--Login form start-->
		<div class="col-md-4 div-style">
			<form action="" method="POST">
				<center>
					<img src="<?php echo $_config->image_path();?>/logo.png" height="100" width="100">
					<h3 class="">Login</h3>
				</center>
				<div class="form-group">
					<strong>Email</strong>
					<input type="text" name="input_email" class="form-control">
				</div>
				<div class="form-group">
					<strong>Password</strong>
					<input type="password" name="input_password" class="form-control">
				</div>
				<button class="btn btn-primary">Log in</button>
			</form>
		</div>
		<!--Login form start-->
	</div>
	
	<?php
		// Login logic
		if(isset($_POST['input_email']) && !empty($_POST['input_email']) && isset($_POST['input_password']) && !empty($_POST['input_password'])){
			$_input_email=$_POST['input_email'];
			$_input_password=$_POST['input_password'];
			
			$_sql = "SELECT * FROM accounts WHERE accounts_email='$_input_email' AND accounts_password='$_input_password'";
			$result = $_config->db_con()->query($_sql);
			
			if($result->num_rows>0){
				$_config->session_config();
				header("Location:home-admin.php");
			}
		}
	?>
	<!-- footer js files -->
	<?php require_once("assets/library/footer-library.php");?>
  </body>
</html>