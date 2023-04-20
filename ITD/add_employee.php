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
  
$connection = mysqli_connect('localhost', 'root' , '');
mysqli_select_db($connection,'ITD');

if(isset($_POST['emp_name']))
{

$name = $_POST["emp_name"];
$epf_no = $_POST["epf_no"];
$branch = $_POST["branch"];
$category = $_POST["category"];
$department = $_POST["department"];
$designation = $_POST["designation"];
$email = $_POST["email"];
$systemlogin = $_POST["systemlogin"];
$pclogin = $_POST["pclogin"];
$internet = $_POST["internet"];
$mobile = $_POST["mobile"];
$status = $_POST["status"];
$remark = $_POST["remark"];
$form_no = $_POST["form_no"];

$sql = "INSERT INTO employee (emp_code, name, epf_no, branch_code, category_code, department_code, designation_code, email, system_login, pc_login, internet, mobile, status, form_no) VALUES (NULL, '$name', '$epf_no', '$branch', '$category', '$department', '$designation', '$email', '$emailtype', '$systemlogin','$pclogin', '$internet', '$mobile', '$status', '$form_no')";

mysqli_query($connection, $sql);
}
?>

<html>
<head>

	<title>Add Employee</title>
	<link rel="stylesheet" type="text/css" href="styles4.css">
	<style>
		
	</style>
</head>
<body>
<div class="header">
	<h2>Add a New Employee</h2>
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
    	<p align="left"><a href="index.php" style="color: blue;">Main Menu</a> | <a href="view_employee.php" style="color: blue;">View All</a> | <a href="search_employee.php" style="color: blue;">Update</a> | <a href="download_employee.php" style="color: blue;">Download</a></p>
    	<p align="right">Welcome, <strong><?php echo $_SESSION['username']; ?></strong> | <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
<form method = "POST" action = "<?php $_PHP_SELF ?>">
<table width = "600" border = "0" cellspacing = "1" cellpadding = "2">
<tr>
<td width = "130">Name</td><td><input name = "emp_name" type = "text" id = "emp_name"></td>
</tr>
<tr>
<td width = "130">EPF No</td><td><input name = "employeeno" type = "text" id = "employeeno"></td>
</tr>
<tr>
<td width = "130">Branch</td>
<td>
<select name="branch" id="branch">
<?php
$resultset1 = "SELECT * FROM branch";
$query1 = mysqli_query($connection, $resultset1);

while($row1 = mysqli_fetch_array($query1)):;

?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php endwhile; ?>
</select>
</td>
</tr>
<tr>
<td width = "130">Category</td><td>
<select name="category" id="category">
<?php
$resultset2 = "SELECT * FROM category";
$query2 = mysqli_query($connection, $resultset2);

while($row1 = mysqli_fetch_array($query2)):;

?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php endwhile; ?>
</select>

</td>
</tr>
<tr>
<td width = "130">Department</td><td>

<select name="department" id="department">
<?php
$resultset3 = "SELECT * FROM department";
$query3 = mysqli_query($connection, $resultset3);

while($row1 = mysqli_fetch_array($query3)):;

?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php endwhile; ?>
</select>
</td>
</tr>
<tr>
<td width = "130">Designation</td><td>
<select name="designation" id="designation">
<?php
$resultset4 = "SELECT * FROM designation";
$query4 = mysqli_query($connection, $resultset4);

while($row1 = mysqli_fetch_array($query4)):;

?>
<option value = "<?php echo $row1[0];?>"> <?php echo $row1[1];?></option>
<?php endwhile; ?>
</select>

</td>
</tr>
<tr>
<td width = "130">Email</td><td><input name = "email" type = "text" id = "email"></td>
</tr>
<td width = "130">System Login</td><td><input name = "scilogin" type = "text" id = "scilogin"></td>
</tr>
<tr>
<td width = "130">PC Login</td><td><input name = "pclogin" type = "text" id = "pclogin"></td>
</tr>
<tr>
<td width = "130">Internet</td>
<td>
<select name="internet" id = "internet">
    <option value="yes">Full Access</option>
    <option value="no">No Access</option>
	<option value="allowed sites">Allowed Sites</option>
</select>
</td>
</tr>
<tr>
<td width = "130">Mobile</td><td><input name = "mobile" type = "text" id = "mobile"></td>
</tr>
<tr>
<tr>
<td width = "130">Form No</td><td><input name = "form_no" type = "text" id = "form_no"></td>
</tr>
<tr>
<td width = "130">Status</td>
<td>
<select name="status" id = "status">
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
</select>
</td>
</tr>
<td width = "130"><input name = "add" type = "submit" id = "add" value = "Submit" >
</td>
</tr>
</form>
</div>
		
    	
    <?php endif ?>
</div>
</body>
</html>