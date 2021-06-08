<?php session_start(); 
	unset($_SESSION['id']);?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	include 'connectDB.php';


	// username and password empty error
		$usernameErr = $passErr ="";
		$username = $pass =""; 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
  		if (empty($_POST["name"])) {
   		 	$usernameErr = "Name is required";
  		} 
  		else {
   			 $username = test_input($_POST["name"]);
  		}
  
  		if (empty($_POST["pass"])) {
   			 $passErr = "Password is required";
  		} 
  		else {
   			 $password = test_input($_POST["pass"]);
 		 }
 		}
 		function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
 		 return $data;
		}

		// check username and password is valid or not
		$wrong="";
		if(isset($_POST["name"]))
		{
			
			$name = $_POST["name"];
			$pass = $_POST["pass"];
			$sql = "select id from account where username='".$name."'and password='".$pass."';";
			$result = sqlsrv_query($conn,$sql);
			$stmt = sqlsrv_fetch_array($result);
			$row_count = sqlsrv_has_rows($result);
			if($stmt)
			{
				$_SESSION["id"]=$stmt[0];
			}
			if (!$row_count)
				{
					$wrong="Invalid username or password";
				}
				else
				{
					header("Location:home.php");
				}
		}
		
		//include html 

		include 'login.html';
		
	?>
</body>
</html>