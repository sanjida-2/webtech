<?php
	require("config.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Sample | Event Management</title>
    <!-- Bootstrap and head files -->
	<?php require("assets/library/header-library.php");?>
	<link rel="stylesheet" href="<?php echo $_config->css_path();?>/style.css">
  </head>
  <body>
    <div  class="container">
		<?php require_once("navbar-admin.php");?>
		<?php
			$events_id=$_GET['events_id_edit'];
			$_sql_event_list = "SELECT e.events_id,e.events_name,e.events_location,e.events_time,e.events_titcket_price,
			e.events_contact_number,e.events_details,ec.event_category_name FROM events AS e INNER JOIN event_category as
			ec ON e.event_category_id = ec.event_category_id WHERE events_id='$events_id'";
			$result = $_config->db_con()->query($_sql_event_list);
			while($row = $result->fetch_assoc()){
				$_events_id = $row['events_id'];
				$_events_name = $row['events_name'];
				$_events_location = $row['events_location'];
				$_events_time = $row['events_time'];
				$_event_category_name = $row['event_category_name'];
				$_events_titcket_price = $row['events_titcket_price'];
				$_events_contact_number = $row['events_contact_number'];
				$_events_details = $row['events_details'];
			}
		?>
		<!--Event update form start-->
		<div class="col-md-12 div-style">
			<form action="" method="POST"> 
				<center>
					<h3 class="">Event Edit</h3>
				</center>
				<input type="hidden" name="events_id">
				<div class="form-group">
					<strong>Name</strong>
					<input type="text" name="events_name" class="form-control" value="<?php echo $_events_name;?>" required>
				</div>
				<div class="form-group">
					<strong>Location</strong>
					<input type="text" name="events_location" class="form-control" value="<?php echo $_events_location;?>" required>
				</div>
				<div class="form-group">
					<strong>Time</strong>
					<input type="text" name="events_time" class="form-control" value="<?php echo $_events_time;?>" required>
				</div>
				<div class="form-group">
					<strong>Event Category</strong>
					<select class="form-control" name="event_category_id" required> 
						<?php
							// Loading event categoty in droupdown list
							$_sql_event = "SELECT * FROM event_category";
							$result = $_config->db_con()->query($_sql_event);
							while($row = $result->fetch_assoc()){
								$event_category_id = $row['event_category_id'];
								$event_category_name = $row['event_category_name'];
								?>
									<option value='<?php echo $event_category_id;?>'><?php echo $event_category_name;?></option>
								<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<strong>Ticket Price</strong>
					<input type="number" name="events_titcket_price" class="form-control" value="<?php echo $_events_titcket_price;?>" required>
				</div>
				<div class="form-group">
					<strong>Contact Number</strong>
					<input type="number" name="events_contact_number" class="form-control" value="<?php echo $_events_contact_number;?>" required>
				</div>
				<div class="form-group">
					<strong>Event Details</strong>
					<input type="text" name="events_details" class="form-control" value="<?php echo $_events_details;?>" required>
				</div>
				<button class="btn btn-primary">Update</button>
				<a href="event-create-admin.php"><button class="btn btn-warning">Back</button></a>
			</form>
		</div>
		<!--Event update form end-->
	</div>
	
	<?php
		if(isset($_POST['events_name']) && !empty($_POST['events_name']))
		{
			//echo $_events_id = $_POST['events_id'];
			$_events_name = $_POST['events_name'];
			$_events_location = $_POST['events_location'];
			$_events_time = $_POST['events_time'];
			$_event_category_id = $_POST['event_category_id'];
			$_events_titcket_price = $_POST['events_titcket_price'];
			$_events_contact_number = $_POST['events_contact_number'];
			$_events_details = $_POST['events_details'];
			
			$_sql_event = "UPDATE events SET events_name='$_events_name',events_location='$_events_location',events_time='$_events_time',
			event_category_id='$_event_category_id',events_titcket_price='$_events_titcket_price',events_contact_number='$_events_contact_number',
			events_details='$_events_details' WHERE events_id=$_events_id";
			$_config->db_con()->query($_sql_event);
			header("Location:event-create-admin.php");
		}
	?>
	<!-- footer js files -->
	<?php require_once("assets/library/footer-library.php");?>
  </body>
</html>