<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		include'connectDB.php'; 
		

		if(isset($_GET["keyword"]))
		{
			$keyword = $_GET["keyword"];
			$sql= " select Title from Books where Title like '%".$keyword."%'; ";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$result = sqlsrv_query($conn,$sql,$params,$options);
			$count = sqlsrv_num_rows($result);
			if($result===false)
			{
				echo "wrong sql";
			}
		}
		
	?>
</body>
</html>