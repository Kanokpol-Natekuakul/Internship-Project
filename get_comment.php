<?php
  require_once('auth.php');
	require_once('./include/connect.php'); 

if (isset ($_REQUEST['no']) && $_REQUEST['no'] != "") { $no = $_REQUEST['no'] ; } else { $no = ""; }
if (isset ($_REQUEST['year']) && $_REQUEST['year'] != "") { $year = $_REQUEST['year'] ; } else { $year = ""; }
if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { $office_id = $_REQUEST['office_id'] ; } else { $office_id = $_SESSION['SESS_OFFICE_ID']; }
//$office_id = $_SESSION['SESS_OFFICE_ID'];

$comment='';

$sql = <<<SQL
	SELECT * FROM auditing 
	WHERE (
	`chk_listl3_id` = '$no' AND audit_year = $year AND office_id = $office_id 
	)
	ORDER BY auditor_id;			
SQL;
	


  $result = mysqli_query($greenofficedb,$sql) or die(mysqli_error($greenofficedb));
  //$row = mysqli_fetch_array($result);

  while ($row = mysqli_fetch_array($result)) {										
	$comment= $comment."-".$row['auditor_comments']."</br>";	
  }

  echo ($comment);	


?>

