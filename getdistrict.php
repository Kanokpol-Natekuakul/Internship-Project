<?php
	require_once('./include/connect.php'); 

if (isset ($_REQUEST['amphur_id']) && $_REQUEST['amphur_id'] != "") { $amphur_id = $_REQUEST['amphur_id'] ; } else { $amphur_id = ""; }

  $sql = "SELECT * FROM districts WHERE AMPHUR_ID = '".$amphur_id."' ORDER BY DISTRICT_NAME ASC";
  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));

if(isset($_REQUEST['amphur_id']) && $_REQUEST['amphur_id']!=""){
 ?>
    <option value="">--เลือกตำบล--</option>
    <?php while($row = mysqli_fetch_array($result)){ ?>
    <option value="<?php echo $row['DISTRICT_ID'];?>"><?php echo $row['DISTRICT_NAME'];?></option>
    <?php } ?>
<?php }else{ ?>
    <option value="">--เลือกตำบล--</option>
<?php } ?>

