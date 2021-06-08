<?php session_start(); 
	$id=$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>IU Library</title>
	<link rel="stylesheet" type="text/css" href="booklistpage.css">
	<script src="jQuery/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">
	 	$(document).ready(function(){
	 		$("#home").click(function(){
	 			$("#book-content").hide();
	 			$("#home-content").show();
	 		});
	 		$("#book").click(function(){
	 			$("#book-content").show();
	 			$("#home-content").hide();
	 		});
	 	});
	 </script>
</head>
<body>
	<?php include 'header.html' ;
		include'connectDB.php';
		$i=0;
		$sql="select Title,imagelink from Books,BookDetail,category where category.cate_id=Books.cate_id and Books.bid=BookDetail.bid and category.cate_name='".$_SESSION['catename'][$id]."';";
		$result= sqlsrv_query($conn,$sql);
		while ($row=sqlsrv_fetch_array($result)) {
			# code...
			$title[$i]=$row['Title'];
			$link[$i]=$row['imagelink'];
			$i++;
		}

		?>

	<div class="title">
		<h1><?php echo $_SESSION['catename'][$id] ?></h1>
		<hr>
		<nav class="shotcut">
			<a href="home.php">Home Page</a>/<a href="#"><?php echo $_SESSION['catename'][$id] ?></a>
		</nav>
	</div>
	<div class="body">
		<section class="home">
		<div class="nav-link">
			<a href="#" id="home">Home</a>
		</div>
		<div id="home-content" >
			<div class="content" >
			<div class="inside-content">
				<div class="head-content" > something</div>
				<h2>Welcome</h2>
				<p>Welcome to IU Library Guide! In this guide you will find relevant resources on<strong> <?php echo $_SESSION['catename'][$id] ?></strong>. Please use the tabs on the left side to navigate<strong> books, journals, thesis,</strong> or <strong>patents,...</strong></p>
			</div>
		</div>
		<div class="content" >
			<div class="inside-content">
				<div class="head-content" > something</div>
				<h2>Featured books</h2>
				<nav class="book-info" >
					<?php for($i=0;$i<count($title);$i++)
					{
						echo"<div class='detail'>
						<img src=".$link[$i]." alt='picture'>
						<a href='Bookinfo.php?title=$title[$i]'>".$title[$i]."</a>
					</div>";
					} ?>
					

				</nav>
			</div>
		</div>
		</div>
		
	</section>
	<section class="book">
		<div class="nav-link">
			<a href="#" id="book">Books</a>
		</div>
		<div id="book-content">
			<div class="content" >
			<div class="inside-content">
				<div class="head-content" > something</div>
				<h2>Books</h2>
				<label >Search Library Catalog</label><br>
				<input type="text" name="search" formmethod="get">
			</div>
		</div>
		<div class="content" >
			<div class="inside-content">
				<div class="head-content" > something</div>
				<h2>Featured books</h2>
				<nav class="book-info" >
					<?php for($i=0;$i<count($title);$i++)
					{
						echo"<div class='detail'>
						<img src=".$link[$i]." alt='picture'>
						<a href=''>".$title[$i]."</a>
					</div>";
					} ?>

				</nav>
			</div>
		</div>
		</div>
		
	</section>
	</div>
</body>
</html>