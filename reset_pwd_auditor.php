<?php 
	require_once( 'auth_system.php' );
?>
<?php
require_once('./include/connect.php'); 
$update_success = 0;
if($_GET["menu"] == "Save")	
{ 
	$i=0;
	foreach($_SESSION['SESS_APROVE_AUDITOR'] as $key0=>$val0){
	    $found = '0';
		$i++;
		//echo ($key0."  ".$_SESSION['SESS_APROVE_AUDITOR'][$i][1]."  ".$_SESSION['SESS_APROVE_AUDITOR'][$i][2]."</br>");
		//echo ($i." ".$key." ".($_POST["chkApprove"])[$key]." ".$val."</br>");	
		
		foreach($_POST["chkApprove"] as $key=>$val) {
			//echo ($key."  ".$_SESSION['SESS_APROVE_AUDITOR'][$i][1]." ".$_SESSION['SESS_APROVE_AUDITOR'][$i][2]." ".$val."</br>");
			if (($_SESSION['SESS_APROVE_AUDITOR'][$i][1] == $key) && ($_SESSION['SESS_APROVE_AUDITOR'][$i][2] == $val)){
				$found = '1';
				break;
			}
		}
		
		if ($found == '0' ) {
			$update_auditor = $_SESSION['SESS_APROVE_AUDITOR'][$i][1];
$sql = <<<SQL
	UPDATE auditor SET 
		approve='0',
		approve_date= NULL
	WHERE 
		auditor_id = '$update_auditor';			
SQL;
	
	//echo $sql."</br>";
	$result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));	
	$update_success = 1;		
		}		
	}
		
/*	

//echo (count($_POST["chkApprove"]));	
	for($i=0;$i<count($_POST["chkApprove"]);$i++)
	{	
		if($_POST["chkApprove"][$i] != "")
		{	
			$sql = "UPDATE office_info SET approve='1' WHERE office_ID = '".$_POST["chkApprove"][$i]."'";	
		} 
		
		//echo $sql;
		$result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));	
		
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
<title>Green Office System V.2.0.0</title>

<!-- Bootstrap -->
<link href="css/bootstrap-4.2.1.css" rel="stylesheet">
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
			url: "search_reset_pwd_auditor.php" , 
			cache: false, 
			data:  {
				   name:$("#frmMain input[id=search_name]").val()},
			success: function(data) {
				$("#approve_auditor_detail").html(data); 	
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
       <a class="navbar-brand" href= "main_system.php">Green Office</a>
			
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
      <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ยินดีต้อนรับ, <?php echo $_SESSION['SESS_SYSTEM_NAME']; ?> </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
			<a class="dropdown-item" href="edt_sys_profile.php">ข้อมูลผู้ใช้งาน</a>
			<a class="dropdown-item" href="edt_sys_passwd.php">เปลี่ยนรหัสผ่าน</a> 
		</div>
      </li>
      <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ผู้ตรวจประเมิน </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
			<a class="dropdown-item" href="approve_reg_auditor.php">Approve ลงทะเบียน ผู้ตรวจประเมิน</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="approve_reg_auditor_all.php">รายชื่อผู้ตรวจประเมิน ที่ลงทะเบียนแล้ว</a> 
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="set_auditing_list.php">กำหนดสำนักงานเพื่อตรวจประเมิน</a> 
		  	<div class="dropdown-divider"></div>	
		 	<a class="dropdown-item" href="reset_pwd_auditor.php">Reset รหัสผ่าน ผู้ตรวจประเมิน ที่ลงทะเบียนแล้ว</a>			
		</div>
      </li>	
      <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">หน่วยงาน/บริษัท ที่เข้าโครงการ </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
		  	<a class="dropdown-item" href="approve_reg_office.php">Approve ลงทะเบียน หน่วยงาน/บริษัท</a>
		  	<a class="dropdown-item" href="approve_reg_greenoffice.php">Approve ใบสมัคร Green Office ปี <?php echo $_SESSION['SESS_YEAR']; ?></a>
		  	<div class="dropdown-divider"></div>
		  	<a class="dropdown-item" href="approve_reg_office_all.php">รายชื่อหน่วยงาน/บริษัท ที่ลงทะเบียนแล้ว</a>
		    <a class="dropdown-item" href="approve_reg_greenoffice_all.php">รายชื่อหน่วยงาน/บริษัท ที่ผ่านการสมัคร Green Office ปี <?php echo $_SESSION['SESS_YEAR']; ?>แล้ว</a> 
		  	<div class="dropdown-divider"></div>
		    <a class="dropdown-item" href="unreg_greenoffice.php">ยกเลิกการสมัคร Green Office ปี <?php echo $_SESSION['SESS_YEAR']; ?></a> 	
		 	<a class="dropdown-item" href="reset_pwd_office.php">Reset รหัสผ่าน หน่วยงาน/บริษัท ที่ลงทะเบียนแล้ว</a>
		</div>
      </li>			
      <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">รายงาน </a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
			<a class="dropdown-item" href="report_result_audit.php">รายงานผลการตรวจประเมิน</a> 
<!--			
			<a class="dropdown-item" href="report_evidence.php">รายงานข้อมูลการประเมินของหน่วยงาน/บริษัท</a>
-->
		</div>
      </li>
      <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ตั้งค่าระบบ </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown"> 
			<a class="dropdown-item" href="">กำหนดตัวชี้วัดประจำปี</a> 
			<a class="dropdown-item" href="">กำหนดปฏิทินการตรวจประเมินประจำปี</a> 
			<a class="dropdown-item" href="">จัดการข้อมูลผู้ใช้งานระบบ</a> 
		</div>
      </li>	
      <!--						
						 <li class="nav-item dropdown">
							  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">การตรวจประเมินสำนักงานสีเขียว
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a class="dropdown-item" href="audit.php">การตรวจประเมินโดยผู้ตรวจประเมิน</a>

								 
									 <a class="dropdown-item" href="index2.php">หมวดหลัก</a>
                   <a class="dropdown-item" href="index3.php">หมวดย่อย</a>
									 <a class="dropdown-item" href="index4_1.php">การกำหนดเกณฑ์คะแนน</a>
									 <a class="dropdown-item" href="index4.php">ตัวชี้วัด</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">Something else here</a>

                </div>
             </li>
-->
			 <li class="nav-item">
                <a class="nav-link" href="logout.php">ออกจากระบบ</a>
             </li>						
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
    <h2 class="text-center">Reset รหัสผ่าน ผู้ตรวจประเมิน ที่ลงทะเบียนแล้ว</h2>	


<div class="container">
	
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result" >

	</div>
  </div>
	
  <div class="row" id="approve_auditor">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<form name="frmMain" id="frmMain" action="approve_reg_auditor_all.php?menu=Save" method="post">
	      <div class="row">
			<label for="search_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อผู้ตรวจประเมิน : </label>
          	<div class="col-md-4">
            	<input type="text" id="search_name" name="search_name" class="form-control" placeholder="ชื่อผู้ตรวจประเมิน" />
			  </br>
          	</div>
		  	<div class="col-md-4"><label style="color:red"></div>
          </div> 
			
	      <div class="row">
             <div class="col-md-12" id="approve_auditor_detail" name="approve_auditor_detail">
<?php
require_once('./include/connect.php'); 

$sql = "SELECT * FROM auditor WHERE approve='1' ORDER BY approve, auditor_name, auditor_sname";	
$result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
	
?>
<table id="result1" name="result1" width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;">
	<tr align="center" bgcolor="powderblue">
	    <th align="center" width="10%">ลำดับที่</th>
		<th align="center" width="10%">Auditor ID</th>
		<th align="center" width="40%">ชื่อผู้ตรวจประเมิน</th>
		<th align="center" width="40%">นามสกุลผู้ตรวจประเมิน</th>
<!--		
		<th align="center" width="10%">Username</th>
-->
	</tr>
				 
<?php
$i = 0;
while($list = mysqli_fetch_array($result))
{
$i++;	
?>
	<tr align="right" valign="top">
	  <td  align="center"><?php echo $i;?></td>		
	  <td  align="center"><a href="exe_reset_pwd_auditor.php?auditor_id=<?php echo $list["auditor_id"];?>"><?php echo $list["auditor_id"];?></a></td>
	  <td  align="left"><a href="exe_reset_pwd_auditor.php?auditor_id=<?php echo $list["auditor_id"];?>"><?php echo $list["auditor_name"];?></a></td>	
	  <td  align="left"><a href="exe_reset_pwd_auditor.php?auditor_id=<?php echo $list["auditor_id"];?>"><?php echo $list["auditor_sname"];?></a></td>	
<!--		
	  <td  align="left"><?php echo $list["username"];?></td>
-->
	</tr>				
	
<?php
	$auditor_array[$i][1]=$list["auditor_id"];
	$auditor_array[$i][2]=$list["approve"];
}
	$_SESSION['SESS_APROVE_AUDITOR'] = $auditor_array;
?>
</table>
				 
             </div>
        </div>
			
		<div class="row">
          <div class="col-md-12">
			</br>
            <p align="center">    
<!--				
				<button type="submit" class="btn btn-primary btn-sm" id="btn_save" name="btn_save" value="Save"> บันทึก </button> 
				<input type="hidden" id="hdnCount" name="hdnCount" value="<?php echo $i;?>">
-->
            </p>
          </div>
		</div>  
		
		  </form>
	  </div>
	</div>	
</div>
	
  <hr>
  <footer class="text-center">
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