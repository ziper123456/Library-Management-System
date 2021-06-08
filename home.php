<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://kit.fontawesome.com/17152ac400.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width= device-width,initial-scale=1.0">
</head>
<body>
	<?php 
		session_start();
		if(isset($_SESSION["id"]))
		{
			$id=$_SESSION["id"];
		}
		else{
			header("location:login.php");
		}
		include'connectDB.php';
		$sql = "select Name from Borrower where id ='".$id."';" ;
		$result = sqlsrv_query($conn,$sql);
		if ($result===false){
			echo "Invalid query";
		}
		else if( sqlsrv_fetch( $result) === false) {
     		echo"no fetch";
		}
		else{
			$name =sqlsrv_get_field($result,0);
		}
		if(isset($_GET["keyword"]))
		{
			$keyword = $_GET["keyword"];
			$sql= " select bid from Books where Books.Title like '%".$keyword."%' ;";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$result = sqlsrv_query($conn,$sql,$params,$options);
			if($result===false)
			{
				echo "wrong sql";
			}
			else{
				$_SESSION['keyword']=$_GET["keyword"];
				header('location:searchpage.php');
			}
		}
		$sql="select * from category;";
		$result= sqlsrv_query($conn,$sql);
		$category = array();
		$i=0;
		while($row=sqlsrv_fetch_array($result))
		{
			$category[$i]=$row['cate_name'];
			$i++;
		}
			$_SESSION['catename']= $category;
		$sql="select * from category;";
		$result= sqlsrv_query($conn,$sql);
		$category = array();
		$i=0;
		while($row=sqlsrv_fetch_array($result))
		{
			$category[$i]=$row['cate_name'];
			$i++;
		}
			$_SESSION['catename']= $category;
		include 'homepage.html';
	?>
</body>
</html>