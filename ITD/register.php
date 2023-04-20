<?php
//idea taken from https://www.geeksforgeeks.org/signup-form-using-php-and-mysql-database/   
$showAlert = false; 
$showError = false; 
$exists= false;
    
if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    // Include file which makes the Database Connection.
    $connection = mysqli_connect('localhost', 'root' , '');
	mysqli_select_db($connection,'ITD');

    
    $username = $_POST["username"]; 
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];
	$email = $_POST["email"];
            
    
    $sql = "Select * from user where username='$username'";
    
    $result = mysqli_query($connection, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if the username is already present or not in our Database
    if($num == 0) {
        if(($password == $cpassword) && $exists==false) {
    
            $hash = password_hash($password, PASSWORD_DEFAULT);
                
            // Password Hashing is used here. 
            $sql = "INSERT INTO `user` ( `username`, `password`, `email`) VALUES ('$username','$password', '$email')";
    
            $result = mysqli_query($connection, $sql);
    
            if ($result) {
                $showAlert = true; 
            }
        } 
        else { 
            $showError = "Passwords do not match"; 
        }      
    }// end if 
    
   if($num>0) 
   {
      $exists="Username not available"; 
   } 
    
}//end if   
    
?>

<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php 
	#include('errors.php');
	?>
	<div class="input-group"> 
            <label for="username">Username</label> 
        <input type="text" class="form-control" id="username" name="username">    
        </div>
    
        <div class="input-group"> 
            <label for="password">Password</label> 
            <input type="password" class="form-control"
            id="password" name="password"> 
        </div>
		
        <div class="input-group"> 
            <label for="cpassword">Confirm Password</label> 
            <input type="password" class="form-control"
                id="cpassword" name="cpassword">
    
            <small id="emailHelp" class="form-text text-muted">
            Make sure to type the same password
            </small> 
        </div>      
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" id="email">
		</div>
        <button type="submit" class="btn" name="reg_user" onclick="myFunction()">
        SignUp
        </button> 
		<script>
			function myFunction() {
				alert("Record Added Successfully!");
}
		</script>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>