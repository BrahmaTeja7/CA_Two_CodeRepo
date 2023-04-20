<?php 
//some ideas taken from https://www.w3schools.com/
	error_reporting(E_ALL ^ E_NOTICE);
    session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Employee</title>
	<link rel="stylesheet" type="text/css" href="styles3.css">
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			font-size:13px;
		}

		tr:nth-child(even){background-color: #f2f2f2}

		th {
			background-color: #B2B7B3;
			color: black;
		}
	</style>
</head>
<body>
<div class="header">
	<h2>View All Employees</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p align="left"><a href="index.php" style="color: blue;">Main Menu</a> | <a href="add_employee.php" style="color: blue;">Add</a> | <a href="search_employee.php" style="color: blue;">Update</a> | <a href="download_employee.php" style="color: blue;">Download</a></p>
    	<p align="right">Welcome, <strong><?php echo $_SESSION['username']; ?></strong> | <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
	<?php 
		include('config.php');
		
		$sql = "SELECT * FROM employee INNER JOIN branch ON employee.branch_code = branch.branch_code INNER JOIN category ON employee.category_code = category.category_code INNER JOIN designation ON employee.designation_code = designation.designation_code INNER JOIN department ON employee.department_code = department.department_code";
		if($result = mysqli_query($db,$sql)){
			if(mysqli_num_rows($result) > 0){
        echo "<table width: 100%>";
            echo "<tr>";
                //echo "<th>Emp_ID</th>";
                echo "<th>Name</th>";
                echo "<th>EPF No</th>";
				echo "<th>Branch</th>";
				echo "<th>Category</th>";
				echo "<th>Department</th>";
				echo "<th>Designation</th>";
				echo "<th>Email</th>";
				echo "<th>System Login</th>";
				echo "<th>PC Login</th>";
				echo "<th>Internet</th>";
				echo "<th>Mobile</th>";
				echo "<th>Form_No</th>";
				echo "<th>Status</th>";
			echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                //echo "<td>" . $row['emp_code'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['epf_no'] . "</td>";
				echo "<td>" . $row['branch'] . "</td>";
				echo "<td>" . $row['category'] . "</td>";
				echo "<td>" . $row['department'] . "</td>";
				echo "<td>" . $row['designation'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['system_login'] . "</td>";
				echo "<td>" . $row['pc_login'] . "</td>";
				echo "<td>" . $row['internet'] . "</td>";
				echo "<td>" . $row['mobile'] . "</td>";
				echo "<td>" . $row['form_no'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
			echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($db);
?>
</div>
		
    	
    <?php endif ?>
</div>
		
</body>
</html>