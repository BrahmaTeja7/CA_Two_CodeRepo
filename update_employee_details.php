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

$sql = "UPDATE 
			employee 
		SET 
			name ='".$_POST['emp_name']."',
			branch_code =".$_POST['branch'].",
			category_code =".$_POST['category'].",
			department_code =".$_POST['department'].",
			designation_code =".$_POST['designation'].",
			email ='".$_POST['email']."',
			system_login ='".$_POST['system_login']."',
			pc_login ='".$_POST['pclogin']."',
			internet ='".$_POST['internet']."',
			mobile ='".$_POST['mobile']."',
			status ='".$_POST['status']."'
		WHERE epf_no=".$_POST['epf_no'];

$update_qry = mysqli_query($connect, $sql);

if($update_qry)
{
	$epf_no = $_POST['epf_no'];
	header("Location: http://localhost/ITD/search_employee_details.php?epf_no=$epf_no");
}
