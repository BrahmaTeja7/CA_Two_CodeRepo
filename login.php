<?php include('config.php')
//some ideas taken from https://www.w3schools.com/
?>
<!DOCTYPE html>
<html>
<head>
  <title>IT Deparment</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="header">
  	<h3>LOGIN</h3>
  </div>
	<form method="post" action="login.php">
  	<?php 
	include('errors.php');
	?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
		<p>
  		Create an Account <a href="register.php">Signup</a>
  	</p>
  	</div>
  	
  </form>
</body>
</html>