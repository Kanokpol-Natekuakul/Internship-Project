<?php
	require_once('./include/connect.php'); 

if (isset ($_REQUEST['district_id']) && $_REQUEST['district_id'] != "") { $district_id = $_REQUEST['district_id'] ; } else { $district_id = ""; }

  $sql = "SELECT * FROM zipcodes INNER JOIN districts ON zipcodes.DISTRICT_CODE = districts.DISTRICT_CODE WHERE districts.DISTRICT_ID = '".$district_id."'";
  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));

if(isset($_REQUEST['district_id']) && $_REQUEST['district_id']!=""){
  $row = mysqli_fetch_array($result);
  echo $row['zipcode'];
}
?>

