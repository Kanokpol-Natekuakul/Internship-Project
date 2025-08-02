<?php
require_once('auth_staff.php');
require_once('./include/connect.php'); 
		
if (isset ($_REQUEST['staff_prefix']) && $_REQUEST['staff_prefix'] != "") { $staff_prefix = $_REQUEST['staff_prefix'] ; } else { $staff_prefix = ""; }			
if (isset ($_REQUEST['staff_name']) && $_REQUEST['staff_name'] != "") { $staff_name = $_REQUEST['staff_name'] ; } else { $staff_name = ""; }	
if (isset ($_REQUEST['staff_sname']) && $_REQUEST['staff_sname'] != "") { $staff_sname = $_REQUEST['staff_sname'] ; } else { $staff_sname = ""; }	
if (isset ($_REQUEST['staff_position']) && $_REQUEST['staff_position'] != "") { $staff_position = $_REQUEST['staff_position'] ; } else { $staff_position = ""; }	
if (isset ($_REQUEST['staff_mobile']) && $_REQUEST['staff_mobile'] != "") { $staff_mobile = $_REQUEST['staff_mobile'] ; } else { $staff_mobile = ""; }
if (isset ($_REQUEST['staff_email']) && $_REQUEST['staff_email'] != "") { $staff_email = $_REQUEST['staff_email'] ; } else { $staff_email = ""; }
if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { $office_id = $_REQUEST['office_id'] ; } else { $office_id = ""; }
if (isset ($_REQUEST['office_name']) && $_REQUEST['office_name'] != "") { $office_name = $_REQUEST['office_name'] ; } else { $office_name = ""; }
if (isset ($_REQUEST['lat_office']) && $_REQUEST['lat_office'] != "") { $lat_office = $_REQUEST['lat_office'] ; } else { $lat_office = ""; }
if (isset ($_REQUEST['lng_office']) && $_REQUEST['lng_office'] != "") { $lng_office = $_REQUEST['lng_office'] ; } else { $lng_office = ""; }		
$staff_id = $_SESSION['SESS_STAFF_ID'];

$sql = "";	

$sql = <<<SQL
	UPDATE staff_info SET
		staff_prefix='$staff_prefix',
		staff_name='$staff_name',
		staff_sname='$staff_sname',
		staff_position='$staff_position',
		office_id='$office_id',
		office_name='$office_name',
		staff_mobile='$staff_mobile',
		staff_email='$staff_email',	
		lat_office='$lat_office',
		lng_office='$lng_office'
	WHERE
		staff_id = '$staff_id';				
SQL;

//echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			

?>				
			
