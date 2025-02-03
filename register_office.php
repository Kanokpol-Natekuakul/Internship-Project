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
	
	$("#frm_register_office").on('submit',(function(e) {	
		
		e.preventDefault();
		
		if ($("#frm_register_staff input[id=staff_password]").val() != $("#frm_register_staff input[id=staff_conpassword]").val()) {
			$("#modelwarning").find('.modal-body').text('กรุณากรอก ยืนยัน Password ให้ตรงกับ Password');
			$("#modelwarning").modal('show');	
			$("#staff_conpassword").focus();
		} else {
			
		$.ajax ({
			type: "POST", 
			url: "exe_register_office.php" , 
			cache: false, 
			async: false, 							
			data:  {
							act: "insert",
							//office_id:$("#frm_register_office input[id=office_id]").val(),
              office_name:$("#frm_register_office input[id=office_name]").val(),
              office_mobile:$("#frm_register_office input[id=office_mobile]").val(),
							office_email:$("#frm_register_office input[id=office_email]").val(),
							lat_office:$("#frm_register_office input[id=lat_office]").val(),
							lng_office:$("#frm_register_office input[id=lng_office]").val(),
							office_conpassword:$("#frm_register_office input[id=office_conpassword]").val()	
						},
			success: function(data) {								
				if (data == 1) {																	
					$("#result").html("ส่งข้อมูลสำหรับลงทะเบียนบริษัทเรียบร้อย"); 
					$("#result").show();
					$("#btn_reg_ok").show();									
					$("#frm_register_office")[0].reset();	
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
			$("#frm_register_office input[id=lat_office]").val(pos.lat);
			$("#frm_register_officce input[id=lng_office]").val(pos.lng);
			  
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
		  $("#frm_register_office input[id=lat_office]").val(event.latLng.lat());
		  $("#frm_register_office input[id=lng_office]").val(event.latLng.lng());			
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
       <a class="navbar-brand" href= "main_auditor.php">ระบบฝึกประสบการณ์วิชาชีพ</a>
			
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
</div>
    </nav>
	
    <hr>
    <h2 class="text-center">ระบบลงทะเบียนบริษัท</h2>	
		<hr>

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
      <form id="frm_register_office" action="" method="POST">
		  
      <!--<div class="row">
					<label for="office_id" class="col-md-4 col-form-label" style="text-align:right">รหัสสำนักงาน <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="office_id" name="staff_name" maxlength="11" class="form-control" required placeholder="รหัสสำนักงาน" />
          </div>
					<div class="col-md-4"> </div>
        </div>--> 
      <div class="row">
					<label for="office_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อบริษัท <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="office_name" name="office_name" class="form-control" required placeholder="ชื่อบริษัท" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
    
        <div class="row">
					<label for="office_mobile" class="col-md-4 col-form-label" style="text-align:right">เบอร์โทรศัพท์  : </label>
          <div class="col-md-4">
            <input type="number" id="office_mobile" name="office_mobile" class="form-control"  placeholder="เบอร์โทรศัพท์" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
        </br>
        <div class="row">
					<label for="office_email" class="col-md-4 col-form-label" style="text-align:right">E-Mail  : </label>
          <div class="col-md-4">
            <input type="email" id="office_email" name="office_email" class="form-control"  placeholder="E-Mail" />
          </div>
					<div class="col-md-4"> </div>
        </div>
    </br>
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
        </div> 	<br>
      
        <div class="row">
          <div class="col-md-12">
            <p align="center">     
							<button type="submit" class="btn btn-primary btn-sm" id="btn_reg" value="Register"> ลงทะเบียน </button> 