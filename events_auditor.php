<?php
require_once('auth_auditor.php');
require_once('./include/connect.php'); 
if (isset ($_REQUEST['std_id']) && $_REQUEST['std_id'] != "") { $std_id = $_REQUEST['std_id'] ; } else { $std_id = "";} 

header("Content-type:application/json; charset=UTF-8");    
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
// โค้ดไฟล์ dbconnect.php ดูได้ที่ http://niik.in/que_2398_5642
// require_once("dbconnect.php");
$json_data = array();
 
$arr_color_demo = array(
    "1"=>"#ffd149",
    "2"=>"#fa42a2",
    "3"=>"#61c419",
    "4"=>"#ff8e25",
    "5"=>"#44c5ed",
    "6"=>"#ca5ec9",
    "7"=>"#ff0000"
);
 
$arr_events = array();

$id = $_SESSION['SESS_AUDITOR_ID'];
$office_id = $_SESSION['SESS_OFFICE_ID'];


$sql = "SELECT * FROM `train_info` INNER JOIN `std_info` ON train_info.std_id = std_info.std_id WHERE std_info.`std_id` = '".$std_id."' AND std_info.`auditor_id` = '".$id."'";								

$res_sql = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));
$num_rows_res = mysqli_num_rows($res_sql); 
$key = null;


if ($num_rows_res != 0) {
   while ($row = mysqli_fetch_array($res_sql)) {
	
   if(is_null($key)){
        $key = 0;
    }else{
        $key++;     
    }
	   
    if ($row['staff_approve'] != 1 && $row['auditor_approve'] != 1) {		   
        $json_data[$key] = array(
             "id" => $row['no'],
             "groupId" => date("Ymd", strtotime($row['info_date'])),
             "start" => date("Y-m-d", strtotime($row['info_date'])),
             "title" => "ตรวจข้อมูล",
             "url" => "javascript:editwork('{$row['no']}','{$row['info_date']}','{$row['work']}');",
             "textColor" => "#FFFFFF",
             "backgroundColor" => $arr_color_demo[5],  // Unapproved by both staff and auditor
             "borderColor" => "transparent",      
         ); 
     } elseif ($row['staff_approve'] == 1 && $row['auditor_approve'] != 1) {
        $json_data[$key] = array(
             "id" => $row['no'],
             "groupId" => date("Ymd", strtotime($row['info_date'])),
             "start" => date("Y-m-d", strtotime($row['info_date'])),
             "title" => "ตรวจข้อมูลโดย Staff แล้ว",
             "url" => "javascript:editwork('{$row['no']}','{$row['info_date']}','{$row['work']}');",
             "textColor" => "#FFFFFF",
             "backgroundColor" => $arr_color_demo[6],  // Approved by staff but not auditor
             "borderColor" => "transparent",      
         ); 	
     } elseif ($row['staff_approve'] == 1 && $row['auditor_approve'] == 1) {
        $json_data[$key] = array(
             "id" => $row['no'],
             "groupId" => date("Ymd", strtotime($row['info_date'])),
             "start" => date("Y-m-d", strtotime($row['info_date'])),
             "title" => "ตรวจข้อมูลโดย Auditor ",
             "url" => "javascript:editwork('{$row['no']}','{$row['info_date']}','{$row['work']}');",
             "textColor" => "#FFFFFF",
             "backgroundColor" => $arr_color_demo[7],  // Approved by both staff and auditor
             "borderColor" => "transparent",      
         ); 	
     }
   }
}
 
// แปลง array เป็นรูปแบบ json string  
if(isset($json_data)){  
    $json= json_encode($json_data);    
    if(isset($_GET['callback']) && $_GET['callback']!=""){    
    echo $_GET['callback']."(".$json.");";        
    }else{    
    echo $json;    
    }    
}
?>