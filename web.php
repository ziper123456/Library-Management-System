<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>IU library</title>
</head>
<body>
	<div>
		<?php
			include 'connectDB.php';
		//name
			unset($_SESSION['id']);
		//seacrh bar	
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
		include 'library.html';
		?>
	</div>
</body>
</html>