<?php
require_once('auth_auditor.php');
require_once('./include/connect.php'); 

if (isset ($_REQUEST['datework']) && $_REQUEST['datework'] != "") { $datework = $_REQUEST['datework'] ; } else { $datework = ""; }
if (isset ($_REQUEST['auditor_approve']) && $_REQUEST['auditor_approve'] != "") { $auditor_approve = $_REQUEST['auditor_approve'] ; } else { $auditor_approve = ""; }
if (isset ($_REQUEST['auditor_comment']) && $_REQUEST['auditor_comment'] != "") { $auditor_comment = $_REQUEST['auditor_comment'] ; } else { $auditor_comment = ""; }
if (isset ($_REQUEST['std_id']) && $_REQUEST['std_id'] != "") { $std_id = $_REQUEST['std_id'] ; } else { $std_id = "";} 
$id = $_SESSION['SESS_AUDITOR_ID'];
$office_id = $_SESSION['SESS_OFFICE_ID'];

$sql = "";	

date_default_timezone_set("Asia/Bangkok");
$send_datetime=date('Y-m-d H:i:s');


//echo ($username ."-".$password ." : ");
/*
$chk_username = "SELECT * FROM `office_info` where `username` = '".$username."'";
$res_chk_username = mysqli_query($traindb,$chk_username) or die(mysqli_error($traindb));
$num_rows_username = mysqli_num_rows($res_chk_username); 

$chk_office_name = "SELECT * FROM `office_info` where `office_name` = '".$office_name."'";
$res_chk_office_name = mysqli_query($traindb,$chk_office_name) or die(mysqli_error($traindb));
$num_rows_office_name = mysqli_num_rows($res_chk_office_name); 
*/


//elseif ($num_rows_username != 0) {
//  echo "username นี้ถูกใช้แล้ว";
//}
//elseif (strlen($username) == 0){
//	echo "กรุณาใส่ Username";
//}


$sql = <<<SQL
	UPDATE train_info SET 
		auditor_comment='$auditor_comment',
		auditor_approve=$auditor_approve,
		staff_last_edit='$send_datetime'		
	WHERE
		std_id = '$std_id' AND info_date = '$datework'  ;				
SQL;


echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			


?>				
			
