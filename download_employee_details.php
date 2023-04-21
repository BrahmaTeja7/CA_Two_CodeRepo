
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
                $table .= "Name \t\t\t";
                $table .= "EPF No \t";
				$table .= "Branch \t\t";
				$table .= "Category \t\t";
				$table .= "Department \t\t\t";
				$table .= "Designation \t\t\t";
				$table .= "Email \t\t\t";
				$table .= "System Login \t";
				$table .= "PC Login \t";
				$table .= "Internet \t";
				$table .= "Mobile \t\t";
				$table .= "Form_No \t";
				$table .= "Status \t\t";
			$table .= "\n";
        while($row = mysqli_fetch_array($result)){
       
                $table .= "". $row['name'] . " \t";
                $table .= "". $row['epf_no'] . " \t";
				$table .= "". $row['branch'] . " \t";
				$table .= "". $row['category'] . " \t";
				$table .= "". $row['department'] . " \t";
				$table .= "". $row['designation'] . " \t";
				$table .= "". $row['email'] . " \t";
				$table .= "". $row['system_login'] . " \t";
				$table .= "". $row['pc_login'] . " \t";
				$table .= "". $row['internet'] . " \t";
				$table .= "". $row['mobile'] . " \t";
				$table .= "". $row['form_no'] . " \t";
				$table .= "". $row['status'] . " \t";
			$table .= "\n";
        }
		
		} else{
        $table .=  "No records matching your query were found.";
    }
	} else{
		$table .=  "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
	
	
	
	//config
		$namefile = "test.txt";
		$content = $table;

		//save file
		$file = fopen($namefile, "w") or die("Unable to open file!");
		fwrite($file, $content);
		fclose($file);

		//header download
		header("Content-Disposition: attachment; filename=\"" . $namefile . "\"");
		header("Content-Type: application/force-download");
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header("Content-Type: text/plain");

		echo $content; 
?>