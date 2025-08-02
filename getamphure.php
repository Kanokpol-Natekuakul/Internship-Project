<?php
	require_once('./include/connect.php'); 

if (isset ($_REQUEST['province_id']) && $_REQUEST['province_id'] != "") { $province_id = $_REQUEST['province_id'] ; } else { $province_id = ""; }

  $sql = "SELECT * FROM amphures WHERE PROVINCE_ID = '".$province_id."' ORDER BY AMPHUR_NAME ASC";
  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));

if(isset($_REQUEST['province_id']) && $_REQUEST['province_id']!=""){
 ?>
    <option value="">--เลือกอำเภอ--</option>
    <?php while($row = mysqli_fetch_array($result)){ ?>
    <option value="<?php echo $row['AMPHUR_ID'];?>"><?php echo $row['AMPHUR_NAME'];?></option>
    <?php } ?>
<?php }else{ ?>
    <option value="">--เลือกอำเภอ--</option>
<?php } ?>

