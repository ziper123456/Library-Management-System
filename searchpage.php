<?php session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://kit.fontawesome.com/17152ac400.js" crossorigin="anonymous"></script>
	<script src="jQuery/jquery-3.5.1.min.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width= device-width,initial-scale=1.0">
	<link rel="stylesheet" href="searchpage.css">
	<title>IU library</title>

</head>
<body>
	<header>
		<div class="container">
			<div class="insider">
				<div class="logo">
					<a href="web.php"><img src="picture/logo.jpg" alt="logo" ></a>
				</div>
				<div class="search-area">
					<form method="get" action="#" >
						<input type="text" name="keyword">
						<button type="submit"  ><i class="fas fa-search"></i></button>
					</form>
				</div>
				
			</div>
		</div>
	</header>
	
	<?php
	include'connectDB.php'; 
	

		if(isset($_SESSION['keyword']))
		{
			
			
			$sql= " select bid from Books where Books.Title like '%".$_SESSION['keyword']."%' ;";
		
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$result = sqlsrv_query($conn,$sql,$params,$options);
			
			if($result===false)
			{
				echo "wrong sql";
			}
			else{
				if($true=sqlsrv_has_rows($result))
				{
					$id = array();
					$i=0;
					while ($row=sqlsrv_fetch_array($result)) {
					$sql2= "select * from Books where bid = '".$row['bid']."';";
					$result2 = sqlsrv_query($conn,$sql2);
					$sql3 = "select * from BookDetail where bid = '".$row['bid']."';";
					$result3 = sqlsrv_query($conn,$sql3);
					while ($row2=sqlsrv_fetch_array($result2)) {
						
						while ( $row3=sqlsrv_fetch_array($result3)) {
							$id[$i]= $row2['bid'];
							include 'result.html';
							$i++;
						}
						
					}
				}
				$_SESSION['bid']= $id;
			}
			}
			
		}
		 if (isset($_GET['keyword'])) {
			# code...
			unset($_SESSION['keyword']);
			unset($_SESSION['bid']);
			$keyword = $_GET["keyword"];
			$sql= " select bid from Books where Books.Title like '%".$keyword."%' ;";
			$params = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$result = sqlsrv_query($conn,$sql,$params,$options);
			if ($result===false)
			{
				echo "wrong sql";
			}
			if ($true=sqlsrv_has_rows($result)) {
				# code...
				$id = array();
					$i=0;
					while ($row=sqlsrv_fetch_array($result)) {
					$sql2= "select * from Books where bid = '".$row['bid']."';";
					$result2 = sqlsrv_query($conn,$sql2);
					$sql3 = "select * from BookDetail where bid = '".$row['bid']."';";
					$result3 = sqlsrv_query($conn,$sql3);
					while ($row2=sqlsrv_fetch_array($result2)) {
						
						while ( $row3=sqlsrv_fetch_array($result3)) {
							$id[$i]= $row2['bid'];
							include 'result.html';
							$i++;
						}
					}
			}
			$_SESSION['bid']= $id;
		}
	}
	 include'footer.html';
	 ?>
</body>
</html>