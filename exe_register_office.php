<?php
require_once('./include/connect.php'); 
								
//if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { $office_id = $_REQUEST['office_id'] ; } else { $office_id = ""; }
if (isset ($_REQUEST['office_name']) && $_REQUEST['office_name'] != "") { $office_name = $_REQUEST['office_name'] ; } else { $office_name = ""; }
if (isset ($_REQUEST['office_mobile']) && $_REQUEST['office_mobile'] != "") { $office_mobile = $_REQUEST['office_mobile'] ; } else { $office_mobile = ""; }			
if (isset ($_REQUEST['office_email']) && $_REQUEST['office_email'] != "") { $office_email = $_REQUEST['office_email'] ; } else { $office_email = ""; }	
if (isset ($_REQUEST['lat_office']) && $_REQUEST['lat_office'] != "") { $lat_office = $_REQUEST['lat_office'] ; } else { $lat_office = ""; }
if (isset ($_REQUEST['lng_office']) && $_REQUEST['lng_office'] != "") { $lng_office = $_REQUEST['lng_office'] ; } else { $lng_office = ""; }		
if (isset ($_REQUEST['office_conpassword']) && $_REQUEST['staff_conpassword'] != "") { $office_conpassword = $_REQUEST['office_conpassword'] ; } else { $office_conpassword = ""; }
if (isset ($_REQUEST['act']) && $_REQUEST['act'] != "") { $act = $_REQUEST['act'] ; } else { $act = ""; }

$sql = "";	




	
$sql = <<<SQL
	INSERT INTO office_info( 
		
        office_name,
        office_mobile,
		office_email,	
		lat_office,
		lng_office
		) VALUES (
		
        '$office_name',
        '$office_mobile',
		'$office_email',
		'$lat_office',
		'$lng_office'	
	);			
SQL;

//echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			

?>				
		
