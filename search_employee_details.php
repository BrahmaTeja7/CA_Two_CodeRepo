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


$search_Query = "SELECT * FROM employee INNER JOIN branch ON employee.branch_code = branch.branch_code INNER JOIN category ON employee.category_code = category.category_code INNER JOIN designation ON employee.designation_code = designation.designation_code INNER JOIN department ON employee.department_code = department.department_code WHERE epf_no =".$_REQUEST['epf_no'];

$search_Result = mysqli_query($connect, $search_Query);

if($search_Result)
{
if(mysqli_num_rows($search_Result))
{
while($row = mysqli_fetch_array($search_Result))
{
$name = $row['name'];
$epf_no = $row['epf_no'];
$branch = $row['branch'];
$branch_code = $row['branch_code'];
$category = $row['category'];
$category_code = $row['category_code'];
$department = $row['department'];
$department_code = $row['department_code'];
$designation = $row['designation'];
$designation_code = $row['designation_code'];
$email = $row['email'];
$system_login = $row['system_login'];
$pclogin = $row['pc_login'];
$internet = $row['internet'];
$mobile = $row['mobile'];
$status = $row['status'];
}
}
}

?>

<html>
<head>
<style>
	
	</style>
	<title>Add Employee</title>
	<link rel="stylesheet" type="text/css" href="styles4.css">
</head>
<body>

<div class="header">
	<h2>Edit an Employee</h2>
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
    	<p align="left"><a href="index.php" style="color: blue;">Main Menu</a> | <a href="view_employee.php" style="color: blue;">View All</a> | <a href="add_employee.php" style="color: blue;">Add</a> | <a href="download_employee.php" style="color: blue;">Download</a></p>
    	<p align="right">Welcome, <strong><?php echo $_SESSION['username']; ?></strong> | <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
<form method = "POST" action = "update_employee_details.php">
<table width = "600" border = "0" cellspacing = "1" cellpadding = "2">

<tr>
<td width = "130">EPF No</td><td><input name = "epf_no" type = "text" value = "<?php echo $epf_no ?>"></td>
</tr>

<tr>
<td width = "130">Name</td><td><input name = "emp_name" type = "text" value = "<?php echo $name ?>"></td>
</tr>

<tr>
<td width = "130">Branch</td>
<td>
<select name="branch">
<option value = "<?php echo $branch_code; ?>"> <?php echo $branch; ?></option>
<?php
$resultset1 = "SELECT * FROM branch";
$query1 = mysqli_query($connect, $resultset1);

while($row1 = mysqli_fetch_array($query1)):;
{
if($row1[1] != $branch)
{
?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php 
}
}
endwhile; ?>
</select>
</td>
</tr>
<tr>
<td width = "130">Category</td><td>
<select name="category" value="<?php echo $category ?>">
<option value = "<?php echo $category_code; ?>"> <?php echo $category; ?></option>
<?php
$resultset2 = "SELECT * FROM category";
$query2 = mysqli_query($connect, $resultset2);

while($row1 = mysqli_fetch_array($query2)):;
{
if($row1[1] != $category)
{
?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php 
}
}
endwhile; ?>
</select>

</td>
</tr>
<tr>
<td width = "130">Department</td><td>

<select name="department">
<option value = "<?php echo $department_code; ?>"> <?php echo $department;?></option>
<?php
$resultset3 = "SELECT * FROM department";
$query3 = mysqli_query($connect, $resultset3);

while($row1 = mysqli_fetch_array($query3)):;
{
if($row1[1] != $department)
{
?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php 
}
}
endwhile; ?>
</select>
</td>
</tr>
<tr>
<td width = "130">Designation</td><td>
<select name="designation">
<option value = "<?php echo $designation_code; ?>"> <?php echo $designation;?></option>
<?php
$resultset4 = "SELECT * FROM designation";
$query4 = mysqli_query($connect, $resultset4);

while($row1 = mysqli_fetch_array($query4)):;
{
if($row1[1] != $designation)
{
?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php 
}
}
endwhile; ?>
</select>

</td>
</tr>
<tr>
<td width = "130">Email</td><td><input name = "email" type = "text" value = "<?php echo $email ?>"></td>
</tr>
<tr>
<td width = "130">System Login</td><td><input name = "system_login" type = "text" value = "<?php echo $system_login ?>"></td>
</tr>
<tr>
<td width = "130">PC Login</td><td><input name = "pclogin" type = "text" value = "<?php echo $pclogin ?>"></td>
</tr>
<tr>
<td width = "130">Internet</td>
<td>
<select name="internet" value = "<?php echo $internet ?>">
	<option value="<?php echo $internet ?>"><?php echo $internet ?></option>
    <option value="yes">Full Access</option>
    <option value="no">No Access</option>
	<option value="allowed sites">Allowed Sites</option>
</select>
</td>
</tr>
<tr>
<td width = "130">Mobile</td><td><input name = "mobile" type = "text" value = "<?php echo $mobile ?>"></td>
</tr>
<tr>
<td width = "130">Status</td>
<td>
<select name="status" value = "<?php echo $status ?>">
	<option value="<?php echo $status ?>"><?php echo $status ?></option>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
</select>
</td>
</tr>

<td width = "130"><input name = "update" type = "submit" id = "update" value = "Update"></td>
</tr>
</form>
</div>
		
    	
    <?php endif ?>
</div>
</body>
</html>