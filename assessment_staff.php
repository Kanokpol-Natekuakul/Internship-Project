<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ระบบฝึกประสบการณ์วิชาชีพ V.1.0.0</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
     
    

    </style>
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
  $("#navbarDropdown").hide();
  $("#result").hide();
	$("#btn_reg_ok").hide();
	
	$("#frm_assessment_staff").on('submit',(function(e) {	
		
		e.preventDefault();
		
		if ($("#frm_register_staff input[id=staff_password]").val() != $("#frm_register_staff input[id=staff_conpassword]").val()) {
			$("#modelwarning").find('.modal-body').text('กรุณากรอก ยืนยัน Password ให้ตรงกับ Password');
			$("#modelwarning").modal('show');	
			$("#staff_conpassword").focus();
		} else {
			
		$.ajax ({
			type: "POST", 
			url: "exe_assessment_staff.php" , 
			cache: false, 
			async: false, 							
			data:  {
							act: "insert",
							std_id: $("#frm_assessment_staff input[id=std_id]").val(),
							std_year: $("#frm_assessment_staff input[id=std_year]").val(),
							std_term: $("#frm_assessment_staff input[name=std_term]:checked").val(),
							std_prefix: $("#frm_assessment_staff input[name=std_prefix]:checked").val(),
							std_name:$("#frm_assessment_staff input[id=std_name]").val(),
							std_sname:$("#frm_assessment_staff input[id=std_sname]").val(),
							std_group:$("#frm_assessment_staff input[id=std_group]").val(),
							office_id:$("#frm_assessment_staff select[id=office_id]").val(),
							office_name:$("#frm_assessment_staff select[id=office_name]").val(),
							first_day:$("#frm_assessment_staff input[name=first_day]").val(),
							last_day:$("#frm_assessment_staff input[name=last_day]").val(),
							q1:$("#frm_assessment_staff input[name=q1]:checked").val(),
							q2:$("#frm_assessment_staff input[name=q2]:checked").val(),
                            q3:$("#frm_assessment_staff input[name=q3]:checked").val(),
                            q4:$("#frm_assessment_staff input[name=q4]:checked").val(),
                            q5:$("#frm_assessment_staff input[name=q5]:checked").val(),
                            q6:$("#frm_assessment_staff input[name=q6]:checked").val(),
							q7:$("#frm_assessment_staff input[name=q7]:checked").val(),
                            q8:$("#frm_assessment_staff input[name=q8]:checked").val(),
                            q9:$("#frm_assessment_staff input[name=q9]:checked").val(),
                            q10:$("#frm_assessment_staff input[name=q10]:checked").val(),
                            q11:$("#frm_assessment_staff input[name=q11]:checked").val(),
							q12:$("#frm_assessment_staff input[name=q12]:checked").val(),
                            q13:$("#frm_assessment_staff input[name=q13]:checked").val(),
                            q14:$("#frm_assessment_staff input[name=q14]:checked").val(),
                            comment_s:$("#frm_assessment_staff textarea[name=comment_s]").val(),
							staff_id:$("#frm_assessment_staff select[name=staff_id]").val(),
							staff_name:$("#frm_assessment_staff select[name=staff_name]").val(),
							office_conpassword:$("#frm_register_office input[id=office_conpassword]").val()	

						},
			success: function(data) {								
				if (data == 1) {																	
					$("#result").html("ส่งข้อมูลแบบประเมินเรียบร้อย"); 
					$("#result").show();
					$("#btn_reg_ok").show();									
					$("#frm_assessment_staff")[0].reset();	
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

}

);

      	
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
</div>
    </nav>
	
    <hr>
    <h2 class="text-center">แบบประเมินผลการฝึกประสบการณ์วิชาชีพ</h2>	
		<hr>

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
      <form id="frm_assessment_staff" action="" method="POST">

	  <div class="row">		
			  <label for="std_term" class="col-md-4 col-form-label" style="text-align:right">ภาคเรียนที่ <label style="color:red">*</label> : </label>
			  <div class="col-md-4">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="std_term" id="std_term1" value="1" required> 1
			</br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="std_term" id="std_term2" value="2" required> 2
			</br>
			  </div>
			<div class="col-md-4"> </div>
		  </div>

		  <div class="row">
					<label for="std_year" class="col-md-4 col-form-label" style="text-align:right">ปีการศึกษา <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="std_year" name="std_year" class="form-control" maxlength="4" required placeholder="ปีการศึกษา พ.ศ." />
          </div>
					<div class="col-md-4"> </div>
          </div>
      <div class="row">
					<label for="std_id" class="col-md-4 col-form-label" style="text-align:right">รหัสประจำตัวนักศึกษา <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="std_id" name="std_id" class="form-control" maxlength="9" required placeholder="รหัสประจำตัวนักศึกษา" />
          </div>
					<div class="col-md-4"> </div>
          </div> 	  
		
	      <div class="row">		
			  <label for="std_prefix" class="col-md-4 col-form-label" style="text-align:right">คำนำหน้าชื่อ <label style="color:red">*</label> : </label>
			  <div class="col-md-4">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="std_prefix" id="std_prefix1" value="นาย" required> นาย
			</br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="std_prefix" id="std_prefix2" value="นาง" required> นาง	
			</br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="std_prefix" id="std_prefix3" value="นางสาว" required> นางสาว
			  </div>
			<div class="col-md-4"> </div>
		  </div>
	
        <div class="row">
					<label for="std_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="std_name" name="std_name" class="form-control" required placeholder="ชื่อ" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

        <div class="row">
					<label for="std_sname" class="col-md-4 col-form-label" style="text-align:right">นามสกุล <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="std_sname" name="std_sname" class="form-control" required placeholder="นามสกุล" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
	
        <div class="row">
					<label for="std_group" class="col-md-4 col-form-label" style="text-align:right">หมู่เรียน <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="std_group" name="std_group" class="form-control" maxlength="5" required placeholder="หมู่เรียน" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
		  
        <div class="row">
					<label for="office_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อหน่วยงาน/บริษัท <label style="color:red">*</label> : </label>
          <div class="col-md-4">
			  
						<select class="form-control" id="office_id" name="office_id" required>
							<option value="">--หน่วยงาน/บริษัท--</option>			  
								<?php
									require_once('./include/connect.php');
									$sql = "SELECT * FROM `office_info` ORDER BY `office_name` ASC";
									$res = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));
									while ($row1 = mysqli_fetch_array($res)) {
										
											//$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
											//echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
										
										echo "<option value ='$row1[office_id]'>$row1[office_name]</option>";
									}
								?>
			  
						</select>
          </div>
					<div class="col-md-4"> </div>
        </div>	
        <div class="row">
						<label for="first_day" class="col-md-4 col-form-label" style="text-align:right">ระยะเวลาฝึกงานตั้งแต่วันที่ <label style="color:red">*</label> : </label>
			  <div class="col-md-4">
				<input type="date" id="first_day" name="first_day" class="form-control"  required placeholder="" />
			  </div>
			</div> 
            <div class="row">
						<label for="last_day" class="col-md-4 col-form-label" style="text-align:right">ถึงวันที่ <label style="color:red">*</label> : </label>
			  <div class="col-md-4">
				<input type="date" id="last_day" name="last_day" class="form-control"  required placeholder="" />
			  </div>
			</div>

            
    <h2 class="text-center">เกณฑ์การประเมิน</h2>	
        <h3 class="text-center"> 1. การทำงานของนักศึกษา</h3>
        <br>


        <div class="row">		
			  <label for="q1" class="col-md-4 col-form-label" style="text-align:right">1 ) ทำงานมีประสิทธิภาพและผลงานมีคุณภาพ <label style="color:red">*</label> : </label>
			  <div class="col-md-5">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q1" id="q1" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q1" id="q1" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q1" id="q1" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q1" id="q1" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q1" id="q1" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
        </div>
			<div class="col-md-5"> </div>
		  </div>
        
        
          <div class="row">		
			  <label for="q2" class="col-md-4 col-form-label" style="text-align:right">2) การพูดจาเหมาะสม <label style="color:red">*</label> : </label>
			  <div class="col-md-5">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q2" id="q2" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q2" id="q2" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q2" id="q2" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q2" id="q2" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q2" id="q2" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
        </div>
			<div class="col-md-5"> </div>
		  </div>
        
          <div class="row">		
			  <label for="q3" class="col-md-4 col-form-label" style="text-align:right">3 ) เอาใจใส่ต่อการใช้อุปกรณ์ <label style="color:red">*</label> : </label>
			  <div class="col-md-5">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q3" id="q3" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q3" id="q3" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q3" id="q3" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q3" id="q3" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="q3" id="q3" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;
        </div>
			<div class="col-md-5"> </div>
		  </div>
        
          <div class="row">
              <label for="q4" class="col-md-4 col-form-label" style="text-align:right">4 ) มีการพัฒนางาน มีความคิดริเริ่ม <label style="color:red">*</label> : </label>
              <div class="col-md-5">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q4" id="q4" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q4" id="q4" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q4" id="q4" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q4" id="q4" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q4" id="q4" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-md-5"> </div>
          </div>

          <div class="row">
              <label for="q5" class="col-md-4 col-form-label" style="text-align:right">5 ) มีความขยัน อดทน และรับผิดชอบต่อการทำงาน <label style="color:red">*</label> : </label>
              <div class="col-md-5">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q5" id="q5" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q5" id="q5" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q5" id="q5" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q5" id="q5" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q5" id="q5" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-md-5"> </div>
          </div>

          <div class="row">
              <label for="q6" class="col-md-4 col-form-label" style="text-align:right">6 ) มีเจตคติที่ดีต่อหน่วยงาน <label style="color:red">*</label> : </label>
              <div class="col-md-5">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q6" id="q6" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q6" id="q6" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q6" id="q6" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q6" id="q6" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q6" id="q6" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-md-5"> </div>
          </div>

		  <div class="row">
              <label for="q7" class="col-md-4 col-form-label" style="text-align:right">7 ) การใช้เวลาว่างให้เป็นประโยชน์ <label style="color:red">*</label> : </label>
              <div class="col-md-5">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q7" id="q7" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q7" id="q7" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q7" id="q7" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q7" id="q7" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" class="form-check-input" name="q7" id="q7" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-md-5"> </div>
          </div>

		  <div class="row">
			<label for="q8" class="col-md-4 col-form-label" style="text-align:right">8 ) มีความรู้เกี่ยวกับงานในหน้าที่ <label style="color:red">*</label> : </label>
			<div class="col-md-5">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q8" id="q8" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;	
				<input type="radio" class="form-check-input" name="q8" id="q8" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q8" id="q8" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q8" id="q8" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q8" id="q8" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="col-md-5"> </div>
		  </div>

		  <div class="row">
			<label for="q9" class="col-md-4 col-form-label" style="text-align:right">9 ) ความมีระเบียบวินัย <label style="color:red">*</label> : </label>
			<div class="col-md-5">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q9" id="q9" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q9" id="q9" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q9" id="q9" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q9" id="q9" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q9" id="q9" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="col-md-5"> </div>
		  </div>

		  <h3 class="text-center"> 2.บุคลิกภาพ</h3>
        <br>

		<div class="row">
			<label for="q10" class="col-md-4 col-form-label" style="text-align:right">1 ) การแต่งกายสะอาด สุภาพเรียบร้อย <label style="color:red">*</label> : </label>
			<div class="col-md-5">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q10" id="q10" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q10" id="q10" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q10" id="q10" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q10" id="q10" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q10" id="q10" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="col-md-5"> </div>
		  </div>
			
		  <div class="row">
			<label for="q11" class="col-md-4 col-form-label" style="text-align:right">2 ) กิริยาวาจาเหมาะสมกับกาลเทศะ <label style="color:red">*</label> : </label>
			<div class="col-md-5">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q11" id="q11" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q11" id="q11" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q11" id="q11" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q11" id="q11" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q11" id="q11" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="col-md-5"> </div>
		  </div>

		  <div class="row">
			<label for="q12" class="col-md-4 col-form-label" style="text-align:right">3 ) มีมนุษยสัมพันธ์ และไฝ่รู้ <label style="color:red">*</label> : </label>
			<div class="col-md-5">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q12" id="q12" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q12" id="q12" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q12" id="q12" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q12" id="q12" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q12" id="q12" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="col-md-5"> </div>
		  </div>

		  
		  <div class="row">
			<label for="q13" class="col-md-4 col-form-label" style="text-align:right">4 ) ตรงต่อเวลา <label style="color:red">*</label> : </label>
			<div class="col-md-5">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q13" id="q13" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q13" id="q13" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q13" id="q13" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q13" id="q13" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q13" id="q13" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="col-md-5"> </div>
		  </div>

		  <div class="row">
			<label for="q14" class="col-md-4 col-form-label" style="text-align:right">5 ) ซื่อสัตย์และมีน้ำใจ <label style="color:red">*</label> : </label>
			<div class="col-md-5">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q14" id="q14" value="5" required> 5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q14" id="q14" value="4" required> 4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q14" id="q14" value="3" required> 3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q14" id="q14" value="2" required> 2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" class="form-check-input" name="q14" id="q14" value="1" required> 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div class="col-md-5"> </div>
		  </div>

		  
		  <div class="row">
				<label for="comment_s" class="col-md-4 col-form-label" style="text-align:right">ความคิดเห็น พี่เลี้ยง : </label>
			  <div class="col-md-4">
				<textarea rows="8" id="comment_s" name="comment_s" class="form-control" > </textarea>
				</div>
			<div class="col-md-4"> </div>
		  </div><br>


		  <div class="row">
					<label for="staff_name" class="col-md-4 col-form-label" style="text-align:right">ลงชื่อ พี่เลี้ยง <label style="color:red">*</label> : </label>
          <div class="col-md-4">
			  
						<select class="form-control" id="staff_id" name="staff_id" required>
							<option value="">--ลงชื่อ พี่เลี้ยง--</option>			  
								<?php
									require_once('./include/connect.php');
									$sql = "SELECT * FROM `staff_info` ORDER BY `staff_name` ASC";
									$res = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));
									while ($row1 = mysqli_fetch_array($res)) {
										
											//$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
											//echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
										
										echo "<option value ='$row1[staff_id]'>$row1[staff_name]</option>";
									}
								?>
			  
						</select>
          </div>
					<div class="col-md-4"> </div>
        </div>
     <br>   <div class="row">
          <div class="col-md-12">
            <p align="center">     
							<button type="submit" class="btn btn-primary btn-sm" id="btn_reg" value="Register"> ส่งแบบประเมิน </button> 