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
		<div class="div-style" style="padding-left:10px;">
			<div>
				<center><h3>Event Details</h3></center>
			</div>
			<?php
				$events_id=$_GET['events_id_details'];
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
					?>
					<strong>Name: </strong><span><?php echo $_events_name;?></span>
					<br>
					<strong>Time: </strong><span><?php echo $_events_time;?></span>
					<br>
					<strong>Location: </strong><span><?php echo $_events_location;?></span>
					<br>
					<strong>Category: </strong><span><?php echo $_event_category_name;?></span>
					<br>
					<strong>Ticket Price: </strong><span><?php echo $_events_titcket_price;?> &nbsp;TK</span>
					<br>
					<strong>Contact: </strong><span><?php echo $_events_contact_number;?></span>
					<br>
					<strong>Details: </strong><span><?php echo $_events_details;?></span>
					<?php
				}
			?>
			<hr>
			<a href="event-create-admin.php"><button class="btn btn-primary">Back</button></a>
		</div>
	</div>
	
	<?php
		
	?>
	<!-- footer js files -->
	<?php require_once("assets/library/footer-library.php");?>
  </body>
</html>