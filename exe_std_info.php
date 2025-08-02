<?php
require_once('auth.php');
require_once('./include/connect.php'); 
		
if (isset ($_REQUEST['std_prefix']) && $_REQUEST['std_prefix'] != "") { $std_prefix = $_REQUEST['std_prefix'] ; } else { $std_prefix = ""; }			
if (isset ($_REQUEST['std_name']) && $_REQUEST['std_name'] != "") { $std_name = $_REQUEST['std_name'] ; } else { $std_name = ""; }	
if (isset ($_REQUEST['std_sname']) && $_REQUEST['std_sname'] != "") { $std_sname = $_REQUEST['std_sname'] ; } else { $std_sname = ""; }	
if (isset ($_REQUEST['std_group']) && $_REQUEST['std_group'] != "") { $std_group = $_REQUEST['std_group'] ; } else { $std_group = ""; }	
if (isset ($_REQUEST['std_mobile']) && $_REQUEST['std_mobile'] != "") { $std_mobile = $_REQUEST['std_mobile'] ; } else { $std_mobile = ""; }
if (isset ($_REQUEST['std_email']) && $_REQUEST['std_email'] != "") { $std_email = $_REQUEST['std_email'] ; } else { $std_email = ""; }
if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { $office_id = $_REQUEST['office_id'] ; } else { $office_id = ""; }
if (isset ($_REQUEST['lat_office']) && $_REQUEST['lat_office'] != "") { $lat_office = $_REQUEST['lat_office'] ; } else { $lat_office = ""; }
if (isset ($_REQUEST['lng_office']) && $_REQUEST['lng_office'] != "") { $lng_office = $_REQUEST['lng_office'] ; } else { $lng_office = ""; }		
$std_id = $_SESSION['SESS_STD_ID'];

$sql = "";	

$sql = <<<SQL
	UPDATE std_info SET
		std_prefix='$std_prefix',
		std_name='$std_name',
		std_sname='$std_sname',
		std_group='$std_group',
		std_mobile='$std_mobile',
		std_email='$std_email',	
		office_id='$office_id',
		lat_office='$lat_office',
		lng_office='$lng_office'
	WHERE
		std_id = '$std_id';				
SQL;

//echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			

?>				
			
