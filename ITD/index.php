<?php 
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
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="styles2.css">
</head>
<body>

<div class="header">
	<h2>IT DEPARTMENT</h2>
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
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
		<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<style>
				#grid {
						  display: grid;
						  grid-template-rows: repeat(1, 1fr);
						  grid-template-columns: repeat(3, 1fr);
						  grid-gap: 10px;
						}
						#grid > div {
						font-family: "Courier New";
						background-color: #808080	;
						color: white	;
						font-size: 2vw;
						padding: 10px;
						}
			</style>
			<div id="grid">
			  <div align="center"><img src="pictures/employees.png" style="float:center;width:100px;height:100px;"><br><a href="view_employee.php">EMPLOYEE DATA MANAGEMENT</a></div>
			  <div align="center"><img src="pictures/incidents.png" style="float:center;width:100px;height:100px;"><br><a href="#">INCIDENT MANAGEMENT</a></div>
			  <div align="center"><img src="pictures/hardware.png" style="float:center;width:100px;height:100px;"><br><a href="#">HARDWARE MANAGEMENT</a></div>

			</div>
</div>
		
    	
    <?php endif ?>
</div>
		
</body>
</html>