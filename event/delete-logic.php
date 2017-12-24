<?php
	require("config.php");
	if(isset($_GET['account_id_delete'])){
		$accountss_id=$_GET['account_id_delete'];
		$_sql="DELETE FROM accounts WHERE accounts_id='$accountss_id'";
		$_config->db_con()->query($_sql);
		header("Location:account-create-admin.php");
	}
	if(isset($_GET['events_id_delete'])){
		$events_id=$_GET['events_id_delete'];
		$_sql="DELETE FROM events WHERE events_id='$events_id'";
		$_config->db_con()->query($_sql);
		header("Location:event-create-admin.php");
	}
?>