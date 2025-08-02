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
*/

		//$cur_date = "2020-08-22 00:00:00";
		//$cur_date = new DateTime("now");
		//$cur_date = date('Y-m-d H-i-s', time());
/*
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

<!-- Custom CSS -->
<link href="css/main.css" rel="stylesheet">
<!-- Fullcalendar -->	
<link href='fullcalendar-5/lib/main.css' rel='stylesheet' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.2.1.js"></script>	
<script src='fullcalendar-5/lib/main.js'></script>
<script type="text/javascript">	

$(function() {  
  var datework;
  $("#navbarDropdown").show();
	
  $("#btn_add_info").on("click", function(){
    	//callback(false);
		//alert(evidenceid);
    	$("#adddata").modal('hide');
		//var chk_listl3_id = $("#chk_listl3_id").val();
		//alert(datework);
	    //alert($("#frm_add_info textarea[name=work]").val());
		
		$.ajax({
			 url: "exe_work_info_staff.php",
			 type: "POST",
			 data:  {
							 datework:$("#frm_add_info input[id=dateadd]").val(),
				 			 staff_approve:$("#frm_add_info input[id=staff_approve]").is(":checked"),
				             staff_comment:$("#frm_add_info textarea[name=staff_comment]").val(),
				 			 std_id:<?php echo $_GET["std_id"];?>
							},
			 cache: false,
			 success: function(data)
					{
						if (data == 1) {																	
							//$("#result").html("ส่งข้อมูลสำหรับลงทะเบียนเรียบร้อย กรุณารอการอนุมัติจากผู้ดูแลระบบ ภายใน 24 ชั่วโมง"); 
							//$("#result").show();
							//$("#btn_reg_ok").show();									
							$("#frm_add_info")[0].reset();	
							//$("#register").hide();
							//location.reload();
						}	
						else {
							//$("#result").show();	
							//$("#result").html(data); 
						}	
						location.reload();
					}         
  	});	
		
  });	

          // กำหนด element ที่จะแสดงปฏิทิน
        var calendarEl = $("#calendar")[0];
 
          // กำหนดการตั้งค่า
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
			locale: 'th',
			firstDay: 0,
			eventLimit: true, // allow "more" link when too many events
			showNonCurrentDates: false, // แสดงที่ของเดือนอื่นหรือไม่
			dateClick: function(info) {
				datework = info.dateStr;
				$.ajax({
					 url: "chk_work_info_staff.php",
					 type: "POST",
					 data:  {
									 datework:datework,
						 			 std_id:<?php echo $_GET["std_id"];?>
									},
					 cache: false,
					 success: function(data)
							{
								if (data == 0) {
									$("#frm_add_info")[0].reset();	
									$("#frm_add_info input[id=dateadd]").val(info.dateStr);
									$("#adddata").modal('show');	
								} else {
									//$("#adddata").modal('show');	
								}
								
							}         
				});					
  		    },
			events: { // เรียกใช้งาน event จาก json ไฟล์ ที่สร้างด้วย php
              	url: 'events_staff.php?std_id=<?php echo $_GET["std_id"];?>',
              	error: function() {
              	}
            },
			eventTimeFormat: { // รูปแบบการแสดงของเวลา เช่น '14:30' 
           		hour: '2-digit',
				minute: '2-digit',
           		meridiem: false
       		}
        });
          
         // แสดงปฏิทิน 
        calendar.render();  
           
	
	
});
	
function editwork(id,info_date,work) {	
	//alert(id);
	//alert(info_date);
	
  $.ajax({
			 url: "get_work_info_staff.php",
			 type: "POST",
			 data:  {
							 datework:info_date,
				 			 std_id:<?php echo $_GET["std_id"];?>
							},
			 cache: false,
			 success: function(data)
					{
						data = jQuery.parseJSON(data);
						if (data[0].chk == 1) {			
							$("#frm_add_info input[id=dateadd]").val(info_date);
							$("#frm_add_info textarea[name=work]").val(data[0].work);	
							if(data[0].staff_approve==1){ $("#frm_add_info input[id=staff_approve]").prop('checked',true);}else{$("#frm_add_info input[id=staff_approve]").prop('checked', false);};
							$("#frm_add_info textarea[name=staff_comment]").val(data[0].staff_comment);								
							$("#adddata").modal('show');
						}	
						else {
							//$("#result").show();	
							//$("#result").html(data); 
						}

						if (data[0].chk == 1) {			
							$("#frm_add_info input[id=dateadd]").val(info_date);
							$("#frm_add_info textarea[name=work]").val(data[0].work);	
							if(data[0].auditor_approve==1){ $("#frm_add_info input[id=auditor_approve]").prop('checked',true);}else{$("#frm_add_info input[id=auditor_approve]").prop('checked', false);};
							$("#frm_add_info textarea[name=auditor_comment]").val(data[0].auditor_comment);								
							$("#adddata").modal('show');
						}	
						else {
							//$("#result").show();	
							//$("#result").html(data); 
						}		
					}         
  	});	
	
		
}
</script>
	
</head>

<body>
	
	  <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result">
		</div>
	</div>
	
    <nav class="navbar navbar-expand-lg navbar-dark ">
       <a class="navbar-brand" href= "main_auditor.php">ระบบฝึกประสบการณ์วิชาชีพ</a>
			
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
    <h2 class="text-center">ระบบฝึกประสบการณ์วิชาชีพ</h2>	

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    </div>
  </div>
</div>	
	
    <hr>
	
    <div class="container">
      <div class="row text-center">
<!--				
        <div class="col-md-3 pb-1 pb-md-0">
          <div class="card">
            <img class="card-img-top" src="images/400X200.gif" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">News.</h5>
              <p class="card-text">
								Details.
							</p>
              <a href="#" class="btn btn-primary">More info.</a>
            </div>
          </div>
        </div>
-->
        <div class="col-md-12 pb-1 pb-md-0">
          <div class="card">
            <div class="card-body">
				<h5 class="card-title">บันทึกข้อมูลการฝึกประสบการณ์วิชาชีพ </br><?php echo $_GET["std_name"];?> <?php echo $_GET["std_sname"];?></h5>		
            </div>
          </div>
        </div>

        <div class="col-md-12 pb-1 pb-md-0">
          <div class="card">
            <div class="card-body">
              <div id='calendar'></div>					
            </div>
          </div>
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
<div class="modal fade" id="adddata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">บันทึกข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  
		<form id="frm_add_info" action="" method="POST">  
			<div class="row">
						<label for="dateadd" class="col-md-5 col-form-label" style="text-align:right">วันที่ <label style="color:red">*</label> : </label>
			  <div class="col-md-7">
				<input type="text" id="dateadd" name="dateadd" class="form-control" readonly required placeholder="" />
			  </div>
			</div>
			
			<div class="row">
						<label for="work" class="col-md-5 col-form-label" style="text-align:right">รายละเอียดการทำงาน <label style="color:red">*</label> : </label>
			  <div class="col-md-7">
				<textarea rows="8" id="work" name="work" class="form-control" readonly></textarea>
			  </div>
			</div>
			
			<div class="row">
			  <label for="staff_approve" class="col-md-5 col-form-label" style="text-align:right">รับทราบการบันทึก : </label>
			  <div class="col-md-7">
				<input type="checkbox" name="staff_approve" id="staff_approve" value="1" > รับทราบ</br>
			  </div>
			</div>
			
			<div class="row">
						<label for="staff_comment" class="col-md-5 col-form-label" style="text-align:right">ความคิดเห็นพี่เลี้ยง : </label>
			  <div class="col-md-7">
				<textarea rows="8" id="staff_comment" name="staff_comment" class="form-control" > </textarea>
			  </div>
			</div>	
					
			<div class="row">
			  <label for="auditor_approve" class="col-md-5 col-form-label" style="text-align:right">รับทราบการบันทึก : </label>
			  <div class="col-md-7">
				<input type="checkbox" name="auditor_approve" id="auditor_approve" value="1" disabled> รับทราบ</br>
			  </div>
			</div>
			
			<div class="row">
				<label for="auditor_comment" class="col-md-5 col-form-label" style="text-align:right">ความคิดเห็น อ.นิเทศ : </label>
			  <div class="col-md-7">
				<textarea rows="8" id="auditor_comment" name="auditor_comment" class="form-control" readonly> </textarea>
			  </div>
			</div>
		 </form>	
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary" id="btn_add_info" >บันทึก</button>
      </div>
    </div>
  </div>
</div>
	
</body>
</html>