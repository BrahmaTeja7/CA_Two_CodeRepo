
<?php 

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
  
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "ITD";

	$connect = mysqli_connect($host, $user, $password, $database);
	
	$branch_id = (isset($_POST['branch'])) ? $_POST['branch'] : "";
	$category_id = (isset($_POST['category'])) ? $_POST['category'] : "";
	$department_id = (isset($_POST['department'])) ? $_POST['department'] : "";

?>


<html>
<head>
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
	<title>Download Employee</title>
	<link rel="stylesheet" type="text/css" href="styles3.css">
</head>
<body>

<div class="header">
	<h2>Download Employee Details</h2>
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
    	<p align="left"><a href="index.php" style="color: blue;">Main Menu</a> | <a href="view_employee.php" style="color: blue;">View All</a> | <a href="add_employee.php" style="color: blue;">Add</a> | <a href="search_employee.php" style="color: blue;">Update</a></p>
    	<p align="right">Welcome, <strong><?php echo $_SESSION['username']; ?></strong> | <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
 
    <p>Please select one or more :</p>
    <form  method="POST" action="download_employee.php" id="search">
	
	<table>
		<tr>
			<td width = "130">Branch</td>
			<td>
				<select name="branch" style="width:180px">
					<option value = ""></option>
					<?php
						$bra_qry = "SELECT * FROM branch";
						$branch = mysqli_query($connect, $bra_qry);

						while($b = mysqli_fetch_array($branch)):;
						{
							if($b[0] == $branch_id){
					?>
							<option value = "<?php echo $b[0];?>" selected=""> <?php echo $b[1];?></option>
					<?php   }else{ ?>		
							<option value = "<?php echo $b[0];?>"> <?php echo $b[1];?></option>
					<?php
							}
						}
					endwhile; ?>
			</select>
			</td>
		</tr>
		<tr>
			<td width = "130">Category</td>
			<td>
				<select name="category" style="width:180px">
					<option value = ""></option>
					<?php
						$cat_qry = "SELECT * FROM category";
						$category = mysqli_query($connect, $cat_qry);

						while($c = mysqli_fetch_array($category)):;
						{
							if($c[0] == $category_id){
					?>
							<option value = "<?php echo $c[0];?>" selected=""> <?php echo $c[1];?></option>
					<?php   }else{ ?>		
							<option value = "<?php echo $c[0];?>"> <?php echo $c[1];?></option>
					<?php
							}
						}
					endwhile; ?>
			</select>
			</td>
		</tr>
		<tr>
			<td width = "130">Department</td>
			<td>
				<select name="department" style="width:180px">
					<option value = ""></option>
					<?php
						$dep_qry = "SELECT * FROM department";
						$department = mysqli_query($connect, $dep_qry);

						while($d = mysqli_fetch_array($department)):;
						{
						if($d[0] == $department_id){
					?>
							<option value = "<?php echo $d[0];?>" selected=""> <?php echo $d[1];?></option>
					<?php   }else{ ?>		
							<option value = "<?php echo $d[0];?>"> <?php echo $d[1];?></option>
					<?php
							}
						}
					endwhile; ?>
			</select>
			</td>
		</tr>
		<tr>
			<td><input  type="submit" name="search" value="Search"></td>
		</tr>
	</table>
	
    </form>
	
	<form  method="POST" action="download_employee_details.php" id="search2">
		<input  type="hidden" name="branch" value="<?php echo $branch_id; ?>">
		<input  type="hidden" name="category" value="<?php echo $category_id; ?>">
		<input  type="hidden" name="department" value="<?php echo $department_id; ?>">
		&nbsp;<input  type="submit" name="download" value="Download">
	</form>
	</div>
	
<?php 
		$cond=" 1=1";
		
		if($branch_id!=""){
			$cond .= " AND employee.branch_code=".$branch_id;
		}
		
		if($category_id!=""){
			$cond .= " AND employee.category_code=".$category_id;
		}
		
		if($department_id!=""){
			$cond .= " AND employee.department_code=".$department_id;
		}
		
		$sql = "SELECT 
					* 
				FROM 
					employee 
				  INNER JOIN branch ON employee.branch_code = branch.branch_code 
				  INNER JOIN category ON employee.category_code = category.category_code 
				  INNER JOIN designation ON employee.designation_code = designation.designation_code 
				  INNER JOIN department ON employee.department_code = department.department_code
				WHERE $cond";
				
		$result = mysqli_query($connect,$sql);
		$table="";
		
		
		if($result){
			if(mysqli_num_rows($result) > 0){
        $table .= "<table width: 100%>";
            $table .= "<tr>";
                //$table .= "<th>Emp_ID</th>";
                $table .= "<th>Name</th>";
                $table .= "<th>EPF No</th>";
				$table .= "<th>Branch</th>";
				$table .= "<th>Category</th>";
				$table .= "<th>Department</th>";
				$table .= "<th>Designation</th>";
				$table .= "<th>Email</th>";
				$table .= "<th>System Login</th>";
				$table .= "<th>PC Login</th>";
				$table .= "<th>Internet</th>";
				$table .= "<th>Mobile</th>";
				$table .= "<th>Form_No</th>";
				$table .= "<th>Status</th>";
			$table .= "</tr>";
        while($row = mysqli_fetch_array($result)){
            $table .= "<tr>";
                //$table .= "<td>" . $row['emp_code'] . "</td>";
                $table .= "<td>" . $row['name'] . "</td>";
                $table .= "<td>" . $row['epf_no'] . "</td>";
				$table .= "<td>" . $row['branch'] . "</td>";
				$table .= "<td>" . $row['category'] . "</td>";
				$table .= "<td>" . $row['department'] . "</td>";
				$table .= "<td>" . $row['designation'] . "</td>";
				$table .= "<td>" . $row['email'] . "</td>";
				$table .= "<td>" . $row['system_login'] . "</td>";
				$table .= "<td>" . $row['pc_login'] . "</td>";
				$table .= "<td>" . $row['internet'] . "</td>";
				$table .= "<td>" . $row['mobile'] . "</td>";
				$table .= "<td>" . $row['form_no'] . "</td>";
				$table .= "<td>" . $row['status'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table>";
		echo ($table);
    } else{
        echo "No records matching your query were found.";
    }
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}

	endif ?>
</div>
  </body>
</html>