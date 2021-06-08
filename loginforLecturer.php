<!DOCTYPE html>
<html>
<head>
	<title>Welcome, Lecturer</title>
	<link rel="stylesheet" type="text/css" href="teacherlogin.css">
</head>
<body>
		<form method="post" action="">
			<h1>Welcome Lecturer</h1><br>
			<label>Username:</label>
			<input type="text" name="username" placeholder="username"><br>
			<label>Password:</label>
			<input type="password" name="password" placeholder="password"><br>
			<button type="submit" name="btn" >Log in</button>
		</form>
		<?php 
		if(isset($_POST['username']&&isset($password)))
		$sql="select * from account where username='".$_POST['username']."'and password='".$password."';";
		$result = sqlsrv_query($conn,$sql);
		if($row=sqlsrv_has_row($result))
		{
			
		}
	 ?>
</body>
</html>