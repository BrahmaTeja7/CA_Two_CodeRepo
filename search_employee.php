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

?>


<html>
<head>
<style>
	
	</style>
	<title>Search an Employee</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	
</head>
<body>

<div class="header">
	<h2>Search an Employee</h2>
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
 
    <p>Please enter the Employee number :</p>
    <form  method="POST" action="search_employee_details.php" id="search">
      
		<select name="epf_no">
		<option value = ""></option>
		<?php
		$resultset1 = "SELECT epf_no FROM employee";
		$query1 = mysqli_query($connect, $resultset1);

		while($row1 = mysqli_fetch_array($query1)):;
		{
				?>
		<option value = "<?php echo $row1['epf_no'];?>"> <?php echo $row1['epf_no'];?></option>
		<?php 
		}
		endwhile; ?>
		</select>
      <input  type="submit" name="search" value="Search">
    </form>
	
	</div>
		
    	
    <?php endif ?>
</div>
  </body>
</html>
