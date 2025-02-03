<?php
require_once('./include/connect.php'); 
								
if (isset ($_REQUEST['std_id']) && $_REQUEST['std_id'] != "") { $std_id = $_REQUEST['std_id'] ; } else { $std_id = ""; }
if (isset ($_REQUEST['std_prefix']) && $_REQUEST['std_prefix'] != "") { $std_prefix = $_REQUEST['std_prefix'] ; } else { $std_prefix = ""; }
if (isset ($_REQUEST['std_name']) && $_REQUEST['std_name'] != "") { $std_name = $_REQUEST['std_name'] ; } else { $std_name = ""; }
if (isset ($_REQUEST['std_sname']) && $_REQUEST['std_sname'] != "") { $std_sname = $_REQUEST['std_sname'] ; } else { $std_sname = ""; }
if (isset ($_REQUEST['std_group']) && $_REQUEST['std_group'] != "") { $std_group = $_REQUEST['std_group'] ; } else { $std_group = ""; }
if (isset ($_REQUEST['office_id']) && $_REQUEST['office_id'] != "") { $office_id = $_REQUEST['office_id'] ; } else { $office_id = ""; }
if (isset ($_REQUEST['first_day']) && $_REQUEST['first_day'] != "") { $first_day = $_REQUEST['first_day'] ; } else { $first_day = ""; }
if (isset ($_REQUEST['last_day']) && $_REQUEST['last_day'] != "") { $last_day = $_REQUEST['last_day'] ; } else { $last_day = ""; }
if (isset ($_REQUEST['q1']) && $_REQUEST['q1'] != "") { $q1 = $_REQUEST['q1'] ; } else { $q1 = ""; }
if (isset ($_REQUEST['q2']) && $_REQUEST['q2'] != "") { $q2 = $_REQUEST['q2'] ; } else { $q2 = ""; } 
if (isset ($_REQUEST['q3']) && $_REQUEST['q3'] != "") { $q3 = $_REQUEST['q3'] ; } else { $q3 = ""; }
if (isset ($_REQUEST['q4']) && $_REQUEST['q4'] != "") { $q4 = $_REQUEST['q4'] ; } else { $q4 = ""; }
if (isset ($_REQUEST['q5']) && $_REQUEST['q5'] != "") { $q5 = $_REQUEST['q5'] ; } else { $q5 = ""; }
if (isset ($_REQUEST['q6']) && $_REQUEST['q6'] != "") { $q6 = $_REQUEST['q6'] ; } else { $q6 = ""; }
if (isset ($_REQUEST['q7']) && $_REQUEST['q7'] != "") { $q7 = $_REQUEST['q7'] ; } else { $q7 = ""; }
if (isset ($_REQUEST['q8']) && $_REQUEST['q8'] != "") { $q8 = $_REQUEST['q8'] ; } else { $q8 = ""; }
if (isset ($_REQUEST['q9']) && $_REQUEST['q9'] != "") { $q9 = $_REQUEST['q9'] ; } else { $q9 = ""; }
if (isset ($_REQUEST['q10']) && $_REQUEST['q10'] != "") { $q10 = $_REQUEST['q10'] ; } else { $q10 = ""; }
if (isset ($_REQUEST['q11']) && $_REQUEST['q11'] != "") { $q11 = $_REQUEST['q11'] ; } else { $q11 = ""; }
if (isset ($_REQUEST['q12']) && $_REQUEST['q12'] != "") { $q12 = $_REQUEST['q12'] ; } else { $q12 = ""; }
if (isset ($_REQUEST['q13']) && $_REQUEST['q13'] != "") { $q13 = $_REQUEST['q13'] ; } else { $q13 = ""; }
if (isset ($_REQUEST['q14']) && $_REQUEST['q14'] != "") { $q14 = $_REQUEST['q14'] ; } else { $q14 = ""; }
if (isset ($_REQUEST['comment_a']) && $_REQUEST['comment_a'] != "") { $comment_a = $_REQUEST['comment_a'] ; } else { $comment_a = ""; }
if (isset ($_REQUEST['id']) && $_REQUEST['id'] != "") { $id = $_REQUEST['id'] ; } else { $id = ""; }
if (isset ($_REQUEST['office_conpassword']) && $_REQUEST['staff_conpassword'] != "") { $office_conpassword = $_REQUEST['office_conpassword'] ; } else { $office_conpassword = ""; }
if (isset ($_REQUEST['act']) && $_REQUEST['act'] != "") { $act = $_REQUEST['act'] ; } else { $act = ""; }
$total_score = $q1 + $q2 + $q3 + $q4+ $q5+ $q6+ $q7+ $q8+ $q9+ $q10+ $q11+ $q12+ $q13+ $q14;
$sql = "";	




	
$sql = <<<SQL
	INSERT INTO assessment_auditor( 
		std_id,
        std_prefix,
        std_name,
		std_sname,
        std_group,
        office_id,
        first_day,
        last_day,
        q1,
        q2,
        q3,
        q4,
        q5,
        q6,
        q7,
        q8,
        q9,
        q10,
        q11,
        q12,
        q13,
        q14,
        comment_a,
        id,
        total_score
		) VALUES (
		'$std_id',
        '$std_prefix',
        '$std_name',
        '$std_sname',
        '$std_group',
        '$office_id',
        '$first_day',
        '$last_day',
        '$q1',
        '$q2',
        '$q3',
        '$q4',
        '$q5',
        '$q6',
        '$q7',
        '$q8',
        '$q9',
        '$q10',
        '$q11',
        '$q12',
        '$q13',
        '$q14',
        '$comment_a',
        '$id',
        '$total_score'
        	
	);			
SQL;

//echo $sql;
$result = mysqli_query($traindb,$sql) or die(mysqli_error($traindb));			
			
echo (1);			

?>				
		
