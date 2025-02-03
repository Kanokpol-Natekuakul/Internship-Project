<?php 
	require_once('auth_staff.php');
    date_default_timezone_set('Asia/Bangkok');
	$date = date('Y-m-d H:i:s');	
  require_once('./include/connect.php'); 

/*
		$sql_chsch = "SELECT * FROM schedule WHERE year = '".$_SESSION['SESS_YEAR']."';";
        $result_chsch = mysqli_query($traindb,$sql_chsch) or die(mysqli_error($traindb));
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
	
	$("#frm_staff_info").on('submit',(function(e) {	
		e.preventDefault();
		//alert($("#frm_staff_info select[id=district_id]").val());
	
				$.ajax ({
					type: "POST", 
					url: "exe_staff_info.php", 
					cache: false, 
					async: false, 							
					data:  {
									staff_prefix: $("#frm_staff_info input[name=staff_prefix]:checked").val(),
									staff_name:$("#frm_staff_info input[id=staff_name]").val(),
									staff_sname:$("#frm_staff_info input[id=staff_sname]").val(),
									staff_position:$("#frm_staff_info input[id=staff_position]").val(),
									staff_mobile:$("#frm_staff_info input[id=staff_mobile]").val(),	
									staff_email:$("#frm_staff_info input[id=staff_email]").val(),	
									office_id:$("#frm_staff_info select[id=office_id]").val(),
									office_name:$("#frm_staff_info select[id=office_name]").val(),
									lat_office:$("#frm_staff_info input[id=lat_office]").val(),
									lng_office:$("#frm_staff_info input[id=lng_office]").val()									
								},
					success: function(data) {	

						if (data == 1) {																	
							$("#result").html("ปรับปรุงข้อมูลสำนักงานเรียบร้อย"); 
							$("#result").show();
							$("#btn_reg_ok").show();									
							$("#frm_staff_info")[0].reset();	
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
		if ((lati == "") && (long == ""))  {
			if (navigator.geolocation) {
			  navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
				  lat: position.coords.latitude,
				  lng: position.coords.longitude
				};
				$("#frm_staff_info input[id=lat_office]").val(pos.lat);
				$("#frm_staff_info input[id=lng_office]").val(pos.lng);

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
		} else {
			map = new google.maps.Map(document.getElementById('map'), {
			  center: {lat: parseFloat(lati), lng: parseFloat(long)},
			  zoom: 12
			});		
			var pos = {
              lat: parseFloat(lati),
              lng: parseFloat(long)
            };
			addMarker(pos);	
		}


        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
		  clearMarkers();
          addMarker(event.latLng);	
		  map.setCenter(event.latLng);
		//	alert("Latitude: " + event.latLng.lat() + " " + ", longitude: " + event.latLng.lng());
		  $("#frm_staff_info input[id=lat_office]").val(event.latLng.lat());
		  $("#frm_staff_info input[id=lng_office]").val(event.latLng.lng());			
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
    <h2 class="text-center">ข้อมูลส่วนตัว</h2>	


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
      <form id="frm_staff_info" action="" method="POST">
		  
		  <div class="row">
		     <div class="col-md-12">
               <h3 class="text-center">แก้ไข ข้อมูลส่วนตัว</h3>	
			 </div>
		  </div>
		  
		  
		  <div class="row">
					<label for="office_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อหน่วยงาน/บริษัท <label style="color:red">*</label> : </label>
          <div class="col-md-4">
			  
						<select class="form-control" id="office_name" name="office_name" required>
							<option value="">--หน่วยงาน/บริษัท--</option>			  
								<?php
									require_once('./include/connect.php');
									$sql = "SELECT * FROM `office_info`  ORDER BY `office_name` ASC";
									$res = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));
									while ($row1 = mysqli_fetch_array($res)) {
										
											//$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
											//echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
									
										echo "<option value ='$row1[office_name]'>$row1[office_name]</option>";
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
          <div class="col-md-12">
            <p align="center">    
						    <br/>
							<button type="submit" class="btn btn-primary btn-sm" id="btn_reg" value="Register"> บันทึก </button> 
<!--						  
							<a href="http://devbanban.com/" class="btn btn-info btn-sm"> ลงทะเบียน </a>
-->
<?php
  require_once('./include/connect.php');
  $staff_id = $_SESSION['SESS_STAFF_ID'];
  $sql = "SELECT * FROM staff_info WHERE staff_id = '".$staff_id."'";
  $result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));

	$row = mysqli_fetch_array($result);
				
?>
							<script type="text/javascript">
									$("#frm_staff_info select[id=office_id]").val('<?php echo $row['office_id']; ?>');
								
								    $("#frm_staff_info input[id=lat_office]").val('<?php echo $row['lat_office']; ?>');
									$("#frm_staff_info input[id=lng_office]").val('<?php echo $row['lng_office']; ?>');
								
									if("<?php echo $row['staff_prefix']; ?>" == "นาย"){$("#frm_staff_info input[id=prefix1]").prop('checked', true);}
									if("<?php echo $row['staff_prefix']; ?>" == "นาง"){$("#frm_staff_info input[id=prefix2]").prop('checked', true);}
									if("<?php echo $row['staff_prefix']; ?>" == "นางสาว"){$("#frm_staff_info input[id=prefix3]").prop('checked', true);}
									$("#frm_staff_info input[id=staff_name]").val('<?php echo $row['staff_name']; ?>');
									$("#frm_staff_info input[id=staff_sname]").val('<?php echo $row['staff_sname']; ?>');					
									$("#frm_staff_info input[id=staff_position]").val('<?php echo $row['staff_position']; ?>');	
									$("#frm_staff_info input[id=staff_mobile]").val('<?php echo $row['staff_mobile']; ?>');
									$("#frm_staff_info input[id=staff_email]").val('<?php echo $row['staff_email']; ?>');		
								

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