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
  $("*", "#frm_office_info").prop('disabled',true);	
  $("#btn_back").prop('disabled',false);
	
	$("#frm_office_info").on('submit',(function(e) {	
		e.preventDefault();
		//alert($("#frm_office_info select[id=district_id]").val());
	
				$.ajax ({
					type: "POST", 
					url: "exe_office_info.php", 
					cache: false, 
					async: false, 							
					data:  {
									office_name:$("#frm_office_info input[id=office_name]").val(),
									address:$("#frm_office_info input[id=address]").val(),
									province_id:$("#frm_office_info select[id=province_id]").val(),
									amphur_id:$("#frm_office_info select[id=amphur_id]").val(),
									district_id:$("#frm_office_info select[id=district_id]").val(),
									zipcode:$("#frm_office_info input[id=zipcode]").val(),
									tel_office:$("#frm_office_info input[id=tel_office]").val(),
									fax_office:$("#frm_office_info input[id=fax_office]").val(),
									prefix: $("#frm_office_info input[name=prefix]:checked").val(),
									contact_name:$("#frm_office_info input[id=contact_name]").val(),
									contact_sname:$("#frm_office_info input[id=contact_sname]").val(),
									contact_position:$("#frm_office_info input[id=contact_position]").val(),
									contact_mobile:$("#frm_office_info input[id=contact_mobile]").val(),
									contact_email:$("#frm_office_info input[id=contact_email]").val()										
								},
					success: function(data) {	

						if (data == 1) {																	
							$("#result").html("ปรับปรุงข้อมูลสำนักงานเรียบร้อย"); 
							$("#result").show();
							$("#btn_reg_ok").show();									
							$("#frm_office_info")[0].reset();	
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
	
	$("#btn_back").on("click", function(){
		window.history.back();
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

      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow, markers = [];;
      function initMap() {
		  //alert(lati+" "+long);
        map = new google.maps.Map(document.getElementById('map'), {
          //center: {lat: 13.75398, lng: 100.50144},
		  center: {lat: parseFloat(lati), lng: parseFloat(long)},
          zoom: 12
        });
        //infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        //if (navigator.geolocation) {
        //  navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: parseFloat(lati),
              lng: parseFloat(long)
            };
		//	$("#frm_register input[id=lat_office]").val(pos.lat);
		//	$("#frm_register input[id=lng_office]").val(pos.lng);
			  
            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
			//infoWindow.open(map);  
			addMarker(pos);	            
            //map.setCenter(18.346976884462137,103.6450861250139);
          //}, function() {
          //  handleLocationError(true, infoWindow, map.getCenter());
          //});
			
			
        //} else {
          // Browser doesn't support Geolocation
          //handleLocationError(false, infoWindow, map.getCenter());
        //}

        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
		  //clearMarkers();
          //addMarker(pos);	
		  map.setCenter(pos);
		//	alert("Latitude: " + event.latLng.lat() + " " + ", longitude: " + event.latLng.lng());
		  //$("#frm_register input[id=lat_office]").val(event.latLng.lat());
		  //$("#frm_register input[id=lng_office]").val(event.latLng.lng());			
        });

        // Adds a marker at the center of the map.
        //addMarker(haightAshbury);
		  
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      // Adds a marker to the map and push to the array.
      function addMarker(location) {
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
        markers.push(marker);			  
      }

      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
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
    <h2 class="text-center">ข้อมูลสำนักงาน</h2>	


<div class="container">
	
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result">
		</div>
	</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="btn_reg_ok">
			<a href="main.php" class="btn btn-primary" role="button"> หน้าหลัก </a>
		</div>
	</div>
	
  <div class="row" id="register">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <form id="frm_office_info" action="" method="POST">
		  
		  <div class="row">
		     <div class="col-md-12">
               <h3 class="text-center">ข้อมูลหน่วยงาน/บริษัท</h3>	
			 </div>
		  </div>
	      <div class="row">
					<label for="office_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อหน่วยงาน/บริษัท <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="office_name" name="office_name" class="form-control" required placeholder="ชื่อหน่วยงาน/บริษัท" />
          </div>
					<div class="col-md-4"><label style="color:red"> ให้ใส่ชื่อเต็ม เนื่องจากจะเป็นชื่อที่ถูกพิมพ์ลงบนใบประกาศนียบัตร</label> </div>
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
					<label for="tel_office" class="col-md-4 col-form-label" style="text-align:right">เบอร์โทรศัพท์ หน่วยงาน/บริษัท <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="number" id="tel_office" name="tel_office" class="form-control" required placeholder="เบอร์โทรศัพท์หน่วยงาน/บริษัท" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

		<div class="row">
					<label for="fax_office" class="col-md-4 col-form-label" style="text-align:right">เบอร์โทรสาร หน่วยงาน/บริษัท <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="number" id="fax_office" name="fax_office" class="form-control" required placeholder="เบอร์โทรสาร หน่วยงาน/บริษัท" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

		<div class="row">
				<label for="fax_office" class="col-md-4 col-form-label" style="text-align:right">แผนที่ ที่ตั้งหน่วยงาน/บริษัท : </label>
<div class="col-md-4" id="map" style="height: 300px;"></div>

			<div class="col-md-4"> </div>
        </div> 
		  
		</br>
		<div class="row">
					<label for="lat_office" class="col-md-4 col-form-label" style="text-align:right">พิกัด latitude ที่ตั้งหน่วยงาน/บริษัท : </label>
          <div class="col-md-4">
            <input type="number" id="lat_office" name="lat_office" class="form-control" placeholder="" disabled/>
          </div>
					<div class="col-md-4"></div>
        </div> 
		</br>
		<div class="row">
					<label for="lng_office" class="col-md-4 col-form-label" style="text-align:right">พิกัด longitude ที่ตั้งหน่วยงาน/บริษัท : </label>
          <div class="col-md-4">
            <input type="number" id="lng_office" name="lng_office" class="form-control" placeholder="" disabled/>
          </div>
					<div class="col-md-4"> </div>
        </div> 			  
		  
		<div class="row">
			<div class="col-md-12">
			   </br>
		       <h3 class="text-center">ข้อมูลผู้ประสานโครงการ</h3>	
			</div>
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
					<label for="contact_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="contact_name" name="contact_name" class="form-control" required placeholder="ชื่อผู้ประสานโครงการ" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

        <div class="row">
					<label for="contact_sname" class="col-md-4 col-form-label" style="text-align:right">นามสกุล <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="contact_sname" name="contact_sname" class="form-control" required placeholder="นามสกุลผู้ประสานโครงการ" />
          </div>
					<div class="col-md-4"> </div>
        </div>  
				
         <div class="row">
					<label for="contact_position" class="col-md-4 col-form-label" style="text-align:right">ตำแหน่ง <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="contact_position" name="contact_position" class="form-control" required placeholder="ตำแหน่ง" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

        <div class="row">
					<label for="contact_mobile" class="col-md-4 col-form-label" style="text-align:right">เบอร์โทรศัพท์มือถือ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="number" id="contact_mobile" name="contact_mobile" class="form-control" required placeholder="เบอร์โทรศัพท์มือถือ" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
				
        <div class="row">
					<label for="contact_email" class="col-md-4 col-form-label" style="text-align:right">E-Mail <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="email" id="contact_email" name="contact_email" class="form-control" required placeholder="E-Mail" />
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
  $office_id = $_GET["office_id"];
  $sql = "SELECT * FROM office_info WHERE office_id = '".$office_id."'";
  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));

	$row = mysqli_fetch_array($result);
?>				
	<button type="button" class="btn btn-primary btn-sm" id="btn_back" value="Back" > ย้อนกลับ </button> 

<!--						  
							<a href="http://devbanban.com/" class="btn btn-info btn-sm"> ลงทะเบียน </a>
-->
<?php
  require_once('./include/connect.php');
	$office_id = $_GET["office_id"];
  $sql = "SELECT * FROM office_info WHERE office_id = '".$office_id."'";
  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));

	$row = mysqli_fetch_array($result);
				
?>
							<script type="text/javascript">
									$("#frm_office_info input[id=office_name]").val('<?php echo $row['office_name']; ?>');
									$("#frm_office_info input[id=address]").val('<?php echo $row['address']; ?>');
									$("#frm_office_info select[id=province_id]").val('<?php echo $row['province_id']; ?>');
									$.ajax ({
									type: "POST", 
									url: "getamphure.php" , 
									cache: false, 
									data: {
												province_id:$("#province_id").val()
												},
									success: function(data) {
											$('#amphur_id').html(data);
											$("#frm_office_info select[id=amphur_id]").val('<?php echo $row['amphur_id']; ?>');

											$.ajax ({
												type: "POST", 
												url: "getdistrict.php" , 
												cache: false, 
												data:  {
																 amphur_id:$("#amphur_id").val()
															 },
												success: function(data) {
													$('#district_id').html(data);
													$("#frm_office_info select[id=district_id]").val('<?php echo $row['district_id']; ?>');
															}	
											});	

									}
									});		
								
									$("#frm_office_info input[id=zipcode]").val('<?php echo $row['zipcode']; ?>');
									$("#frm_office_info input[id=tel_office]").val('<?php echo $row['tel_office']; ?>');
									$("#frm_office_info input[id=fax_office]").val('<?php echo $row['fax_office']; ?>');
								    $("#frm_office_info input[id=lat_office]").val('<?php echo $row['lat_office']; ?>');
									$("#frm_office_info input[id=lng_office]").val('<?php echo $row['lng_office']; ?>');
									if("<?php echo $row['prefix']; ?>" == "นาย"){$("#frm_office_info input[id=prefix1]").prop('checked', true);}
									if("<?php echo $row['prefix']; ?>" == "นาง"){$("#frm_office_info input[id=prefix2]").prop('checked', true);}
									if("<?php echo $row['prefix']; ?>" == "นางสาว"){$("#frm_office_info input[id=prefix3]").prop('checked', true);}			
									$("#frm_office_info input[id=contact_name]").val('<?php echo $row['contact_name']; ?>');
									$("#frm_office_info input[id=contact_sname]").val('<?php echo $row['contact_sname']; ?>');
									$("#frm_office_info input[id=contact_position]").val('<?php echo $row['contact_position']; ?>');
									$("#frm_office_info input[id=contact_mobile]").val('<?php echo $row['contact_mobile']; ?>');
									$("#frm_office_info input[id=contact_email]").val('<?php echo $row['contact_email']; ?>');
									var lati = '<?php echo $row['lat_office']; ?>';
									var long = '<?php echo $row['lng_office']; ?>';
							</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd9jVF85BtUEl2hF9IlitF0QyvhQlok08&callback=initMap"
    ></script>				
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