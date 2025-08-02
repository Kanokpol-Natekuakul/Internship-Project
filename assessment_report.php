<!doctype html>
<?php
$connection=mysqli_connect("localhost","root","123456789","train");
    ?>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ระบบฝึกประสบการณ์วิชาชีพ V.1.0.0</title>
<style>
        @media print {
            /* Hide everything except the table and header */
            body * {
                visibility: hidden;
            }
            #printHeader, #printHeader *, #printTable, #printTable * {
                visibility: visible;
            }
            #printHeader {
                position: absolute;
                top: 0;
                width: 100%;
                text-align: center;
            }

            #printTable {
                position: absolute;
                left: 0;
                top: 100px; /* Adjust position of the table below the header */
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center; /* Center horizontally */
                align-items: center; /* Center vertically if needed */
                text-align: center; /* Center the text */
            }

            table {
                margin: 0 auto; /* Ensure table is centered horizontally */
                width: 80%; /* Adjust this width as per your requirement */
            }
        }
    </style>
<!-- Bootstrap -->
<link href="css/bootstrap-4.2.1.css" rel="stylesheet">
<!-- Include your custom CSS file -->
<link href="css/main.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.2.1.js"></script>	
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
    <div id="printHeader">
    <hr>
    <h2 class="text-center">รายงานแบบประเมินผลการฝึกประสบการณ์วิชาชีพ</h2>	
		<hr></div>
        <div class="container">
	
        <?php
echo '<div id="printTable">';
echo "DATE : ".date('d - m - Y');
echo '</div ">';
?></br>
<form method="POST" action="">
        <!-- Dropdown for Internship Location -->
        <label for="search_std_id">ค้นหารหัสนักศึกษา: </label>
        <input type="text" id="search_std_id" name="search_std_id" placeholder="กรอกรหัสนักศึกษา">


        <!-- Dropdown for Class Group -->
        <label for="search_group">ค้นหาหมู่เรียน: </label>
        <select id="search_group" name="search_group">
            <option value="">เลือกหมู่เรียน</option>
            <?php
            // Fetch available class groups from the database
            $groups = mysqli_query($connection, "SELECT DISTINCT std_group FROM assessment_staff");
            while ($group = mysqli_fetch_array($groups)) {
                echo "<option value='{$group['std_group']}'>{$group['std_group']}</option>";
            }
            ?>
        </select>

        <!-- Dropdown for Internship Location -->
        <label for="search_location">ค้นหาสถานที่ฝึกงาน: </label>
        <select id="search_location" name="search_location">
            <option value="">เลือกสถานที่ฝึกงาน</option>
            <?php
            // Fetch available internship locations from the database
            $locations = mysqli_query($connection, "SELECT DISTINCT office_id, office_name FROM office_info");
            while ($location = mysqli_fetch_array($locations)) {
                echo "<option value='{$location['office_id']}'>{$location['office_name']}</option>";
            }
            ?>
        </select>
       

       
      

        

        <!-- Submit Button -->
        <input type="submit" value="ค้นหา">
    </form>
    

<button onclick="window.print()">PRINT
    
</button>


<?php
 $search_conditions = [];

 // Check if any search option is selected
 if (!empty($_POST['search_location'])) {
     $search_location = $_POST['search_location'];
     $search_conditions[] = "`office_id` = '$search_location'";
 }

 if (!empty($_POST['search_group'])) {
     $search_group = $_POST['search_group'];
     $search_conditions[] = "`std_group` = '$search_group'";
 }

 if (!empty($_POST['search_std_id'])) {
     $search_std_id = $_POST['search_std_id'];
     $search_conditions[] = "`std_id` = '$search_std_id'";
 }

 // Build the query based on selected filters
 $query = "SELECT * FROM `assessment_staff`";
 if (count($search_conditions) > 0) {
     $query .= " WHERE " . implode(" AND ", $search_conditions);
 }

 // Execute the query
 $std = mysqli_query($connection, $query);
  


$count   = mysqli_num_rows($std);
echo '<div id="printTable">';
echo "</br>$count Records found<br><br>"; 
echo '<table width="100%" border="1" bordercolor="gray" style="border-collapse:collapse;">';
echo '<tr align="center" bgcolor="powderblue">';
echo "<th>รหัสนักศึกษา</th>";
echo "<th>คำนำหน้า</th>";
echo "<th>ชื่อ</th>";
echo "<th>นามสกุล</th>";
echo "<th>หมู่เรียน</th>";
echo "<th>ปีการศึกษา</th>";
echo "<th>ที่ฝึกงาน</th>";
echo "<th>คะแนน</th>";
echo "<th>พี่เลี้ยง</th>";
echo "</tr>";

while($row = mysqli_fetch_array($std)) {
    $office_id = $row['office_id'];
    $office_name = mysqli_query($connection,"SELECT office_name FROM office_info WHERE office_id = '$office_id'  ");
    $office_info = mysqli_fetch_array($office_name);
    $staff_name = mysqli_query($connection,"SELECT staff_name,staff_prefix FROM staff_info WHERE staff_id = '{$row['staff_id']}'  ");
    $staff_info = mysqli_fetch_array($staff_name);
   // $name = mysqli_query($connection,"SELECT name FROM `user` WHERE id = '{$row['auditor_id']}'   ");
   // $user = mysqli_fetch_array($name);
    

 
echo "<tr>";
echo "<td align='center'>{$row['std_id']}</td>";
echo "<td>{$row['std_prefix']}</td>";
echo "<td>{$row['std_name']}</td>";
echo "<td>{$row['std_sname']}</td>";
echo "<td align='center'>{$row['std_group']}</td>";
echo "<td align='center'>{$row['std_term']}/{$row['std_year']}</td>";
echo "<td align='center'>{$office_info['office_name']}</td>";
echo "<td align='center'>{$row['total_score']}</td>";
echo "<td align='center'>{$staff_info['staff_prefix']} {$staff_info['staff_name']}</td>";
echo "</tr>";
}
echo "</table>";
echo '</div>'; 

?>  

        </div>


</body>
</html>