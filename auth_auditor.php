<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_AUDITOR_ID']) || (trim($_SESSION['SESS_AUDITOR_ID']) == '')) {
		header("location: login_auditor.php");
		exit();
	}
?>