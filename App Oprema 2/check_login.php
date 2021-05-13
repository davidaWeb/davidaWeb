<?php

function check_login($conn)
{
	if(isset($_SESSION['admin_id']))
	{
		$id = $_SESSION['admin_id'];
		$query = " SELECT * FROM admins WHERE admin_id = '$id' limit 1";
		$log_status = mysqli_query($conn, $query);
		
			if($log_status && mysqli_num_rows($log_status) > 0)
			{
				$admin_status = mysqli_fetch_assoc($log_status);
				return $admin_status;
			}
	}
//REDIRECT TO LOGIN PAGE
header("Location:login.php");
die;
}
