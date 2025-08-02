<?php
require_once('./include/connect.php'); 

if (isset ($_REQUEST['std_term']) && $_REQUEST['std_term'] != "") { $std_term = $_REQUEST['std_term'] ; } else { $std_term = ""; }
if (isset ($_REQUEST['std_year']) && $_REQUEST['std_year'] != "") { $std_year = $_REQUEST['std_year'] ; } else { $std_year = ""; }
if (isset ($_REQUEST['std_id']) && $_REQUEST['std_id'] != "") { $std_id = $_REQUEST['std_id'] ; } else { $std_id = ""; }			
if (isset ($_REQUEST['std_prefix']) && $_REQUEST['std_prefix'] != "") { $std_prefix = $_REQUEST['std_prefix'] ; } else { $std_prefix = ""; }			
if (isset ($_REQUEST['std_name']) && $_REQUEST['std_name'] != "") { $std_name = $_REQUEST['std_name'] ; } else { $std_name = ""; }	
if (isset ($_REQUEST['std_sname']) && $_REQUEST['std_sname'] != "") { $std_sname = $_REQUEST['std_sname'] ; } else { $std_sname = ""; }	
if (isset ($_REQUEST['std_group']) && $_REQUEST['std_group'] != "") { $std_group = $_REQUEST['std_group'] ; } else { $std_group = ""; }	
if (isset ($_REQUEST['std_mobile']) && $_REQUEST['std_mobile'] != "") { $std_mobile = $_REQUEST['std_mobile'] ; } else { $std_mobile = ""; }
if (isset ($_REQUEST['std_email']) && $_REQUEST['std_email'] != "") { $std_email = $_REQUEST['std_email'] ; } else { $std_email = ""; }
if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { $office_id = $_REQUEST['office_id'] ; } else { $office_id = ""; }
if (isset ($_REQUEST['office_name']) && $_REQUEST['office_name'] != "") { $office_name = $_REQUEST['office_name'] ; } else { $office_name = ""; }
if (isset ($_REQUEST['lat_office']) && $_REQUEST['lat_office'] != "") { $lat_office = $_REQUEST['lat_office'] ; } else { $lat_office = ""; }
if (isset ($_REQUEST['lng_office']) && $_REQUEST['lng_office'] != "") { $lng_office = $_REQUEST['lng_office'] ; } else { $lng_office = ""; }
if (isset ($_REQUEST['username']) && $_REQUEST['username'] != "") { $username = $_REQUEST['username'] ; } else { $username = ""; }
if (isset ($_REQUEST['password']) && $_REQUEST['password'] != "") { $password = $_REQUEST['password'] ; } else { $password = ""; }
if (isset ($_REQUEST['conpassword']) && $_REQUEST['conpassword'] != "") { $conpassword = $_REQUEST['conpassword'] ; } else { $conpassword = ""; }
if (isset ($_REQUEST['act']) && $_REQUEST['act'] != "") { $act = $_REQUEST['act'] ; } else { $act = ""; }
	

$sql = "";	

$username = mysqli_real_escape_string($traindb,$username) ;
$password = mysqli_real_escape_string($traindb,$password) ;
$conpassword = mysqli_real_escape_string($traindb,$conpassword) ;
//echo ($username ."-".$password ." : ");

$chk_username = "SELECT * FROM `std_info` where `username` = '".$username."'";
$res_chk_username = mysqli_query($traindb,$chk_username) or die(mysqli_error($traindb));
$num_rows_username = mysqli_num_rows($res_chk_username); 

if ($password != $conpassword) {
	echo "กรุณายืนยันรหัสผ่านให้ตรงกัน";
}
elseif ($num_rows_username != 0) {
  echo "username นี้ถูกใช้แล้ว";
}
elseif (strlen($username) == 0){
	echo "กรุณาใส่ Username";
}
else {	
	$password = md5($password);

$sql = <<<SQL
	INSERT INTO std_info(
		std_term,
		std_year, 
		std_id,
		std_prefix,
		std_name,
		std_sname,
		std_group,
		std_mobile,
		std_email,
		office_id,
		office_name,	
		lat_office,
		lng_office,
		username,
		password,
		approve
		) VALUES (
		'$std_term',
		'$std_year',
		'$std_id',
		'$std_prefix',
		'$std_name',
		'$std_sname',
		'$std_group',
		'$std_mobile',
		'$std_email',
		'$office_id',
		'$office_name',
		'$lat_office',
		'$lng_office',
		'$username',
		'$password',
		'0'
	);			
SQL;

//echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			
}
?>				
			
