<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_STAFF_ID']) || (trim($_SESSION['SESS_STAFF_ID']) == '')) {
		header("location: login_staff.php");
		exit();
	}
?>