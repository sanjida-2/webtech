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
		<div class="row">
		<!--Event create form start-->
		<div class="col-md-4 div-style" style="margin-left:15px;">
			<form action="" method="POST"> 
				<center>
					<h3 class="">Event Create</h3>
				</center>
				<div class="form-group">
					<strong>Name</strong>
					<input type="text" name="events_name" class="form-control" required>
				</div>
				<div class="form-group">
					<strong>Location</strong>
					<input type="text" name="events_location" class="form-control" required>
				</div>
				<div class="form-group">
					<strong>Time</strong>
					<input type="text" name="events_time" class="form-control" required>
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
					<input type="number" name="events_titcket_price" class="form-control" required>
				</div>
				<div class="form-group">
					<strong>Contact Number</strong>
					<input type="number" name="events_contact_number" class="form-control" required>
				</div>
				<div class="form-group">
					<strong>Event Details</strong>
					<input type="text" name="events_details" class="form-control" required>
				</div>
				<button class="btn btn-primary">Create</button>
			</form>
		</div>
		<!--Event create form end-->
		
		<!--Event list form start-->
		<div class="col-md-7">
			<center>
				<h3 class="">Event List</h3>
		    </center>
			<table class="table table-hover table-striped">
				<tr>
					<th>Name</th>
					<th>Time</th>
					<th>Category</th>
					<th colspan='3'><center>Action</center></th>
				</tr>
				<?php
					$_sql_event_list = "SELECT e.events_id,e.events_name,e.events_location,e.events_time,e.events_titcket_price,
					e.events_contact_number,e.events_details,ec.event_category_name FROM events AS e INNER JOIN event_category as
					ec ON e.event_category_id = ec.event_category_id";
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
						$_events_details = $row['events_details'];
						?>
							<tr>
								<td><?php echo $_events_name;?></td>
								<td><?php echo $_events_time;?></td>
								<td><?php echo $_event_category_name;?></td>
								<td><button class="btn btn-sm btn-danger" onclick="EventDelete(<?php echo $_events_id;?>)" >Delete</button></td>
								<td><button class="btn btn-sm btn-info" onclick="EventEdit(<?php echo $_events_id;?>)" >&nbsp;Edit&nbsp; </button></td>
								<td><button class="btn btn-sm btn-warning" onclick="EventDetails(<?php echo $_events_id;?>)" >Details</button></td>
							
							</tr>
						<?php
					}
				?>
			</table>
			
		</div>
		<!--Event list form end-->
		</div>
	</div>
	<?php
		if(isset($_POST['events_name']) && !empty($_POST['events_name']))
		{
			$_events_name = $_POST['events_name'];
			$_events_location = $_POST['events_location'];
			$_events_time = $_POST['events_time'];
			$_event_category_id = $_POST['event_category_id'];
			$_events_titcket_price = $_POST['events_titcket_price'];
			$_events_contact_number = $_POST['events_contact_number'];
			$_events_details = $_POST['events_details'];
			
			$_sql_event = "INSERT INTO events (events_name,events_location,events_time,event_category_id,events_titcket_price,events_contact_number,events_details)
			VALUES ('$_events_name','$_events_location','$_events_time','$_event_category_id','$_events_titcket_price','$_events_contact_number','$_events_details')";
			$_config->db_con()->query($_sql_event);
		}
	?>
	<script>
		function EventDelete(events_id){
			var is_confirm = confirm("Data will be deleted permanently.");
			if(is_confirm == true){
				window.location.replace("delete-logic.php?events_id_delete="+events_id);
			}
		}
		function EventDetails(events_id){
			window.location.replace("event-details.php?events_id_details="+events_id);
		}
		function EventEdit(events_id){
			window.location.replace("event-edit-admin.php?events_id_edit="+events_id);
		}
	</script>
	<!-- footer js files -->
	<?php require_once("assets/library/footer-library.php");?>
  </body>
</html>