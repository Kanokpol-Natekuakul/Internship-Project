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
  $("#navbarDropdown").hide();
	$("#btn_reg").click(function(e) {	
      window.open("register.php","_self") 
	});
	
	//$("#btn_login").click(function(e) {
	$("#frm_login").on('submit',(function(e) {
	e.preventDefault();	
		if ($("#frm_login input[id=username]").val() == "" || $("#frm_login input[id=password]").val() == "") {
			$("#modelwarning").find('.modal-body').text('กรุณากรอก Username หรือ Password');
			$("#modelwarning").modal('show');			
		  //alert("กรุณากรอก Username หรือ Password");	
		}
		else {	
			//alert($("#frm_login input[id=remember]").is(":checked")); 
			$.ajax ({
				type: "POST", 
				url: "exe_login.php" , 
				cache: false, 
				async: false, 							
				data:  {
								username:$("#frm_login input[id=username]").val(),
								password:$("#frm_login input[id=password]").val(),
								remember:$("#frm_login input[id=remember]").is(":checked")
							},
				success: function(data) {								
					if (data == 1) {					
						window.open("main.php","_self"); 
					}
					else {
						//alert(data);
						//$("#result").html(data);
						$("#modelwarning").find('.modal-body').text('กรุณากรอก Username หรือ Password ให้ถูกต้อง');
						$("#modelwarning").modal('show');
						//alert("กรุณากรอก Username หรือ Password ให้ถูกต้อง");
					}
				}
			});	
		}
	}));
	
  $("#search_name").keyup(function(e) {	
		
		//alert($("#form2 input[id=search_name]").val());
		
		$.ajax ({
			type: "POST", 
			url: "search_reg_office_all_index.php" , 
			cache: false, 
			data:  {
				   name:$("#frmSearch input[id=search_name]").val()},
			success: function(data) {
				$("#office_reg").html(data); 	
				//$("#result1").hide(); 
			}		
		});	
	  
   });			
	
});
	
function get_reg() {
	$("#model_get_reg").modal('show');	
	//evidence_no = no;
	//$("#frm_upload_evi input[id=chk_listl2_id]").val(no);
}
</script>
	
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
       <a class="navbar-brand" href= "index.php">ระบบฝึกประสบการณ์วิชาชีพ</a>
			
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
						
             <li class="nav-item active">
                <a class="nav-link" href="login_staff.php">Login to Staff<span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item active">
                <a class="nav-link" href="login_auditor.php">Login to Auditor<span class="sr-only">(current)</span></a>
             </li>
<!--			  
			 <li class="nav-item active">
                <a class="nav-link" href="office_manual_v2.pdf" target="_blank">คู่มือการใช้งาน<span class="sr-only">(current)</span></a>
             </li>	
-->
			  
<!--
						 <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
             </li>

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
-->							 
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

<!-- 1
    <div class="container mt-3">
      <div class="row">
        <div class="col-12">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleControls" data-slide-to="1"></li>
-->
<!-- 2
							<li data-target="#carouselExampleControls" data-slide-to="2"></li>
-->
<!-- 1
            </ol>
            <div class="carousel-inner" >
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/img1.png" alt="">
				<div class="carousel-caption d-none d-md-block">
                  <h5></h5>
                  <p></p>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/img2.png" alt="">
				<div class="carousel-caption d-none d-md-block">
                  <h5></h5>
                  <p></p>
                </div>				  
              </div>
-->
<!-- 3							
              <div class="carousel-item">
                <img class="d-block w-100" src="images/1920x500.gif" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <h5></h5>
                  <p></p>
                </div>
              </div>
-->
<!-- 1
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
-->	

<!--	
    <h2 class="text-center">Green Office System</h2>	
-->
<div class="container">
<!--	
	<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" id="result">
		</div>
	</div>
-->	
<hr>
    <h2 class="text-center">ระบบฝึกประสบการณ์วิชาชีพ<br>สาขาเทคโนโลยีคอมพิวเตอร์ </h2>	

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <form id="frm_login" action="" method="POST">
        <div class="row">
					<label for="username" class="col-md-4 col-form-label" style="text-align:right">Username : </label>
          <div class="col-md-4">
            <input type="text" id="username" class="form-control" required placeholder="Username"  value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"/>
          </div>
					<div class="col-md-4"> </div>
        </div> 
				<br/>
        <div class="row">
          <label for="password" class="col-md-4 col-form-label" style="text-align:right">Password : </label>
          <div class="col-md-4">
            <input type="password" id="password" class="form-control" required placeholder="Password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"/>
          </div>
					<div class="col-md-4"> </div>
				</div>
<p></p>		  
        <div class="row">
          <div class="col-md-12" style="text-align: center;">
				<input type="checkbox" name="remember" id="remember"
                <?php if(isset($_COOKIE["member_login"])) { ?> checked
                <?php } ?> /> <label for="remember">จำข้อมูลผู้ใช้</label>
          </div>		
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
              <button type="submit" class="btn btn-primary btn-sm" id="btn_login" value="Signin"> เข้าสู่ระบบ </button> 
							<button type="button" class="btn btn-primary btn-sm" id="btn_reg" value="Register"> ลงทะเบียน </button> 
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


 <!-- <footer class="text-center">
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
	
<div class="modal fade" id="model_get_reg" tabindex="-1" role="dialog" aria-labelledby="evidenceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		

      <div class="modal-header">
        <h5 class="modal-title" id="evidenceModalLabel">รายชื่อสำนักงานที่ลงทะเบียนแล้ว <?php echo $row1['total_reg'];?> สำนักงาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

  <div class="row" id="approve_office">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<form name="frmSearch" id="frmSearch" action="" method="post">
	      <div class="row">
			<label for="search_name" class="col-md-4 col-form-label" style="text-align:right">ชื่อหน่วยงาน/บริษัท : </label>
          	<div class="col-md-8">
            	<input type="text" id="search_name" name="search_name" class="form-control" placeholder="ชื่อสำนักงาน" />
			  </br>
          	</div>

          </div> 
			
	      <div class="row">
             <div class="col-md-12" id="office_reg" name="office_reg">
<?php
require_once('./include/connect.php'); 

$sql = "SELECT * FROM office_info WHERE approve='1' ORDER BY approve, office_name";	
$result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
	
?>
<table id="result1" name="result1" width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;">
	<tr align="center" bgcolor="powderblue">
	    <th align="center" width="20%">ลำดับที่</th>
		<th align="center" width="80%">ชื่อสำนักงาน</th>
	</tr>
				 
<?php
$i = 0;
while($list = mysqli_fetch_array($result))
{
$i++;	
?>
	<tr align="right" valign="top">
	  <td  align="center"><?php echo $i;?></td>		
	  <td  align="left"><?php echo $list["office_name"];?></td>
	</tr>				
	
<?php
}
?>
</table>
				 
             </div>
        </div>
			
		
		  </form>
	  </div>
	</div>		
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">ปิด</button>	  
      </div>

    </div>
  </div>
</div>	
</body>
</html>