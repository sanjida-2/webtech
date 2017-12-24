<?php
	require("config.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>New Account | Event Management</title>
    <!-- Bootstrap and head files -->
	<?php require_once("assets/library/header-library.php");?>
	<link rel="stylesheet" href="<?php echo $_config->css_path();?>/style.css">
  </head>
  <body>
    <div  class="container">
		<?php require_once("navbar-admin.php");?>
		<div class="row">
		<!--Account create form start-->
		<div class="col-md-4 div-style" style="margin-left:16px;">
			<form action="" method="POST"> 
				<center>
					<h3 class="">Account Create</h3>
				</center>
				<div class="form-group">
					<strong>Name</strong>
					<input type="text" name="accounts_name" class="form-control" required>
				</div>
				<div class="form-group">
					<strong>Email</strong>
					<input type="text" name="accounts_email" class="form-control" required>
				</div>
				<div class="form-group">
					<strong>Password</strong>
					<input type="password" name="accounts_password" class="form-control" required>
				</div>
				<div class="form-group">
					<strong>Role</strong>
					<select class="form-control" name="role_id" required> 
						<option value="1">Admin</option>
						<option value="2">Support</option>
					</select>
				</div>
				<button class="btn btn-primary">Create</button>
			</form>
		</div>
		<!--Account create form end-->
		<hr>
		
		<div class="col-md-7 div-style table-responsive" style="margin-right:16px;">
			<center>
					<h3 class="">Account List</h3>
			</center>
			<table class="table table-hover table-striped">
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
				<?php
					$_sql_account_list = "SELECT * FROM accounts";
					$result = $_config->db_con()->query($_sql_account_list);
					while($row = $result->fetch_assoc()) {
						$_accounts_id = $row['accounts_id'];
						$_accounts_name = $row['accounts_name'];
						$_accounts_email = $row['accounts_email'];
						$_role_id = $row['role_id'];
						if($_role_id==1){
							$role_name="Admin";
						}
						else{
							$role_name="Support";
						}
						?>
							<tr>
								<td><?php echo $_accounts_name;?></td>
								<td><?php echo $_accounts_email;?></td>
								<td><?php echo $role_name;?></td>
								<td><button class="btn btn-sm btn-danger" onclick="accountDelete(<?php echo $_accounts_id;?>)" >Delete</button></td>
							</tr>
						<?php
					}
				?>
			</table>
		</div>
		</div>
	</div>
	
	<?php
		// Account create logic here 
		if(isset($_POST['accounts_name']) && !empty($_POST['accounts_name']) && isset($_POST['accounts_email']) && !empty($_POST['accounts_email']) && 
		isset($_POST['accounts_password']) && !empty($_POST['accounts_password']) && isset($_POST['role_id']) && !empty($_POST['role_id']))
		{
			$_accounts_name = $_POST['accounts_name'];
			$_accounts_email = $_POST['accounts_email'];
			$_accounts_password = $_POST['accounts_password'];
			$_role_id = $_POST['role_id'];
			
			// Checking the email already used or not
			$_sql_unique_check = "SELECT * FROM accounts WHERE accounts_email='$_accounts_email'";
			$result = $_config->db_con()->query($_sql_unique_check);
			
			// if 0,Email not used 
			if($result->num_rows == 0){
				$_sql = "INSERT INTO accounts (accounts_name,accounts_email,accounts_password,role_id) VALUES ('$_accounts_name','$_accounts_email','$_accounts_password','$_role_id')";
				$_config->db_con()->query($_sql);
				//header("Location:home-admin.php");
			}
			else{
				echo "Email already used. Try another email";
			}
			
		}
		function Test(){
			
		}
	?>
	
	<script>
		function accountDelete(accounts_id){
			var is_confirm=confirm("Data will be deleted permanently.");
			if(is_confirm==true){
				window.location.replace("delete-logic.php?account_id_delete="+accounts_id);
			}
		}
	</script>
	<!-- footer js files -->
	<?php require_once("assets/library/footer-library.php");?>
  </body>
</html>