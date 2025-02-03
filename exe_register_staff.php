<?php
require_once('./include/connect.php'); 
								
if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { $office_id = $_REQUEST['office_id'] ; } else { $office_id = ""; }
if (isset ($_REQUEST['office_name']) && $_REQUEST['office_name'] != "") { $office_name = $_REQUEST['office_name'] ; } else { $office_name = ""; }
if (isset ($_REQUEST['lat_office']) && $_REQUEST['lat_office'] != "") { $lat_office = $_REQUEST['lat_office'] ; } else { $lat_office = ""; }
if (isset ($_REQUEST['lng_office']) && $_REQUEST['lng_office'] != "") { $lng_office = $_REQUEST['lng_office'] ; } else { $lng_office = ""; }
if (isset ($_REQUEST['staff_prefix']) && $_REQUEST['staff_prefix'] != "") { $staff_prefix = $_REQUEST['staff_prefix'] ; } else { $staff_prefix = ""; }
if (isset ($_REQUEST['staff_name']) && $_REQUEST['staff_name'] != "") { $staff_name = $_REQUEST['staff_name'] ; } else { $staff_name = ""; }
if (isset ($_REQUEST['staff_sname']) && $_REQUEST['staff_sname'] != "") { $staff_sname = $_REQUEST['staff_sname'] ; } else { $staff_sname = ""; }	
if (isset ($_REQUEST['staff_position']) && $_REQUEST['staff_position'] != "") { $staff_position = $_REQUEST['staff_position'] ; } else { $staff_position = ""; }	
if (isset ($_REQUEST['staff_mobile']) && $_REQUEST['staff_mobile'] != "") { $staff_mobile = $_REQUEST['staff_mobile'] ; } else { $staff_mobile = ""; }			
if (isset ($_REQUEST['staff_email']) && $_REQUEST['staff_email'] != "") { $staff_email = $_REQUEST['staff_email'] ; } else { $staff_email = ""; }			
if (isset ($_REQUEST['staff_username']) && $_REQUEST['staff_username'] != "") { $staff_username = $_REQUEST['staff_username'] ; } else { $staff_username = ""; }	
if (isset ($_REQUEST['staff_password']) && $_REQUEST['staff_password'] != "") { $staff_password = $_REQUEST['staff_password'] ; } else { $staff_password = ""; }
if (isset ($_REQUEST['staff_conpassword']) && $_REQUEST['staff_conpassword'] != "") { $staff_conpassword = $_REQUEST['staff_conpassword'] ; } else { $staff_conpassword = ""; }
if (isset ($_REQUEST['act']) && $_REQUEST['act'] != "") { $act = $_REQUEST['act'] ; } else { $act = ""; }

$sql = "";	

$staff_username = mysqli_real_escape_string($traindb,$staff_username) ;
$staff_password = mysqli_real_escape_string($traindb,$staff_password) ;
$staff_conpassword = mysqli_real_escape_string($traindb,$staff_conpassword) ;
//echo ($username ."-".$password ." : ");

$chk_username = "SELECT * FROM `staff_info` where `username` = '".$staff_username."'";
$res_chk_username = mysqli_query($traindb,$chk_username) or die(mysqli_error($traindb));
$num_rows_username = mysqli_num_rows($res_chk_username); 

//$chk_staff_id = "SELECT * FROM `staff_info` where `staff_id` = '".$staff_id."'";
//$res_chk_staff_id = mysqli_query($traindb,$chk_auditor_id) or die(mysqli_error($traindb));
//$num_rows_staff_id = mysqli_num_rows($res_chk_auditor_id); 

if ($staff_password != $staff_conpassword) {
	echo "กรุณายืนยันรหัสผ่านให้ตรงกัน";
}
elseif ($num_rows_username != 0) {
  echo "username นี้ถูกใช้แล้ว";
}
//elseif ($num_rows_auditor_id != 0) {
//  echo "เลขบัตรประจำตัวประชาชนนี้ใช้ลงทะเบียนแล้ว";
//}
else {	
	$staff_password = md5($staff_password);
	
$sql = <<<SQL
	INSERT INTO staff_info( 
		office_id,	
		office_name,
		lat_office,
		lng_office,
		staff_prefix,
		staff_name,
		staff_sname,
		staff_position,
		staff_mobile,
		staff_email,
		username,
		password,
		approve
		) VALUES (
		'$office_id',
		'$office_name',
		'$lat_office',
		'$lng_office',
		'$staff_prefix',
		'$staff_name',
		'$staff_sname',
		'$staff_position',
		'$staff_mobile',
		'$staff_email',		
		'$staff_username',
		'$staff_password',
		'0'
	);			
SQL;

//echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			
}
?>				
			
