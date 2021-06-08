<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
</head>
<body>
	<?php
		include 'connectDB.php';
		if(isset($_POST["submit"]))
		{
		$name= $_POST["name"];
		$email=$_POST["email"];
		$sid =$_POST["sid"];
		$address=$_POST["address"];
		$username=$_POST["Uname"];
		$pass=$_POST["password"];
		$phone=$_POST["phone"];
		$sql= "insert into Borrower values (?,?,?,?,?);";
		$params= array($sid,$name,$email,$address,$phone);
		$result= sqlsrv_query($conn,$sql,$params);	
		if($result===false)
		{
			echo "Invalid sql";
		}
		$sql2 = " insert into account values(?,?);";
		$params2= array($username,$pass);
		$result2= sqlsrv_query($conn,$sql2,$params2);
		if($result2===false)
		{
			echo "Invalid sql number2";
		}
		}
		include 'signup.html';
	 ?>
</body>
</html>