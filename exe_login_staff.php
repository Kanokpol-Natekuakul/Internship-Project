<?php
	//Start session
	session_start();

	require_once('./include/connect.php'); 	
	if (isset ($_REQUEST['username']) && $_REQUEST['username'] != "") { $username = $_REQUEST['username'] ; } else { $username = ""; }
	if (isset ($_REQUEST['password']) && $_REQUEST['password'] != "") { $password = $_REQUEST['password'] ; } else { $password = ""; }
	if (isset ($_REQUEST['remember']) && $_REQUEST['remember'] != "") { $remember = $_REQUEST['remember'] ; } else { $remember = ""; }

	
	
	//Input Validations
	//if(($txtUsername == '') || ($txtPassword == '')) {
	//	header("location: index_loginf.php");
	//	exit();
	//}

$username = mysqli_real_escape_string($traindb,$username) ;
$password = mysqli_real_escape_string($traindb,$password) ;
//echo ($username . " - ". md5($password));

	$chk_username = "SELECT * FROM `staff_info` where `username` = '".$username."' and `password` = '".md5($password)."' and `approve` = '1'";
	
	$res_chk_username = mysqli_query($traindb,$chk_username) or die(mysqli_error($traindb));
	$num_rows_username = mysqli_num_rows($res_chk_username); 

//Check whether the query was successful or not
		
		if($num_rows_username == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_array($res_chk_username);
			
			//$_SESSION System
			$_SESSION['SESS_STATUS_ID'] = '0'; // 0 : Office
			$_SESSION['SESS_OFFICE_ID'] = $member['office_id'];
			$_SESSION['SESS_STAFF_ID'] = $member['staff_id'];
			$_SESSION['SESS_STAFF_NAME'] = $member['staff_name'];
			$_SESSION['SESS_MEMBER_USERNAME'] = $member['username'];
 		    $_SESSION['SESS_YEAR'] = gmdate('Y')+543;
//			$_SESSION['SESS_YEAR'] = '2563';
			$_SESSION['SESS_SEL_YEAR'] = '';
			$_SESSION['SESS_SEL_YEAR_PAST'] = '';
			
	
//			$chk_reg_green = "SELECT * FROM `reg_green` where `office_id` = '".$member['office_id']."' and `year` = '2563'";
/*			
			$chk_reg_green = "SELECT * FROM `reg_green` where `office_id` = '".$member['office_id']."' and `year` = '".(gmdate('Y')+543)."'";	
			$res_chk_reg_green = mysqli_query($traindb,$chk_reg_green) or die(mysqli_error($traindb));
			$num_rows_chk_reg_green = mysqli_num_rows($res_chk_reg_green); 			
			if($num_rows_chk_reg_green == 1)  {
					$reg_green = mysqli_fetch_array($res_chk_reg_green);		
					if ($reg_green['status'] == 1) {
						$_SESSION['SESS_APROVE_REG_GREEN'] = '1';
					} else {
						$_SESSION['SESS_APROVE_REG_GREEN'] = '0';
					}

					if ($reg_green['send'] == 1) {
						$_SESSION['SESS_SEND_REG_GREEN'] = '1';
					} else {
						$_SESSION['SESS_SEND_REG_GREEN'] = '0';
					}

					$_SESSION['SESS_TYPE_CER'] = $reg_green['type_cer'];


			} else {
					$_SESSION['SESS_APROVE_REG_GREEN'] = '0';
					$_SESSION['SESS_SEND_REG_GREEN'] = '0';
					$_SESSION['SESS_TYPE_CER'] = '0';
			}
*/
	
			if($remember == 'true') {
				setcookie ("member_login",$username,time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
			} else {
					if (isset($_COOKIE["member_login"])) {
						setcookie("member_login", "",time()- (10 * 365 * 24 * 60 * 60)-3600);
					}
					if (isset($_COOKIE["member_password"])) {
						setcookie("member_password", "",time()- (10 * 365 * 24 * 60 * 60)-3600);
					}
			
			}
			session_write_close();			
			//header("location: index_login.php");
			//echo ($num_rows_username);
			//exit();
		//}else {
			//Login failed
			//header("location: index_loginf.php");
			//echo (0);
			//exit();
		}

	echo $num_rows_username;			

?>				
			
