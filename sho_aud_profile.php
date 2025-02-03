<?php 
	require_once( 'auth_system.php' );
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
  $("#result").hide();
  $("#btn_reg_ok").hide();
  $("#btn_reg").hide();
  $("*", "#frm_auditor_info").prop('disabled',true);	
  $("#btn_back").prop('disabled',false);	
	
	$("#frm_auditor_info").on('submit',(function(e) {	
		e.preventDefault();
		//alert($("#frm_auditor_info select[id=district_id]").val());
	
				$.ajax ({
					type: "POST", 
					url: "exe_aud_profile.php", 
					cache: false, 
					async: false, 							
					data:  {
							auditor_id:$("#frm_auditor_info input[id=auditor_id]").val(),
							prefix: $("#frm_auditor_info input[name=prefix]:checked").val(),
							auditor_name:$("#frm_auditor_info input[id=auditor_name]").val(),
							auditor_sname:$("#frm_auditor_info input[id=auditor_sname]").val(),
							address:$("#frm_auditor_info input[id=address]").val(),
							province_id:$("#frm_auditor_info select[id=province_id]").val(),
							amphur_id:$("#frm_auditor_info select[id=amphur_id]").val(),
							district_id:$("#frm_auditor_info select[id=district_id]").val(),
							zipcode:$("#frm_auditor_info input[id=zipcode]").val(),				
							auditor_tel:$("#frm_auditor_info input[id=auditor_tel]").val(),
							auditor_email:$("#frm_auditor_info input[id=auditor_email]").val()									
								},
					success: function(data) {	

						if (data == 1) {																	
							$("#result").html("ปรับปรุงข้อมูลผู้ตรวจประเมินเรียบร้อย"); 
							$("#result").show();
							$("#btn_reg_ok").show();									
							$("#frm_auditor_info")[0].reset();	
							$("#register").hide();
						}	
						else {
							$("#result").show();	
							$("#result").html(data); 
						}

					}
				});
			
	}));	

	
  $("#province_id").change(function() {
		//alert($("#province_id").val());
		var province_id = $("#province_id").val();	
		//var selectVal = $('#chk_listl1_id :selected').text();
		$.ajax ({
			type: "POST", 
			url: "getamphure.php" , 
			cache: false, 
			data: {
						province_id:province_id
						},
			success: function(data) {
				$('#amphur_id').html(data);
				reset_district();
				$('#zipcode').val("");
			}
		});	
  });	

  $("#amphur_id").change(function() {
		//alert($("#form1 select[id=chk_listl1_id]").val());
		var amphur_id = $("#amphur_id").val();
		$.ajax ({
			type: "POST", 
			url: "getdistrict.php" , 
			cache: false, 
			data:  {
							 amphur_id:amphur_id
						 },
			success: function(data) {
				$('#district_id').html(data);
				$('#zipcode').val("");
						}	
		});	
  });	

  $("#district_id").change(function() {
		//alert($("#form1 select[id=chk_listl1_id]").val());
		//alert($("#district_id").val());
		var district_id = $("#district_id").val();
		$.ajax ({
			type: "POST", 
			url: "getzipcode.php" , 
			cache: false, 
			data:  {
							 district_id:district_id
						 },
			success: function(data) {
				$('#zipcode').val(data);
						}	
		});	
  });	
	
});
	
function reset_district() {
	var amphur_id = $("#amphur_id").val();
	$.ajax ({
		type: "POST", 
		url: "getdistrict.php" , 
		cache: false, 
		data:  {
						 amphur_id:amphur_id
					 },
		success: function(data) {
			$('#district_id').html(data);
					}	
	});	
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
    <h2 class="text-center">ข้อมูลผู้ตรวจประเมิน</h2>	


<div class="container">
	
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result">
		</div>
	</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="btn_reg_ok">
			<a href="main_auditor.php" class="btn btn-primary" role="button"> หน้าหลัก </a>
		</div>
	</div>
	
  <div class="row" id="register">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <form id="frm_auditor_info" action="" method="POST">
		  
	      <div class="row">
					<label for="auditor_id" class="col-md-4 col-form-label" style="text-align:right">เลขบัตรประชาชนผู้ตรวจประเมิน <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="number" id="auditor_id" name="auditor_id" class="form-control" placeholder="" value="<?php echo $_GET["auditor_id"]; ?>" disabled/>
          </div>
					<div class="col-md-4"> </div>
        </div> 
		  
	      <div class="row">		
			  <label for="prefix" class="col-md-4 col-form-label" style="text-align:right">คำนำหน้าชื่อ <label style="color:red">*</label> : </label>
			  <div class="col-md-4">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="prefix" id="prefix1" value="นาย"> นาย
			</br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="prefix" id="prefix2" value="นาง"> นาง	
			</br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="prefix" id="prefix3" value="นางสาว"> นางสาว
			  </div>
			<div class="col-md-4"> </div>
		  </div>
	  
	      <div class="row">
					<label for="auditor_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="auditor_name" name="auditor_name" class="form-control" required placeholder="ชื่อ" />
          </div>
					<div class="col-md-4"> </div>
        </div> 	

        <div class="row">
					<label for="auditor_sname" class="col-md-4 col-form-label" style="text-align:right">นามสกุล <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="auditor_sname" name="auditor_sname" class="form-control" required placeholder="นามสกุล" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
								
	    <div class="row">
					<label for="address" class="col-md-4 col-form-label" style="text-align:right">ที่อยู่ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="address" name="address" class="form-control" required placeholder="ที่อยู่" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
				
		<div class="row">
					<label for="province_id" class="col-md-4 col-form-label" style="text-align:right">จังหวัด <label style="color:red">*</label> : </label>
          <div class="col-md-4">
						<select class="form-control" id="province_id" name="province_id" required>
							<option value="">--เลือกจังหวัด--</option>
								<?php
									require_once('./include/connect.php');
									$sql = "SELECT * FROM `provinces` ORDER BY `PROVINCE_NAME` ASC";
									$res = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
									while ($row1 = mysqli_fetch_array($res)) {
										/*
											$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
											echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
										*/
										echo "<option value ='$row1[PROVINCE_ID]'>$row1[PROVINCE_NAME]</option>";
									}
								?>
						</select>
          </div>
					<div class="col-md-4"> </div>
        </div> 
				
		<div class="row">
					<label for="amphur_id" class="col-md-4 col-form-label" style="text-align:right">อำเภอ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
						<select class="form-control" id="amphur_id" name="amphur_id" required>
							<option value="">--เลือกอำเภอ--</option>
						</select>
          </div>
					<div class="col-md-4"> </div>
        </div> 

		<div class="row">
					<label for="district_id" class="col-md-4 col-form-label" style="text-align:right">ตำบล <label style="color:red">*</label> : </label>
          <div class="col-md-4">
						<select class="form-control" id="district_id" name="district_id" required>
							<option value="">--เลือกตำบล--</option>
						</select>
          </div>
					<div class="col-md-4"> </div>
        </div> 		

        <div class="row">
					<label for="zipcode" class="col-md-4 col-form-label" style="text-align:right">รหัสไปรษณีย์ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="zipcode" name="zipcode" class="form-control" required placeholder="รหัสไปรษณีย์" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

        <div class="row">
					<label for="auditor_tel" class="col-md-4 col-form-label" style="text-align:right">เบอร์โทรศัพท์ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="number" id="auditor_tel" name="auditor_tel" class="form-control" required placeholder="เบอร์โทรศัพท์" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
				
        <div class="row">
					<label for="auditor_email" class="col-md-4 col-form-label" style="text-align:right">E-Mail <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="email" id="auditor_email" name="auditor_email" class="form-control" required placeholder="E-Mail" />
          </div>
					<div class="col-md-4"> </div>
        </div> 


<!--	
		<div class="row">
			<div class="col-md-12">
			   </br>
		       <h3 class="text-center">ข้อมูลสำหรับเข้าสู่ระบบ</h3>	
			</div>
		</div>
        <div class="row">
					<label for="username" class="col-md-4 col-form-label" style="text-align:right">Username <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="username" name="username" class="form-control" required placeholder="Username" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

        <div class="row">
          <label for="password" class="col-md-4 col-form-label" style="text-align:right">Password <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
          </div>
					<div class="col-md-4"> </div>
				</div>

        <div class="row">
          <label for="conpassword" class="col-md-4 col-form-label" style="text-align:right">ยืนยัน Password <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="password" id="conpassword" name="conpassword" class="form-control" placeholder="ยืนยัน Password" />
          </div>
					<div class="col-md-4"> </div>
				</div>
-->
<!--				
        <div class="row">
          <div class="col-md-4"> </div>
          <div class="col-md-4">
				    <input name="remember" type="checkbox" value="Remember me" autocomplete="off" /> จำไว้ในระบบ
          </div>
          <div class="col-md-4"> </div>
				</div>
				<br/>
-->
				<div class="row">
          <div class="col-md-12">
            <p align="center">     
							<button type="submit" class="btn btn-primary btn-sm" id="btn_reg" value="Register"> บันทึก </button> 
<?php
  require_once('./include/connect.php');
  $auditor_id = $_GET["auditor_id"];
  $sql = "SELECT * FROM auditor WHERE auditor_id = '".$auditor_id."'";
  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));

	$row = mysqli_fetch_array($result);
	if ($row['approve'] == '1') {
?>
							<button type="button" class="btn btn-primary btn-sm" id="btn_back" value="Back" onclick="location.href='approve_reg_auditor_all.php';" > ย้อนกลับ </button> 				
<?php				
	} else {
?>				
							<button type="button" class="btn btn-primary btn-sm" id="btn_back" value="Back" onclick="location.href='approve_reg_auditor.php';" > ย้อนกลับ </button> 
<?php
	}
?>				
<!--						  
							<a href="http://devbanban.com/" class="btn btn-info btn-sm"> ลงทะเบียน </a>
-->
<?php
  require_once('./include/connect.php');
  $auditor_id = $_GET["auditor_id"];
  $sql = "SELECT * FROM auditor WHERE auditor_id = '".$auditor_id."'";
  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));

	$row = mysqli_fetch_array($result);
				
?>
				
							<script type="text/javascript">
									if("<?php echo $row['prefix']; ?>" == "นาย"){$("#frm_auditor_info input[id=prefix1]").prop('checked', true);}
									if("<?php echo $row['prefix']; ?>" == "นาง"){$("#frm_auditor_info input[id=prefix2]").prop('checked', true);}
									if("<?php echo $row['prefix']; ?>" == "นางสาว"){$("#frm_auditor_info input[id=prefix3]").prop('checked', true);}
									$("#frm_auditor_info input[id=auditor_name]").val('<?php echo $row['auditor_name']; ?>');
								    $("#frm_auditor_info input[id=auditor_sname]").val('<?php echo $row['auditor_sname']; ?>');
									$("#frm_auditor_info input[id=address]").val('<?php echo $row['address']; ?>');
									$("#frm_auditor_info select[id=province_id]").val('<?php echo $row['province_id']; ?>');
									$.ajax ({
									type: "POST", 
									url: "getamphure.php" , 
									cache: false, 
									data: {
												province_id:$("#province_id").val()
												},
									success: function(data) {
											$('#amphur_id').html(data);
											$("#frm_auditor_info select[id=amphur_id]").val('<?php echo $row['amphur_id']; ?>');

											$.ajax ({
												type: "POST", 
												url: "getdistrict.php" , 
												cache: false, 
												data:  {
																 amphur_id:$("#amphur_id").val()
															 },
												success: function(data) {
													$('#district_id').html(data);
													$("#frm_auditor_info select[id=district_id]").val('<?php echo $row['district_id']; ?>');
															}	
											});	

									}
									});		
								
									$("#frm_auditor_info input[id=zipcode]").val('<?php echo $row['zipcode']; ?>');
									$("#frm_auditor_info input[id=auditor_tel]").val('<?php echo $row['auditor_tel']; ?>');
									$("#frm_auditor_info input[id=auditor_email]").val('<?php echo $row['auditor_email']; ?>');

							</script>
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
<div class="modal fade" id="modelwarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">กรุณาตรวจสอบการกรอกข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ตกลง</button>
      </div>
    </div>
  </div>
</div>
	
</body>
</html>