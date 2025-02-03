<?php
require_once('auth_staff.php');
require_once('./include/connect.php'); 

if (isset ($_REQUEST['curpassword']) && $_REQUEST['curpassword'] != "") { $curpassword = $_REQUEST['curpassword'] ; } else { $curpassword = ""; }
if (isset ($_REQUEST['password']) && $_REQUEST['password'] != "") { $password = $_REQUEST['password'] ; } else { $password = ""; }
if (isset ($_REQUEST['conpassword']) && $_REQUEST['conpassword'] != "") { $conpassword = $_REQUEST['conpassword'] ; } else { $conpassword = ""; }	
$staff_id = $_SESSION['SESS_STAFF_ID'];

$sql = "";	

//$username = mysqli_real_escape_string($traindb,$username) ;
$curpassword = mysqli_real_escape_string($traindb,$curpassword) ;
$password = mysqli_real_escape_string($traindb,$password) ;
$conpassword = mysqli_real_escape_string($traindb,$conpassword) ;
//echo ($username ."-".$password ." : ");
/*
$chk_username = "SELECT * FROM `office_info` where `username` = '".$username."'";
$res_chk_username = mysqli_query($traindb,$chk_username) or die(mysqli_error($traindb));
$num_rows_username = mysqli_num_rows($res_chk_username); 

$chk_office_name = "SELECT * FROM `office_info` where `office_name` = '".$office_name."'";
$res_chk_office_name = mysqli_query($traindb,$chk_office_name) or die(mysqli_error($traindb));
$num_rows_office_name = mysqli_num_rows($res_chk_office_name); 
*/

$chk_password = "SELECT * FROM `staff_info` WHERE `staff_id` = '".$staff_id."' AND `password` = '".md5($curpassword)."'";
$res_chk_password = mysqli_query($traindb,$chk_password) or die(mysqli_error($traindb));
$num_rows_password = mysqli_num_rows($res_chk_password); 

if ($password != $conpassword) {
	echo "กรุณายืนยันรหัสผ่านให้ตรงกัน";
}
//elseif ($num_rows_username != 0) {
//  echo "username นี้ถูกใช้แล้ว";
//}
//elseif (strlen($username) == 0){
//	echo "กรุณาใส่ Username";
//}
elseif ($num_rows_password == 0){
	echo "กรุณาใส่ Password ปัจจุบันให้ถูกต้อง";
}
else {	
	$password = md5($password);

$sql = <<<SQL
	UPDATE staff_info SET
		password='$password'
	WHERE
		staff_id = '$staff_id';				
SQL;

//echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			
}

?>				
			
