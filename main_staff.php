<?php 
	require_once( 'auth_staff.php' );
?>
<?php
require_once('./include/connect.php'); 
$update_success = 0;
if($_GET["menu"] == "Save")
{ 
$staff_id = $_SESSION['SESS_STAFF_ID'];

$sql2 = <<<SQL
	UPDATE std_info SET 
		staff_id='0'
	WHERE 
		staff_id = '$staff_id';			
SQL;
	
	//echo $sql."</br>";
	$result2 = mysqli_query($traindb,$sql2) or die(mysqli_error($traindb));		
	
	foreach($_POST["chkApprove"] as $key=>$val)
	{
//	echo ($key." ".($_POST["chkApprove"])[$key]." ".$val."</br>");	

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d-H-i-s');
		
$sql = <<<SQL
	UPDATE std_info SET 
		staff_id='$val'
	WHERE 
		std_id = '$key';			
SQL;
	
	//echo $sql."</br>";
	$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));	
	
}
	

$sql3 = <<<SQL
	UPDATE train_info AS train_info_tmp
    INNER JOIN std_info AS std_info_tmp ON std_info_tmp.std_id = train_info_tmp.std_id
	SET 
		train_info_tmp.staff_approve = 0,
		train_info_tmp.staff_comment = ''
	WHERE std_info_tmp.staff_id = '0';		
SQL;
	
	//echo $sql."</br>";
	$result3 = mysqli_query($traindb,$sql3) or die(mysqli_error($traindb));	
	
	$update_success = 1;
/*	


//echo (count($_POST["chkApprove"]));
	
	for($i=0;$i<count($_POST["chkApprove"]);$i++)
	{	
		if($_POST["chkApprove"][$i] != "")
		{	
			$sql = "UPDATE office_info SET approve='1' WHERE office_ID = '".$_POST["chkApprove"][$i]."'";	
		} 
		
		//echo $sql;
		$result = mysqli_query(traindb,$sql) or die(mysqli_error(traindb));	
		
	}
	$update_success = 1;
*/	
}
 	
?>	
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ระบบฝึกประสบการณ์วิชาชีพ V.1.0.0</title>

<!-- Bootstrap -->
<link href="css/bootstrap-4.2.1.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.2.1.js"></script>	
<script type="text/javascript">
$(function() {      
  $("#navbarDropdown").show();
  //$("#result").hide();
  $("#btn_reg_ok").hide();
	
  $("#search_name").keyup(function(e) {	
		
		//alert($("#form2 input[id=search_name]").val());
		
		$.ajax ({
			type: "POST", 
			url: "search_reg_office.php" , 
			cache: false, 
			data:  {
				   name:$("#frmMain input[id=search_name]").val()},
			success: function(data) {
				$("#approve_office_detail").html(data); 	
				//$("#result1").hide(); 
			}		
		});	
	  
   });		
	
});
	
function ClickCheckAll(vol)
	{ 
		//alert($("#frmMain input[id=hdnCount]").val());
		//alert(document.frmMain.hdnCount.value);
		var i=1;
		for(i=1;i<=document.frmMain.hdnCount.value;i++)
		{
			if(vol.checked == true)
			{
				eval("document.frmMain.chkApprove"+i+".checked=true");
			}
			else
			{
				eval("document.frmMain.chkApprove"+i+".checked=false");
			}
		}
	}
	
</script>
	
</head>

<body>
	
    <nav class="navbar navbar-expand-lg navbar-dark ">
		<a class="navbar-brand" href= "main_staff.php">ระบบฝึกประสบการณ์วิชาชีพ</a>
			
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
<!--						
             <li class="nav-item active">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
             </li>
-->

			 <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ยินดีต้อนรับ, <?php echo $_SESSION['SESS_STAFF_NAME']; ?></a>              
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="edt_staff_profile.php">ข้อมูลส่วนตัว</a>
					<a class="dropdown-item" href="edt_staff_passwd.php">เปลี่ยนรหัสผ่าน</a>									
                </div>
             </li>
			  
			 <li class="nav-item">
                <a class="nav-link" href="staff_select_std.php">บันทึกข้อมูลนักศึกษาฝึกงาน</a>
             </li>
			 
			 <li class="nav-item">
                <a class="nav-link" href="assessment_staff.php">แบบประเมิน</a>
             </li>

			 
			  
			 <li class="nav-item">
                <a class="nav-link" href="logout.php">ออกจากระบบ</a>
             </li>	
<!--			  
			 <li class="nav-item active">
                <a class="nav-link" href="office_manual_v2.pdf" target="_blank">คู่มือการใช้งานสำหรับ สำนักงาน<span class="sr-only">(current)</span></a>
             </li>
-->
<!--						
             <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
             </li>
-->
          </ul>
<!--				 
          <form class="form-inline my-2 my-lg-0">
             <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
-->
       </div>
    </nav>
	
    <hr>
    <h2 class="text-center">บันทึกข้อมูล นักศึกษาฝึกประสบการณ์วิชาชีพ</h2>	


<div class="container">
	
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result" >

	</div>
  </div>
	
  <div class="row" id="approve_office">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<form name="frmMain" id="frmMain" action="main_staff.php?menu=Save" method="post">
<!--			
	      <div class="row">
			<label for="search_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อนักศึกษา : </label>
          	<div class="col-md-4">
            	<input type="text" id="search_name" name="search_name" class="form-control" placeholder="ชื่อนักศึกษา" />
			  </br>
          	</div>
		  	<div class="col-md-4"><label style="color:red"></div>
          </div> 
-->			
	      <div class="row">
             <div class="col-md-12" id="approve_office_detail" name="approve_office_detail">

<?php
require_once('./include/connect.php'); 
$staff_id = $_SESSION['SESS_STAFF_ID'];
$office_id = $_SESSION['SESS_OFFICE_ID'];				 
$sql = "SELECT * FROM std_info WHERE approve='1' AND office_id=".$office_id." AND (staff_id=0 OR staff_id=".$staff_id.") ORDER BY staff_id DESC, std_id ASC";	
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));
	
?>
<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;">
	<tr align="center" bgcolor="powderblue">
	    <th align="center" width="5%">ลำดับที่</th>
		<th align="center" width="20%">รหัสประจำตัว</th>
		<th align="center" width="20%">คำนำหน้าชื่อ</th>
		<th align="center" width="25%">ชื่อ</th>
		<th align="center" width="25%">นามสกุล</th>
		<th align="center" width="5%">เลือก <!--</br><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);">--></th>
	</tr>
				 
<?php
$i = 0;
while($list = mysqli_fetch_array($result))
{
$i++;	
?>
	<tr align="right" valign="top">
	  <td  align="center"><?php echo $i;?></td>	
	 		
	  		  
		<?php
    		if ($list["staff_id"] == $staff_id) {
		?>
	  <td  align="center"><a href="sho_std_train.php?std_id=<?php echo $list["std_id"];?>&std_name=<?php echo $list["std_name"];?>&std_sname=<?php echo $list["std_sname"];?>"><?php echo $list["std_id"];?></a></td>
	  <td  align="left"><!--<a href="sho_std_train.php?std_id=<?php echo $list["std_id"];?>&std_name=<?php echo $list["std_name"];?>&std_sname=<?php echo $list["std_sname"];?>">--><?php echo $list["std_prefix"];?></a></td>
	  <td  align="left"><a href="sho_std_train.php?std_id=<?php echo $list["std_id"];?>&std_name=<?php echo $list["std_name"];?>&std_sname=<?php echo $list["std_sname"];?>"><?php echo $list["std_name"];?></a></td>
	  <td  align="left"><!--<a href="sho_std_train.php?std_id=<?php echo $list["std_id"];?>&std_name=<?php echo $list["std_name"];?>&std_sname=<?php echo $list["std_sname"];?>">--><?php echo $list["std_sname"];?></a></td>   <?php			
    			$status = "checked";
    		}else{
		?>
	  <td  align="center"><?php echo $list["std_id"];?></td>
	  <td  align="left"><?php echo $list["std_prefix"];?></td>
	  <td  align="left"><?php echo $list["std_name"];?></td>
	  <td  align="left"><?php echo $list["std_sname"];?></td> 		
		<?php
    			$status = "";
    		}
    	?>		  
		<td  align="center">  
		<input type="checkbox" name="chkApprove[<?php echo $list["std_id"];?>]" id="chkApprove<?php echo $i;?>" value="<?php echo $staff_id;?>" <?php echo $status;?>>
		
		</td>
	</tr>				
	
<?php			
//	$office_array[$i][1]=$list["office_id"];
//	$office_array[$i][2]=$list["approve"];
}
//	$_SESSION['SESS_APROVE_OFFICE'] = $office_array;
?>
</table>
			 		 				 
             </div>
          </div>
		<div class="row">
          <div class="col-md-12">
			</br>
            <p align="center">    
				<button type="submit" class="btn btn-primary btn-sm" id="btn_save" name="btn_save" value="Save"> บันทึก </button> 
				<input type="hidden" id="hdnCount" name="hdnCount" value="<?php echo $i;?>">
            </p>
          </div>
		</div>  
		
		 </form> 
	  </div>
	</div>	
</div>
	
  <hr>
  <!--<footer class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <p>Copyright © 2018 Green Office. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>	

<!-- Modal Dialog -->	
<div class="modal fade" id="modelSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">บันทึกข้อมูลสำเร็จ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<!--		
      <div class="modal-body">

      </div>
-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ตกลง</button>
      </div>
    </div>
  </div>
</div>
	
</body>
</html>
<?php
if ($update_success==1) {
?>
<script type="text/javascript">	
	$("#modelSave").modal('show');
//	$("#result").html(<?php echo (count($_POST["chkApprove"]));?>);
</script>
<?php
};
?>