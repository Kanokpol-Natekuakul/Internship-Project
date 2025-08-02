<?php 
  require_once('auth_auditor.php');
  require_once('./include/connect.php'); 

  date_default_timezone_set('Asia/Bangkok');
  $date = date('Y-m-d H:i:s');
		
		$sql_chsch = "SELECT * FROM schedule WHERE year = '".$_SESSION['SESS_YEAR']."';";

        $result_chsch = mysqli_query($greenofficedb,$sql_chsch) or die(mysqli_error($greenofficedb));
		$row_chsch = mysqli_fetch_array($result_chsch);
		//$st_selfass = date_create($row_chsch['st_selfass']);
		//$en_selfass = date_create($row_chsch['en_selfass']);					
		$st_audit = $row_chsch['st_audit'];
		$en_audit = $row_chsch['en_audit'];					

		//$cur_date = "2020-08-22 00:00:00";
		//$cur_date = new DateTime("now");
		//$cur_date = date('Y-m-d H-i-s', time());	
		$cur_date = $date;
		if (($cur_date<$st_audit) || ($cur_date>$en_audit))  {		
			header("location: main_auditor.php");
			exit();
		} 



  if (isset ($_REQUEST['l3']) && $_REQUEST['l3'] != "") { 
		$l3 = $_REQUEST['l3']; 
		
		$sql_l3 = "SELECT chk_listl1.chk_listl1_id, chk_listl3.*  FROM `chk_listl3` 
INNER JOIN chk_listl2 ON chk_listl2.chk_listl2_id = chk_listl3.chk_listl2_id
INNER JOIN chk_listl1 ON chk_listl1.chk_listl1_id = chk_listl2.chk_listl1_id
WHERE chk_listl3_id = '$l3';";
    $result_l3 = mysqli_query($greenofficedb,$sql_l3) or die(mysqli_error($greenofficedb));
		$row_l3 = mysqli_fetch_array($result_l3);
		$l2 = $row_l3['chk_listl2_id'];
		$l1 = $row_l3['chk_listl1_id'];
			
	} else { $l3 = ""; }


  if (isset ($_REQUEST['l3']) && $_REQUEST['l3'] != "") { 
		$l3 = $_REQUEST['l3']; 
	    $year = substr($l3,0,4);
		
		$sql_l3 = "SELECT chk_listl1.chk_listl1_id, chk_listl3.*  FROM `chk_listl3` 
INNER JOIN chk_listl2 ON chk_listl2.chk_listl2_id = chk_listl3.chk_listl2_id
INNER JOIN chk_listl1 ON chk_listl1.chk_listl1_id = chk_listl2.chk_listl1_id
WHERE chk_listl3_id = '$l3';";
    $result_l3 = mysqli_query($greenofficedb,$sql_l3) or die(mysqli_error($greenofficedb));
		$row_l3 = mysqli_fetch_array($result_l3);
		$l2 = $row_l3['chk_listl2_id'];
		$l1 = $row_l3['chk_listl1_id'];
			
	} else { 
	  $l3 = ""; 
	  if (isset ($_REQUEST['year']) && $_REQUEST['year'] != "") { 
		  $year = $_REQUEST['year'] ;
	  } else {
	  	  $year = $_SESSION['SESS_YEAR'];
	  }
  }

  if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { 
		$office_id = $_REQUEST['office_id'] ;
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
<script src="js/blockui-master/jquery.blockUI.js"></script>
	
<script type="text/javascript">
var evidenceid;

$(function() {      
  $('#year').prop('readonly', true);
  $('#chk_listl3_moredetail').prop('readonly', true);
  $('#chk_listl3_evi_detail').prop('readonly', true);
  $("#evidence_file").hide();
	$("#evidence_link").hide();
	
  $("#navbarDropdown").show();
  //$("#result").hide();
	
	/*
	$("#btn_ok").click(function(e) {	
		alert($("#frm_office_self input[id=point_detail_no]:checked").val()+" "+$("#frm_office_self select[id=chk_listl3_id]").val());

		
		$.ajax ({
			type: "POST", 
			url: "exe_office_self.php" , 
			cache: false, 
			async: false, 							
			data:  {
							act: "insert",
							self_score:$("#frm_office_self input[id=point_detail_no]:checked").val(),
							chk_listl3_id:$("#frm_office_self select[id=chk_listl3_id]").val()
						},
			success: function(data) {	
				
				if (data == 1) {																	
					$("#result").html("ส่งข้อมูลสำหรับลงทะเบียนเรียบร้อย กรุณารอการอนุมัติจากผู้ดูแลระบบ ภายใน 24 ชั่วโมง"); 
					$("#result").show();
					$("#btn_reg_ok").show();									
					$("#frm_register")[0].reset();	
					$("#register").hide();
				}	
				else {
					$("#result").show();	
					$("#result").html(data); 
				}
				
			}
		});	
	
		
	});	
*/
	
	$("#evidence_type_id").change(function() {
		//alert($("#chk_listl1").val());
		var evidence_type_id = $("#evidence_type_id").val();	
		//var selectVal = $('#chk_listl1_id :selected').text();
    if (evidence_type_id == '1') {
				$("#evidence_file").show();
			  $("#evidence_f").prop('required',true);
				$("#evidence_link").hide();			
			  $("#evidence_l").removeAttr('required');
		}
    else if (evidence_type_id == '2') {
				$("#evidence_file").hide();
			  $("#evidence_f").removeAttr('required');
				$("#evidence_link").show();			
			  $("#evidence_l").prop('required',true);
		}	
		else {
				$("#evidence_file").hide();
			  $("#evidence_f").removeAttr('required');
				$("#evidence_link").hide();		
			  $("#evidence_l").removeAttr('required');
		}	
				
  });	
	
  $("#chk_listl1_id").change(function() {
		//alert("<?php echo $office_id; ?>");
		var chk_listl1_id = $("#chk_listl1_id").val();	
		//var selectVal = $('#chk_listl1_id :selected').text();
	  
		$.ajax ({
			type: "POST", 
			url: "getchk_listl2_audit.php" , 
			cache: false, 
			data: {
						chk_listl1_id:chk_listl1_id,
					    office_id:$("#frm_audit select[id=office_id]").val()
						},
			success: function(data) {
				$('#chk_listl2_id').html(data);
				reset_chk_listl3();
				$('#chk_listl3_moredetail').val("");
				$('#chk_listl3_evi_detail').val("");
				$('#point_detail').html("");
				$('#auditor_comments').val("");
			}
		});	
  });	

  $("#chk_listl2_id").change(function() {
		//alert($("#form1 select[id=chk_listl1_id]").val());
		var chk_listl2_id = $("#chk_listl2_id").val();
		$.ajax ({
			type: "POST", 
			url: "getchk_listl3.php" , 
			cache: false, 
			data:  {
							 chk_listl2_id:chk_listl2_id
						 },
			success: function(data) {
				$('#chk_listl3_id').html(data);
				$('#chk_listl3_moredetail').val("");
				$('#chk_listl3_evi_detail').val("");
				$('#point_detail').html("");
				$('#auditor_comments').val("");
				pre_sar();
						}	
		});	
  });	

  $("#chk_listl3_id").change(function() {
		//alert($("#form1 select[id=chk_listl1_id]").val());
		//alert($("#district_id").val());
		var year = $("#year").val();
		var chk_listl3_id = $("#chk_listl3_id").val();
		
		$.ajax ({
			type: "POST", 
			url: "getchk_listl3_detail.php" , 
			cache: false, 
			data:  {
							 chk_listl3_id:chk_listl3_id,
							 year:$("#year").val()	
						 },
			success: function(data) {
							data = jQuery.parseJSON(data);
							$('#chk_listl3_moredetail').val(data[0].chk_listl3_moredetail);	
							$('#chk_listl3_evi_detail').val(data[0].chk_listl3_evi_detail);
							//$('#chk_listl3_moredetail').val(data);	
							//$('#auditor_comments').val("");
							//alert(chk_listl3_id);
				
							$.ajax ({
								type: "POST", 
								url: "get_point_detail_audit.php" , 
								cache: false, 
								data:  {
												 chk_listl3_id:chk_listl3_id,
									             office_id:$("#frm_audit select[id=office_id]").val(),
												 year:$("#year").val()	
											 },
								success: function(data) {
									//alert(chk_listl3_id);
											 $('#point_detail').html(data);
											 //if (chk_listl3_id == ""){
											 //	 $("textarea[id=auditor_comments]").val("");
											 //}
											 pre_sar();
											 window.location.href="#arc_point_detail";
										}	
								});	
				
				
						}	
		});					

		
  });	

	$("#frm_audit").on('submit',(function(e) {
	e.preventDefault();
if ($('input[name=point_detail_no_audit]:checked').val() == null) {
		$("#modelwarning").find('.modal-body').text('กรุณาใส่คะแนนที่ประเมิน');
		$("#modelwarning").modal('show');
		//alert('กรุณาใส่คะแนนประเมินตนเอง');
	} else { 

    $.ajax({
			 url: "upload_self_audit.php",
			 type: "POST",
			 data: new FormData(this),
			 contentType: false,
						 cache: false,
			 processData: false,
			 beforeSend : function()
					 {
						$("#preview_sar").fadeOut();
						$("#err").fadeOut();
						 
						$.blockUI({ css: {
															border: 'none',
															padding: '15px',
															backgroundColor: '#000','-webkit-border-radius': '10px','-moz-border-radius': '10px',opacity: .5,
															color: '#fff'
															} ,
											 message: '<h1>กำลังส่งข้อมูล...</h1>' }); 
											 
			 },
		
   success: function(data)
      {
				if(data != '1')
				{
				 // invalid file format.
				 $("#err").html(data).fadeIn();
				 $.unblockUI();
				}
				else
				{
				 // view uploaded file.
				 //$("#preview").html(data).fadeIn();
			
				 pre_sar();
				 //$("#frm_office_self")[0].reset(); 
				 //$('#point_detail').html("");
				 $("#preview_sar").html(data).fadeIn();
				 $.unblockUI();
				 $("#evidence_type_id").val('');
				 $("#evidence_file").hide();
			     $("#evidence_f").removeAttr('required');
				 $("#evidence_f").val('');
				 $("#evidence_link").hide();		
			     $("#evidence_l").removeAttr('required');
				 $("#evidence_l").val('');
				 $("#modelok").modal('show');
				}
      },
    error: function(e) 
      {
    		$("#err").html(e).fadeIn();
      }          
    });

	}

 }));
	
	$("#btn_delete").on("click", function(){
    //callback(false);
		//alert(evidenceid);
    $("#deleteEvidence").modal('hide');
		
		$.ajax({
			 url: "del_evidence.php",
			 type: "POST",
			 data:  {
								evidence_id: evidenceid
							},
			 cache: false,
			 success: function(data)
					{
						 pre_sar();
						 $("#preview_sar").html(data).fadeIn();				
					}         
  	});	
		
  });
	
	$("#del_self_ass").on("click", function(){
			$("#deleteSelfAss").modal('show');	
  });
	
	$("#btn_del_self_ass").on("click", function(){
    //callback(false);
		//alert(evidenceid);
    $("#deleteSelfAss").modal('hide');
		var chk_listl3_id = $("#chk_listl3_id").val();
		//alert($("#frm_audit select[id=office_id]").val());
		//alert(chk_listl3_id);
		
		$.ajax({
			 url: "del_audit_ass.php",
			 type: "POST",
			 data:  {
				 			 office_id:$("#frm_audit select[id=office_id]").val(),
							 chk_listl3_id:chk_listl3_id,
							 year:$("#year").val()	
							},
			 cache: false,
			 success: function(data)
					{			
						 location.reload();
						 pre_sar();
						 $("#preview_sar").html(data).fadeIn();
					}         
  	});	
		
  });
	
	$("#office_id").change(function() {
		//alert($("#chk_listl1").val());
		//var office_id = $("#office_id").val();	
		//alert(office_id);
				//$('#chk_listl2_id').html(data);
				$("#chk_listl1_id").val("");
				$("#chk_listl2_id").val("");
				$("#chk_listl3_id").val("");
				//reset_chk_listl3();
				$('#chk_listl3_moredetail').val("");
				$('#chk_listl3_evi_detail').val("");
				$('#point_detail').html("");
				$('#auditor_comments').val("");	
				$('#preview_sar').html("");
/*		
		$.ajax({
			 url: "set_ses_office_id.php",
			 type: "POST",
			 data:  {
							 office_id:$("#office_id").val()		
							},
			 cache: false,
				 success: function(data)
					{
							$.ajax ({
								type: "POST", 
								url: "get_point_detail.php" , 
								cache: false, 
								data:  {
												 chk_listl3_id:chk_listl3_id,
												 year:$("#year").val()	
											 },
								success: function(data) {
											 $('#point_detail').html(data);
											 pre_sar();
											 window.location.href="#arc_point_detail";
										}	
								});		
					}   
  	});	
*/	
 });	
	
});
	
function reset_chk_listl3() {
	var chk_listl2_id = $("#chk_listl2_id").val();
	$.ajax ({
		type: "POST", 
		url: "getchk_listl3.php" , 
		cache: false, 
		data:  {
						 chk_listl2_id:chk_listl2_id
					 },
		success: function(data) {
			$('#chk_listl3_id').html(data);
			pre_sar();
					}	
	});	
}
	
function pre_sar() {
	//alert($("#office_id").val());
	if ($("#office_id").val() != "") {	
		var chk_listl3_id = $("#chk_listl3_id").val();
		$.ajax({
			 url: "set_ses_office_id.php",
			 type: "POST",
			 data:  {
							 office_id:$("#office_id").val()		
							},
			 cache: false,
				 success: function(data)
					{
							$.ajax ({
								type: "POST", 
								url: "get_evidence.php" , 
								cache: false, 
								data:  {
												 chk_listl3_id:chk_listl3_id,
												 year:$("#year").val()	
											 },
								success: function(data) {
									$('#preview_sar').html(data);
											}	
							});		
					}   
  	});			
	} else {
		
	}

	
	

}

function has_l3() {

		//alert($("#form1 select[id=chk_listl1_id]").val());
		//alert($("#district_id").val());
		var year = $("#year").val();
		var chk_listl3_id = $("#chk_listl3_id").val();
		
		$.ajax ({
			type: "POST", 
			url: "getchk_listl3_detail.php" , 
			cache: false, 
			data:  {
							 chk_listl3_id:chk_listl3_id,
							 year:$("#year").val()	
						 },
			success: function(data) {
							data = jQuery.parseJSON(data);
							$('#chk_listl3_moredetail').val(data[0].chk_listl3_moredetail);	
							$('#chk_listl3_evi_detail').val(data[0].chk_listl3_evi_detail);
							//$('#chk_listl3_moredetail').val(data);	
							//$('#auditor_comments').val("");
							//alert(chk_listl3_id);
				
							$.ajax ({
								type: "POST", 
								url: "get_point_detail_audit.php" , 
								cache: false, 
								data:  {
												 chk_listl3_id:chk_listl3_id,
									             office_id:$("#frm_audit select[id=office_id]").val(),
												 year:$("#year").val()	
											 },
								success: function(data) {
									//alert(chk_listl3_id);
											 $('#point_detail').html(data);
											 //if (chk_listl3_id == ""){
											 //	 $("textarea[id=auditor_comments]").val("");
											 //}
											 pre_sar();
											 window.location.href="#arc_point_detail";
										}	
								});	
				
				
						}	
		});				
}
	
function delevidence(evidence_id) {	
	evidenceid = evidence_id;
	$("#deleteEvidence").modal('show');	
}	
	
	
</script>
	
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
       <a class="navbar-brand" href= "main_auditor.php">Green Office</a>
			
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
                ยินดีต้อนรับ, <?php echo $_SESSION['SESS_AUDITOR_NAME']; ?>
                </a>
                
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="edt_aud_profile.php">ข้อมูลผู้ตรวจประเมิน</a>
					<a class="dropdown-item" href="edt_aud_passwd.php">เปลี่ยนรหัสผ่าน</a>									
                </div>
             </li>
			<?php
			  if (($cur_date>=$st_audit) && ($cur_date<=$en_audit)) {
			?>				  
			 <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">การตรวจประเมินสำนักงานสีเขียว
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   	<a class="dropdown-item" href="audit.php">การตรวจประเมินโดยผู้ตรวจประเมิน ปี <?php echo $_SESSION['SESS_YEAR']; ?> </a>
					<a class="dropdown-item" href="main_auditor.php">สรุปผลการตรวจประเมินโดยผู้ตรวจประเมิน ปี <?php echo $_SESSION['SESS_YEAR']; ?> </a>
                </div>
             </li>
			  <?php
			  }
			  ?>			  
			 <li class="nav-item">
                <a class="nav-link" href="logout.php">ออกจากระบบ</a>
             </li>				
             <li class="nav-item active">
                <a class="nav-link" href="audit_manual_v1.pdf" target="_blank">คู่มือการใช้งานสำหรับ Auditor<span class="sr-only">(current)</span></a>
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
    <h2 class="text-center">การตรวจประเมินโดยผู้ตรวจประเมิน</h2>	
    <hr>
	
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

      <form id="frm_audit" action="" method="POST"  enctype="multipart/form-data">
        <div class="row">
					<label for="year" class="col-md-4 col-form-label" style="text-align:right">ปีที่ประเมิน <label style="color:red">*</label> : </label>
          <div class="col-md-4">
            <input type="text" id="year" name="year" class="form-control" required placeholder="ปีที่ประเมิน" value="<?php echo $year; ?>" />
          </div>
					<div class="col-md-4"> </div>
        </div> 
	
        <div class="row">
					<label for="office_id" class="col-md-4 col-form-label" style="text-align:right">สำนักงานที่ตรวจประเมิน <label style="color:red">*</label> : </label>
          <div class="col-md-8">
						<select class="form-control" id="office_id" name="office_id" required>
							<option value="">--เลือกสำนักงานที่ตรวจประเมิน--</option>
								<?php
									require_once('./include/connect.php');
									//$year = $_SESSION['SESS_YEAR'];
									$auditor_id = $_SESSION['SESS_AUDITOR_ID'];
									$sql = "SELECT audit_office.office_id AS office_id, office_info.office_name AS office_name
													FROM audit_office
													INNER JOIN office_info
													ON audit_office.office_id = office_info.office_id
													WHERE audit_office.audit_year = '$year' and audit_office.auditor_id = '$auditor_id'
													ORDER BY office_info.office_name ASC";
									$res = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
									while ($row1 = mysqli_fetch_array($res)) {
										if ($row1['office_id'] == $office_id) { 
											echo "<option value ='$row1[office_id]' selected=\"selected\">$row1[office_name]</option>";
										} else {
											echo "<option value ='$row1[office_id]'>$row1[office_name]</option>";
										}
									}
							    
								?>
						</select>
          </div>
        </div> 
				
				<div class="row">
					<label for="chk_listl1" class="col-md-4 col-form-label" style="text-align:right">หมวด <label style="color:red">*</label> : </label>
          <div class="col-md-8">
						<select class="form-control" id="chk_listl1_id" name="chk_listl1_id" required>
							<option value="">--เลือกหมวด--</option>
								<?php
									require_once('./include/connect.php');
									//$year = $_SESSION['SESS_YEAR'];
									$sql = "SELECT * FROM `chk_listl1` WHERE chk_list_year = '$year' ORDER BY `chk_listl1_id` ASC";
									$res = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
									while ($row1 = mysqli_fetch_array($res)) {
										/*
											$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
											echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
										*/
										if ($row1['chk_listl1_id'] == $l1) { 
											echo "<option value ='$row1[chk_listl1_id]' selected=\"selected\">$row1[chk_listl1_detail]</option>";
										} else {
											echo "<option value ='$row1[chk_listl1_id]'>$row1[chk_listl1_detail]</option>";
										}
									}
							    
								?>
						</select>
          </div>
        </div> 
				
				<div class="row">
					<label for="chk_listl2_id" class="col-md-4 col-form-label" style="text-align:right">ประเด็น <label style="color:red">*</label> : </label>
          <div class="col-md-8">
						<select class="form-control" id="chk_listl2_id" name="chk_listl2_id" required>
							<option value="">--เลือกประเด็น--</option>
								<?php
									require_once('./include/connect.php');
									if ($l2 <> ''){

			$chk_reg_green = "SELECT * FROM `reg_green` where `office_id` = '".$office_id."' and `year` = '".$year."'";	
			$res_chk_reg_green = mysqli_query($greenofficedb,$chk_reg_green) or die(mysqli_error($greenofficedb));
			$num_rows_chk_reg_green = mysqli_num_rows($res_chk_reg_green); 	
	        if($num_rows_chk_reg_green == 1)  {
				$reg_green = mysqli_fetch_array($res_chk_reg_green);
				$type_cer = $reg_green['type_cer'];
			} else {
				$type_cer = '0';
			}										
											$sql = "SELECT * FROM `chk_listl2` WHERE chk_listl1_id = '$l1' ORDER BY `chk_listl2_id` ASC";
											$res = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
											while ($row1 = mysqli_fetch_array($res)) {
	if ($row1['chk_listl2_id'] == ($year."-1-7")) {
	   if ($type_cer != '1') {											
												/*
													$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
													echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
												*/
												if ($row1['chk_listl2_id'] == $l2) { 
													echo "<option value ='$row1[chk_listl2_id]' selected=\"selected\">$row1[chk_listl2_detail]</option>";
												} else {
													echo "<option value ='$row1[chk_listl2_id]'>$row1[chk_listl2_detail]</option>";
												}
							} 
	} else {
												if ($row1['chk_listl2_id'] == $l2) { 
													echo "<option value ='$row1[chk_listl2_id]' selected=\"selected\">$row1[chk_listl2_detail]</option>";
												} else {
													echo "<option value ='$row1[chk_listl2_id]'>$row1[chk_listl2_detail]</option>";
												}
		
	}
											}
									}
								?>							
						</select>
          </div>
        </div> 
				
				<div class="row">
					<label for="chk_listl3_id" class="col-md-4 col-form-label" style="text-align:right">ตัวชี้วัด <label style="color:red">*</label> : </label>
          <div class="col-md-8">
						<select class="form-control" id="chk_listl3_id" name="chk_listl3_id" required>
							<option value="">--เลือกตัวชี้วัด--</option>
								<?php
									require_once('./include/connect.php');
									if ($l3 <> ''){
											$sql = "SELECT * FROM `chk_listl3` WHERE chk_listl2_id = '$l2' ORDER BY `chk_listl3_id` ASC";
											$res = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
											while ($row1 = mysqli_fetch_array($res)) {
												/*
													$selected = ($val == $row1['chk_listl1_id'] ? 'selected="selected"' : '');
													echo '<option value ="' . $row1['chk_listl1_id'] . '" '. $selected .'>' . $row1['chk_listl1_detail'] . '</option>';
												*/
												if ($row1['chk_listl3_id'] == $l3) { 
													echo "<option value ='$row1[chk_listl3_id]' selected=\"selected\">$row1[chk_listl3_detail]</option>";
												} else {
													echo "<option value ='$row1[chk_listl3_id]'>$row1[chk_listl3_detail]</option>";
												}
											}
											echo("<script type=\"text/javascript\">");
    									echo("has_l3();");
    									echo("</script>");
								
									}
								?>								
						</select>
          </div>
        </div> 
				
				<a id="arc_point_detail"></a>	
	      <div class="row">
					<label for="chk_listl3_moredetail" class="col-md-4 col-form-label" style="text-align:right">รายละเอียดตัวชี้วัด : </label>
          <div class="col-md-8">
            <textarea rows="10" id="chk_listl3_moredetail" name="chk_listl3_moredetail" class="form-control"> </textarea>
          </div>
        </div> 
				<br/>	
	      <div class="row">
					<label for="chk_listl3_evi_detail" class="col-md-4 col-form-label" style="text-align:right">หลักฐานการตรวจประเมิน : </label>
          <div class="col-md-8">
            <textarea rows="10" id="chk_listl3_evi_detail" name="chk_listl3_evi_detail" class="form-control"> </textarea>
          </div>
        </div> 
				<br/>					
	      <div class="row">
					<label for="point_detail" class="col-md-4 col-form-label" style="text-align:right">คะแนนที่ประเมิน <label style="color:red">*</label> : </label>
          <div class="col-md-8" id="point_detail" name="point_detail" >
            
          </div>
        </div> 
	
	      <div class="row">
					<label for="audit_comment" class="col-md-4 col-form-label" style="text-align:right">หลักฐานการตรวจประเมินจากกรรมการ / ข้อเสนอแนะ : </label>
          <div class="col-md-8">
            <textarea rows="10" id="auditor_comments" name="auditor_comments" class="form-control"> </textarea>
          </div>
        </div> 	
		        <br/>

      <div class="row text-center">
        <div class="col-md-12 pb-1 pb-md-0">
<div id="err"></div>					
<div id="preview_sar"></div>
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
<!--							
							<button type="button" class="btn btn-primary btn-sm" id="btn_ok" value="Register"> บันทึก </button> 
-->							
							<input class="btn btn-danger" type="button" id='del_self_ass' value="ลบการประเมินของตัวชี้วัดนี้">
							<input class="btn btn-success" type="submit" value="บันทึก">
<!--				
							<input class="btn btn-danger" type="button" id='del_self_ass' value="ลบตัวชี้วัด">
						  
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
<div class="modal fade" id="deleteEvidence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ยืนยันการลบข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ต้องการลบหลักฐานรายการนี้
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary" id="btn_delete" >ลบ</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteSelfAss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ยืนยันการลบข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				ต้องการลบการประเมินของตัวชี้วัดนี้ </br>
				- สถานะตัวชี้วัดข้อนี้จะกลายเป็น ยังไม่ถูกประเมิน ท่านสามารถเข้ามาประเมินใหม่ได้</br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary" id="btn_del_self_ass" >ลบ</button>
      </div>
    </div>
  </div>
</div>
	
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

<div class="modal fade" id="modelok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">บันทึกข้อมูลเรียบร้อย</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ตกลง</button>
      </div>
    </div>
  </div>
</div>	
	
</body>
</html>