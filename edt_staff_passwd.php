<?php 
	require_once('auth_staff.php');
    date_default_timezone_set('Asia/Bangkok');
	$date = date('Y-m-d H:i:s');	
  require_once('./include/connect.php'); 
/*
		$sql_chsch = "SELECT * FROM schedule WHERE year = '".$_SESSION['SESS_YEAR']."';";
        $result_chsch = mysqli_query($greenofficedb,$sql_chsch) or die(mysqli_error($greenofficedb));
		$row_chsch = mysqli_fetch_array($result_chsch);
		$st_selfass = $row_chsch['st_selfass'];
		$en_selfass = $row_chsch['en_selfass'];					
		$st_register = $row_chsch['st_register'];
		$en_register = $row_chsch['en_register'];	

		//$cur_date = "2020-08-22 00:00:00";
		//$cur_date = new DateTime("now");
		//$cur_date = date('Y-m-d H-i-s', time());	
		$cur_date = $date;
		if (($cur_date<$st_register) || ($cur_date>$en_register))  {		
			$time_register='0';
		} else {
			$time_register='1';
		}
*/
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
<!-- Include your custom CSS file -->
<link href="css/styles.css" rel="stylesheet">
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
	
	$("#frm_staff_passwd").on('submit',(function(e) {	
		e.preventDefault();
		//alert($("#frm_office_info select[id=district_id]").val());
		if ($("#frm_staff_passwd input[id=password]").val() != $("#frm_staff_passwd input[id=conpassword]").val()) {
			$("#modelwarning").find('.modal-body').text('กรุณากรอก ยืนยัน Password ให้ตรงกับ Password');
			$("#modelwarning").modal('show');	
			$("#conpassword").focus();
		} else 
		{
				$.ajax ({
					type: "POST", 
					url: "exe_staff_passwd.php", 
					cache: false, 
					async: false, 							
					data:  {
									curpassword:$("#frm_staff_passwd input[id=curpassword]").val(),
									password:$("#frm_staff_passwd input[id=password]").val(),
									conpassword:$("#frm_staff_passwd input[id=conpassword]").val()										
								},
					success: function(data) {	

						if (data == 1) {																	
							$("#result").html("เปลี่ยนรหัสผ่านเรียบร้อย"); 
							$("#result").show();
							$("#btn_reg_ok").show();									
							$("#frm_staff_passwd")[0].reset();	
							$("#register").hide();
						}	
						else {
							$("#result").show();	
							$("#result").html(data); 
						}

					}
				});
		}
	}));	
	
});

	
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
    <h2 class="text-center">ข้อมูลส่วนตัว : เปลี่ยนรหัสผ่าน</h2>	


<div class="container">
	
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result">
		</div>
	</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="btn_reg_ok">
			<a href="main_staff.php" class="btn btn-primary" role="button"> หน้าหลัก </a>
		</div>
	</div>
	
  <div class="row" id="register">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <form id="frm_staff_passwd" action="" method="POST">

<!--					
        <div class="row">
					<label for="username" class="col-md-4 col-form-label" style="text-align:right">Username <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="username" name="username" class="form-control" required placeholder="Username" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
-->
				<div class="row">
          <label for="password" class="col-md-4 col-form-label" style="text-align:right">Password ปัจจุบัน<label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="password" id="curpassword" name="curpassword" class="form-control" required placeholder="Password" />
          </div>
					<div class="col-md-4"> </div>
				</div>
				
        <div class="row">
          <label for="password" class="col-md-4 col-form-label" style="text-align:right">Password <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="password" id="password" name="password" class="form-control" required placeholder="Password" />
          </div>
					<div class="col-md-4"> </div>
				</div>

        <div class="row">
          <label for="conpassword" class="col-md-4 col-form-label" style="text-align:right">ยืนยัน Password <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="password" id="conpassword" name="conpassword" class="form-control" required placeholder="ยืนยัน Password" />
          </div>
					<div class="col-md-4"> </div>
				</div>

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
<!--						  
							<a href="http://devbanban.com/" class="btn btn-info btn-sm"> ลงทะเบียน </a>
-->
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
            <p>Copyright © 2022 ct.npru.ac.th. All rights reserved.</p>
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