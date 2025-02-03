<?php
	session_start();
  $SESS_STATUS_ID = $_SESSION['SESS_STATUS_ID'];
	session_unset();
	session_destroy();	
  if ($SESS_STATUS_ID == '1') {
	  header("location: login_auditor.php");
	}	
  elseif ($SESS_STATUS_ID == '9') {
	    header("location: login_system.php");
	  }	
    else {
	    header("location: index.php");
	  }
?>

