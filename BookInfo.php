<?php 
	session_start();
	include 'connectDB.php';
	if(isset($_SESSION['id']))
	{
		$sql="select BorrowID from BorrowInfo where id='".$_SESSION['id']."';";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$result=sqlsrv_query($conn,$sql,$params,$options);
		$bookborrowed = sqlsrv_num_rows($result);
	}
		
		
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://kit.fontawesome.com/17152ac400.js" crossorigin="anonymous"></script>
	<script src="jQuery/jquery-3.5.1.min.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width= device-width,initial-scale=1.0">
	<title>IU library</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="bookpage.css">
</head>
<script type="text/javascript">
	$(document).ready(function(){
		var book= <?php echo $bookborrowed; ?>;
		$("#btn2").click(function(){
			$(".popup").hide();
		});
		$("#btn3").click(function(){
			$(".popup3").hide();
		});
		$("#btn1").click(function(){
			if(	<?php echo isset($_SESSION['id']) ?> ){
				if(book>=2){
					$(".popup3").show();
				}
				else{
					$(".popup").show();
					var xmlhttp = new XMLHttpRequest();
    				xmlhttp.onreadystatechange = function() {
     			 	if (this.readyState == 4 && this.status == 200) {
       				 	 book++;
     				 }
   					};
    				xmlhttp.open("GET", "BookInfo.php?request=1", true);
    				xmlhttp.send();
				}
				
			}
			else {	
				$(".popup2").show();
			}
		});
	});
</script>
<body>

	<?php
		
		$title=$_GET['title'];
		$sql= "select bid,isbn,Title, AuthorName from Books,Author where Author.AuthourID=Books.AuthorID and Books.Title='".$title."';";
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$result = sqlsrv_query($conn,$sql,$params,$options);
		$row = sqlsrv_fetch_array($result);
		if($row)
		{
			$auname=$row[3];
			$title=$row[2];
			$isbn = $row[1];
			$bid = $row[0];	
		}
		$sql = "select * from BookDetail where bid='".$bid."';";
		$result =sqlsrv_query($conn,$sql);
		if($row=sqlsrv_fetch_array($result))
		{
			$link=$row[1];
            $weight=$row[2];
            $lang=$row[3];
            $publisher=$row[4];
            $pages=$row[5];
            $description=$row[6];
		}
		if(	isset($_SESSION['id']) ){
		$sql="insert into BorrowInfo values(?,?,?,null);";
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$params= array($_SESSION['id'],$bid,date("Y-m-d"));
			if($bookborrowed<2 && isset($_GET['request']) )
		{
			$result=sqlsrv_query($conn,$sql,$params);
		}
		}
		
		include 'header.html'
	 ?>
	
	<section>
		<div class="infomation">
			<div class="picture">
				<img src=<?php echo $link?> alt="picture">
				<button type="submit" id="btn1"> Borrow </button>
			</div>
			<div class="detail-info">
				<div id="title">
					<h1 ><?php echo $title ?></h1>
				</div >
				<div id="author">
					<p> by <?php echo $auname ?> </p>
				</div>
				<div class="description">
					<div>
						<h3>Description</h3>
						<p> <?php echo $description ?></p>
					</div>
					<div class="detail">
						<h3> Book Details</h3>
						<ul>
							<li><strong>Item Weight: </strong> <?php echo $weight ?> </li><br>
							<li><strong>ISBN: </strong> <?php echo $isbn ?></li><br>
							<li><strong>Publisher: </strong><?php echo $publisher ?></li><br>
							<li><strong>Language: </strong><?php echo $lang ?></li><br>
							<li><strong>Pages: </strong><?php echo $pages ?></li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</section>
	<section class="popup">
		<div class="black-ground"></div>
		<div class="box" >
			<h1>Successful</h1>
			<p>You can take this book home</p>
		 	<button id="btn2" type="submit" formaction="admin.php" formmethod="post" >OK</button>
		</div>

	</section>
	<section class="popup2">
		<div class="black-ground"></div>
		<div class="box" >
			<h1>Log in required</h1>
			<p>Please login to borrow this book</p>
			<a href="login.php"> <button >OK</button> </a>	
		</div>

	</section>
	<section class="popup3">
		<div class="black-ground"></div>
		<div class="box" >
			<h1>You reach maximum borrowed books</h1>
			<p>Return books to borrow new one</p>
			<button id="btn3" >OK</button> 	
		</div>

	</section>
</body>
</html>