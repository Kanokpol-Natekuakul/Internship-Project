<?php
require_once('auth.php');
require_once('./include/connect.php'); 

if (isset ($_REQUEST['datework']) && $_REQUEST['datework'] != "") { $datework = $_REQUEST['datework'] ; } else { $datework = ""; }
$std_id = $_SESSION['SESS_STD_ID'];
$office_id = $_SESSION['SESS_OFFICE_ID'];

$sql = "";	


//echo ($username ."-".$password ." : ");
/*
$chk_username = "SELECT * FROM `office_info` where `username` = '".$username."'";
$res_chk_username = mysqli_query($traindb,$chk_username) or die(mysqli_error($traindb));
$num_rows_username = mysqli_num_rows($res_chk_username); 

$chk_office_name = "SELECT * FROM `office_info` where `office_name` = '".$office_name."'";
$res_chk_office_name = mysqli_query($traindb,$chk_office_name) or die(mysqli_error($traindb));
$num_rows_office_name = mysqli_num_rows($res_chk_office_name); 
*/

$chk_datework = "SELECT * FROM `train_info` WHERE `std_id` = '".$std_id."' AND `office_id` = '".$office_id."' AND `info_date` = '" .$datework."'";
$res_chk_datework = mysqli_query($traindb,$chk_datework) or die(mysqli_error($traindb));
$num_rows_datework = mysqli_num_rows($res_chk_datework); 

//elseif ($num_rows_username != 0) {
//  echo "username นี้ถูกใช้แล้ว";
//}
//elseif (strlen($username) == 0){
//	echo "กรุณาใส่ Username";
//}
if ($num_rows_datework > 0 ){	
  echo (1);	
}
else {	
  echo (0);	
}		


?>				
			
