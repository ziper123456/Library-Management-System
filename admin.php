<!DOCTYPE html>
<html>
<head>
	<script src="https://kit.fontawesome.com/17152ac400.js" crossorigin="anonymous"></script>
	<title>Welcome admin</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
	 <script src="jQuery/jquery-3.5.1.min.js"></script>
	 <script type="text/javascript">
	 	$(document).ready(function(){
	 		$("#dashboard").click(function(){
	 			$(".container4").hide(500);
	 			$(".dashboard").show(500);
	 			$("#request").hide(500);
	 		});
	 		$("#addbtn").click(function(){
	 			$(".container4").show(500);
	 			$(".dashboard").hide(500);
	 			$("#request").hide(500);
	 		});
	 		$("#requestbtn").click(function(){
	 			$(".container4").hide(500);
	 			$(".dashboard").hide(500);
	 			$("#request").show(500);
	 		});
	 		$("#more-info").click(function(){
	 			$(".container4").hide(500);
	 			$(".dashboard").hide(500);
	 			$("#request").show(500);
	 		});
	 	});
	 </script>
	 <?php 
	 	include 'connectDB.php';
	 	$sql = "insert into Author values(?,?);";
	 	if(isset($_POST['authorID']))
	 	{
	 		$auname= $_POST['bookauthor'];
	 		$auID= $_POST['authorID'];
	 		$params=array($auID,$auname);
	 		$result =sqlsrv_query($conn,$sql,$params);
	 		if($result===false)
	 		{
	 			echo "cannot add author";
	 		}
	 	}
	 	$sql =" insert into Books values(?,?,?,?,?,?);";
	 	if (isset($_POST['bookID'])) {
	 		# code...
	 		$bid=$_POST['bookID'];
	 		$title=$_POST['booktitle'];
	 		$isbn =$_POST['bookisbn'];
	 		$date = $_POST['publishdate'];
	 		$type =$_POST['booktype'];
	 		$auID= $_POST['authorID'];
	 		$params= array($bid,$isbn,$title,$auID,$date,$type);
	 		$result=sqlsrv_query($conn,$sql,$params);
	 		if($result===false)
	 		{
	 			echo "cannot add Book";
	 		}
	 	}
	 	$sql="insert into BookDetail values(?,?,?,?,?,?,?,DEFAULT,2);";
	 	if (isset($_POST['subbtn'])) {
	 		# code...
	 		$bookid=$_POST['bookID'];
	 		$title = $_POST['booktitle'];
	 		$link = "picture/".$_POST['bookimage'];
	 		$publisher =$_POST['bookpub'];
	 		$page=$_POST['bookpages'];
	 		$lang=$_POST['booklang'];
	 		$weight=$_POST['bookweight'];
	 		$des=$_POST['bookdes'];


	 		$params=array($bookid,$link,$weight,$lang,$publisher,$page,$des);
	 		$result=sqlsrv_query($conn,$sql,$params);
	 	}
	 	$i=0;
	 	$sql="select * from BorrowInfo";
	 	$result= sqlsrv_query($conn,$sql);
	 		while ($row= sqlsrv_fetch_array($result))
	 		{
	 			$requestID[$i]= $row['BorrowID'];
	 			$userID[$i]= $row['id'];
	 			$bid[$i] = $row['bid'];
	 			$date[$i] = $row['borrow_date'];
	 			$i++;
	 		}
	 	$sql="select BorrowID from BorrowInfo;";
	 	$result=sqlsrv_query($conn,$sql);
	 	$NoOfBook= sqlsrv_has_rows($result);
	  ?>
</head>
<body>
	<header>
		<div class="container">
			<span class="logo">
				<img src="picture/logo.jpg">
			</span>
		</div>
		<ul class="menu">
				<li> 
					<a href="#" id="dashboard"><b>Dash Board</b></a> 
				</li>
				<li > 
					<a href="#"><b>Book <i class="fas fa-caret-down"></i></b></a> 
					<div class="service-dropdown">
						<a href="#" id="addbtn"> Add Book </a>
						<a href="#"> Modify Book</a>
					</div>
				</li>
				<li> 
					<a href="#"><b>Account <i class="fas fa-caret-down"></i></b></a> 
					<div class="service-dropdown">
						<a href="Signup.php"> Register for student </a>
						<a href="#"> Remove account</a>
						<a href="#"> Account management</a>
					</div>
				</li>
				<li> 
					<a href="#" id="requestbtn"><b> Request</b></a> 
				</li>
		</ul>
	</header>
	<section>
		<div class="dashboard">
			<div class="icon"><i class="fas fa-caret-up"></i></div>
			<h1>Dash Board</h1>
			<span class="display-block">
				<h1><?php echo $NoOfBook ?></h1>
				<p style="font-size: 25px;margin: 50px 0">New Borrow request:</p>
				<i class="fas fa-plus"></i>
				<div class="more-info"><a  href="#" id="more-info" >More info</a><i class="fas fa-info-circle"></i></div>
			</span>
		</div>
		<div class="addbook">
			<?php include'addbook.html' ?>
		</div>
		<div class="request" id="request">
			<i class="fas fa-caret-up"></i>
			<h1 style="margin: 50px 600px ;font-size: 50px" >Request</h1>
			<table class="request-info">
				<tr>
					<th>Request ID</th>
					<th>Borrower ID</th>
					<th>Book ID</th>
					<th>Request Date</th>
					<th>Due Date</th>
					<th>Status</th>
				</tr>
				<tr>
					<td><?php
					for ($i=0; $i < count($requestID); $i++) { 
						# code...
						echo $requestID[$i];
					}
					  
					 ?></td>
					<td><?php for ($i=0; $i < count($userID); $i++) { 
						# code...
						echo $userID[$i];
					} ?></td>
					<td><?php for ($i=0; $i < count($bid); $i++) { 
						# code...
						echo $bid[$i];
					} ?></td>
					<td><?php for ($i=0; $i < count($date); $i++) { 
						# code...
						echo $date[$i]->format('Y-m-d');
					}
					 ?></td>
				</tr>
			</table>
		</div>
	</section>
</body>
</html>