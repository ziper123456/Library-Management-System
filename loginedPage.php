<!DOCTYPE html>
<html>
<head>
	<title>
		Welcome
	</title>
	<link rel="stylesheet" type="text/css" href="information.css">
	<script src="https://kit.fontawesome.com/17152ac400.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width= device-width,initial-scale=1.0">
</head>
<body>
	<?php
		session_start(); 
		include'header.html';
		include'connectDB.php';
		$sql="select * from Borrower where id ='".$_SESSION['id']."';";
		$result= sqlsrv_query($conn,$sql);
		if($row= sqlsrv_fetch_array($result))
		{
			$sid=$row['sid'];
			$name=$row['Name'];
			$email=$row['email'];
			$phone=$row['Phone_number'];
			$address=$row['address'];
		}
	?>
	<section style="background-color: cyan">
		<div class="pic">
			<i class="fas fa-user-circle"></i>
		</div>
		<div class="info">
			<h1><?php echo $name ?></h1>
			<h2>Contact Information</h2>
			<div style="background-color: tan">
				<p><i class="fas fa-id-card-alt"></i> Student ID: <?php echo $sid ?></p>
			<p><i class="fas fa-phone-alt"></i> Phone number: <?php echo $phone ?></p>
			<p><i class="fas fa-envelope-open-text"></i> Email: <?php echo $email ?></p>
			<P><i class="fas fa-map-marked-alt"></i> Address: <?php echo $address ?></P>
			</div>
			
		</div>
	</section>
</body>
</html>