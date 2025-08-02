<?php
	session_start();
	if (isset ($_REQUEST['year']) && $_REQUEST['year'] != "") { $year = $_REQUEST['year'] ; } else { $year = ""; }
//	$_SESSION['SESS_SEL_YEAR_PAST'] = $year;

									require_once('./include/connect.php');
									//$year = $_SESSION['SESS_SEL_YEAR_PAST'];
									//$year = $_SESSION['SESS_SEL_YEAR'];
									$sql = "SELECT * FROM `chk_listl1` WHERE chk_list_year = '$year' ORDER BY `chk_listl1_id` ASC";
									$res = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
									echo "<option value=\"\">--เลือกหมวด--$year</option>";	
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