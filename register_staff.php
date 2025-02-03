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
	
	$("#frm_register_staff").on('submit',(function(e) {	
		
		e.preventDefault();
		
		if ($("#frm_register_staff input[id=staff_password]").val() != $("#frm_register_staff input[id=staff_conpassword]").val()) {
			$("#modelwarning").find('.modal-body').text('กรุณากรอก ยืนยัน Password ให้ตรงกับ Password');
			$("#modelwarning").modal('show');	
			$("#staff_conpassword").focus();
		} else {
			
		$.ajax ({
			type: "POST", 
			url: "exe_register_staff.php" , 
			cache: false, 
			async: false, 							
			data:  {
							act: "insert",
							office_id:$("#frm_register_staff select[id=office_id]").val(),
              office_name:$("#frm_register_staff select[id=office_name]").val(),
							lat_office:$("#frm_register_staff input[id=lat_office]").val(),
							lng_office:$("#frm_register_staff input[id=lng_office]").val(),
							staff_prefix: $("#frm_register_staff input[name=staff_prefix]:checked").val(),
							staff_name:$("#frm_register_staff input[id=staff_name]").val(),
							staff_sname:$("#frm_register_staff input[id=staff_sname]").val(),
							staff_position:$("#frm_register_staff input[id=staff_position]").val(),
							staff_mobile:$("#frm_register_staff input[id=staff_mobile]").val(),
							staff_email:$("#frm_register_staff input[id=staff_email]").val(),
							staff_username:$("#frm_register_staff input[id=staff_username]").val(),
							staff_password:$("#frm_register_staff input[id=staff_password]").val(),
							staff_conpassword:$("#frm_register_staff input[id=staff_conpassword]").val()	
						},
			success: function(data) {								
				if (data == 1) {																	
					$("#result").html("ส่งข้อมูลสำหรับลงทะเบียนเรียบร้อย กรุณารอการอนุมัติจากผู้ดูแลระบบ ภายใน 24 ชั่วโมง"); 
					$("#result").show();
					$("#btn_reg_ok").show();									
					$("#frm_register_staff")[0].reset();	
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


      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow, markers = [];;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 13.75398, lng: 100.50144},
          zoom: 12
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
			$("#frm_register_staff input[id=lat_office]").val(pos.lat);
			$("#frm_register_staff input[id=lng_office]").val(pos.lng);
			  
            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
			//infoWindow.open(map);  
			addMarker(pos);	            
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
			
			
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
		  clearMarkers();
          addMarker(event.latLng);	
		  map.setCenter(event.latLng);
		//	alert("Latitude: " + event.latLng.lat() + " " + ", longitude: " + event.latLng.lng());
		  $("#frm_register_staff input[id=lat_office]").val(event.latLng.lat());
		  $("#frm_register_staff input[id=lng_office]").val(event.latLng.lng());			
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
    <nav class="navbar navbar-expand-lg navbar-dark ">
       <a class="navbar-brand" href= "login_staff.php">ระบบฝึกประสบการณ์วิชาชีพ</a>
			
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
<!--			  
			 <li class="nav-item active">
                <a class="nav-link" href="audit_manual_v1.pdf" target="_blank">คู่มือการใช้งานสำหรับ Auditor<span class="sr-only">(current)</span></a>
             </li>	
-->

<!--						
             <li class="nav-item active">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
             </li>
-->
<!--						
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a class="dropdown-item" href="index2.php">หมวดหลัก</a>
                   <a class="dropdown-item" href="index3.php">หมวดย่อย</a>
									 <a class="dropdown-item" href="index4_1.php">การกำหนดเกณฑ์คะแนน</a>
									 <a class="dropdown-item" href="index4.php">ตัวชี้วัด</a>
									 <a class="dropdown-item" href="index5.php">การประเมินตนเอง</a>
                   <a class="dropdown-item" href="index6.php">การประเมินโดยผู้ตรวจประเมิน</a>
                   <div class="dropdown-divider"></div>
                   <a class="dropdown-item" href="#">Something else here</a>
                </div>
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
    <h2 class="text-center">ระบบฝึกประสบการณ์วิชาชีพ ลงทะเบียน (พี่เลี้ยง)</h2>	
		<hr>

<div class="container">
	
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result">
		</div>
	</div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="btn_reg_ok">
			<a href="login_staff.php" class="btn btn-primary" role="button"> หน้าหลัก </a>
		</div>
	</div>
	
  <div class="row" id="register">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <form id="frm_register_staff" action="" method="POST">
		  
	
	      <div class="row">
					<label for="office_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อหน่วยงาน/บริษัท <label style="color:red">*</label> : </label>
          <div class="col-md-4">
			  
						<select class="form-control" id="office_id" name="office_id" required>
							<option value="">--หน่วยงาน/บริษัท--</option>			  
								<?php
									require_once('./include/connect.php');
									$sql = "SELECT * FROM `office_info`  ORDER BY `office_name` ASC";
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
				<label for="fax_office" class="col-md-4 col-form-label" style="text-align:right">แผนที่ ที่ตั้งหน่วยงาน/บริษัท : </label>
<div class="col-md-4" id="map" style="height: 300px;"></div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd9jVF85BtUEl2hF9IlitF0QyvhQlok08&callback=initMap"
    ></script>
			<div class="col-md-4"> </div>
        </div> 
		  
		</br>
		<div class="row">
					<label for="lat_office" class="col-md-4 col-form-label" style="text-align:right">พิกัด latitude ที่ตั้งหน่วยงาน/บริษัท : </label>
          <div class="col-md-4">
            <input type="number" id="lat_office" name="lat_office" class="form-control" placeholder="latitude" disabled/>
          </div>
					<div class="col-md-4"></div>
        </div> 
		</br>
		<div class="row">
					<label for="lng_office" class="col-md-4 col-form-label" style="text-align:right">พิกัด longitude ที่ตั้งหน่วยงาน/บริษัท : </label>
          <div class="col-md-4">
            <input type="number" id="lng_office" name="lng_office" class="form-control" placeholder="longitude" disabled/>
          </div>
					<div class="col-md-4"> </div>
        </div> 		  


	  
<!--		  
	      <div class="row">
					<label for="auditor_id" class="col-md-4 col-form-label" style="text-align:right">เลขบัตรประชาชนผู้ตรวจประเมิน <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="number" id="auditor_id" name="auditor_id" class="form-control" required placeholder="เลขบัตรประชาชนผู้ตรวจประเมิน" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
-->		
		  
	      <div class="row">		
			  <label for="staff_prefix" class="col-md-4 col-form-label" style="text-align:right">คำนำหน้าชื่อ <label style="color:red">*</label> : </label>
			  <div class="col-md-4">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="staff_prefix" id="prefix1" value="นาย" required> นาย
			</br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="staff_prefix" id="prefix2" value="นาง" required> นาง	
			</br>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="form-check-input" name="staff_prefix" id="prefix3" value="นางสาว" required> นางสาว
			  </div>
			<div class="col-md-4"> </div>
		  </div>
	
	      <div class="row">
					<label for="staff_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="staff_name" name="staff_name" class="form-control" required placeholder="ชื่อ" />
          </div>
					<div class="col-md-4"> </div>
        </div> 	

        <div class="row">
					<label for="staff_sname" class="col-md-4 col-form-label" style="text-align:right">นามสกุล <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="staff_sname" name="staff_sname" class="form-control" required placeholder="นามสกุล" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
	
        <div class="row">
					<label for="staff_position" class="col-md-4 col-form-label" style="text-align:right">ตำแหน่ง <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="staff_position" name="staff_position" class="form-control" required placeholder="ตำแหน่ง" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
<!--	  
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
								//	require_once('./include/connect.php');
								//	$sql = "SELECT * FROM `provinces` ORDER BY `PROVINCE_NAME` ASC";
								//	$res = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));
								//	while ($row1 = mysqli_fetch_array($res)) {
										/*
											$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
											echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
										*/
								//		echo "<option value ='$row1[PROVINCE_ID]'>$row1[PROVINCE_NAME]</option>";
								//	}
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
-->
	  
        <div class="row">
					<label for="staff_mobile" class="col-md-4 col-form-label" style="text-align:right">เบอร์โทรศัพท์ <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="number" id="staff_mobile" name="staff_mobile" class="form-control" required placeholder="เบอร์โทรศัพท์" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
				
        <div class="row">
					<label for="staff_email" class="col-md-4 col-form-label" style="text-align:right">E-Mail <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="email" id="staff_email" name="staff_email" class="form-control" required placeholder="E-Mail" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
		
        <div class="row">
					<label for="staff_username" class="col-md-4 col-form-label" style="text-align:right">Username <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="staff_username" name="staff_username" class="form-control" required placeholder="Username" />
          </div>
					<div class="col-md-4"> </div>
        </div> 

        <div class="row">
          <label for="staff_password" class="col-md-4 col-form-label" style="text-align:right">Password <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="password" id="staff_password" name="staff_password" class="form-control" required placeholder="Password" />
          </div>
					<div class="col-md-4"> </div>
				</div>

        <div class="row">
          <label for="staff_conpassword" class="col-md-4 col-form-label" style="text-align:right">ยืนยัน Password <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="password" id="staff_conpassword" name="staff_conpassword" class="form-control" required placeholder="ยืนยัน Password" />
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
							<button type="submit" class="btn btn-primary btn-sm" id="btn_reg" value="Register"> ลงทะเบียน </button> 
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