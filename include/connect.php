<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	
	$hostname = "localhost";
	$database = "train";
	$username = "root";
	$password = "123456789";
	$traindb = mysqli_connect($hostname, $username, $password, $database) or trigger_error('mysql_error'(),E_USER_ERROR); 
	if (!$traindb) {
		die('ไม่สามารถติดต่อฐานข้อมูลได้: ' . mysqli_connect_error());
	}
	
	//mysql_select_db($database);
	mysqli_query($traindb,"SET character_set_results=utf8");
	mysqli_query($traindb,"SET character_set_client=utf8");
	mysqli_query($traindb,"SET character_set_connection=utf8");
	mysqli_query($traindb,"collation_connection = utf8_unicode_ci");
	mysqli_query($traindb,"collation_database = utf8_unicode_ci");
	mysqli_query($traindb,"collation_server = utf8_unicode_ci");
	
?>