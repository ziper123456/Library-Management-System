<!DOCTYPE html>
<html>
<head>
	<title>Sign up page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/17152ac400.js" crossorigin="anonymous"></script>
	<script src="jQuery/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#btn1").click(function(){
				submit();
				$(".container").hide("fast",function(){
					$(".container2").css("left","30%");
				});
			});
			$("p").click(function(){
				$(".container2").css("left","150%");
				$(".container").show();
			});
		});
	</script>
	<style type="text/css">
		body{
			background: url(picture/background2.jpg) no-repeat;
			background-size: cover;
			overflow: hidden;
		}
		.container{
			display: flex;
			flex-flow: column;
			position: absolute;
			background-color: white;
			opacity: 0.8;
			top: 10%;
			left: 30%;
			border-radius: 20px;
			box-shadow: 10px 10px 10px black;
		}
		.container2{
			display: flex;
			flex-flow: column;
			position: absolute;
			background-color: white;
			opacity: 0.8;
			top: 20%;
			left: 120%;
			border-radius: 20px;
			width: 40%;
			box-shadow: 10px 10px 10px black;
			transition-duration: 0.5s;
		}
		h1{
			margin:30px 220px;
			color: blue;
		}
		.textbox{
			color:black;
			outline: none;
			background: none;
			font-family: Times;
			font-size: 25px;
			border-radius: 20px;
			margin: 0 30px;
			
		}
		i{
			color: blue;
		}
		button{
			position: relative;
			height: 40px;
			width: 50%;
			left: 25%;
			border-radius: 20px;
			margin: 10px;
			text-transform: uppercase;
			outline: none;
			background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA  51%, #77A1D3  100%);
			transition: 0.5s;
			font-family: Times;
			color:white;
			background-size: 200% auto;
		}
		button:hover{
			background-position: left; /* change the direction of the change here */
            color: black;
            text-decoration: none;
		}
		.text{
			align-self: center;
			text-decoration: none;
			margin-top: 10px;
		}
		a{
			text-decoration: none;
			color: blue;
		}
		label{
			font-size: 30px;	
		}
		.input-area{
			margin: 20px;
		}
		input{
			float: right;
		}
		p{
			color: blue;
			text-decoration: underline;
			font-size: 20px;
			cursor: pointer;
		}
	</style>
	<?php 
		include 'connectDB.php';
		$sql="insert into Lecturer values(?,?,?,?,?,?);";
		$message="";
		if(isset($_POST['name'],$_POST['gender'],$_POST['email'],$_POST['address'],$_POST['phone'],$_POST['department']))
		{
			$params= array($_POST['name'],$_POST['gender'],$_POST['phone'],$_POST['email'],$_POST['department'],$_POST['address']);
			$result=sqlsrv_query($conn,$sql,$params);
			if($result===false)
			{
				echo "wrong sql";
			}
		}
		else{
			echo "cannot sign upp";
		}
	 ?>
</head>
<body>
	<div class="container">
		 <form method="post" action="#" validate id="signup" >
		 	<h1>Information</h1>
		 <div class="input-area">
		 	<i class="fas fa-user" ></i>
		 	<label>Full Name:</label>
		 	<input class="textbox" type="text"  placeholder="Full Name" name="name" minlength="5" required="">
		 	<hr>
		 </div>
		  <div class="input-area">
		  	<i class="fas fa-user-friends"></i>
		 	<label>Gender:</label>
		 	<input class="textbox" type="text"  placeholder="Gender" name="gender" required="">
		 	<hr>
		 </div>
		 <div class="input-area">
		 	<i class="fas fa-envelope-open-text"></i>
		 	<label>Email:</label>
		 	<input class="textbox" type="email"  placeholder="Email" name="email" required="">
		 	<hr>
		 </div>
		 <div class="input-area">
		 	<i class="fas fa-map-marker"></i>
		 	<label>Address:</label>
		 	<input class="textbox" type="text"  placeholder="Address" name="address" required="">
		 	<hr>
		 </div>
		 <div class="input-area">
		 	<i class="fas fa-phone"></i>
		 	<label>Phone number:</label>
		 	<input class="textbox" type="tel"  placeholder="Phone number" name="phone" required="" minlength="10">
		 	<hr>
		 </div>
		 <div class="input-area">
		 	<label for="browser">Department:</label>
  			<input class="textbox" list="browsers" name="department" id="browser" placeholder="choose Department">
  			<datalist id="browsers">
   				<option value="School of Computer Science and Engineering">
   				<option value="Department of Mathematics">
   				<option value="Department of Physics">
    			<option value="Department of Civil Engineering">
   				<option value="Department of Industrial and Systems Engineering">
   				<option value="School of Electrical Engineering">
   				<option value="Department of English">
   				<option value="School of Electrical Engineering">
   				<option value="School of Business">
   				<option value="Department of Environmental Engineering">
  			</datalist>
		 </div>
		 </form>
		 <button id="btn1" type="button" > Next </button>
		 <div class="text">
		 	Already have an account?
		 	<a href="login.php">Sign in</a>
		 </div>
	</div>
	<div class="container2">
		<i style="position: relative;left: 120px;top: 65px;font-size: 30px" class="fas fa-user-circle"></i>
		<h1>Account</h1>
		<form method="post" action="#" validate >
		  	<div class="input-area">
		 		<i class="fas fa-user-circle"></i>
		 		<label>User name:</label>
		 		<input class="textbox" type="text"  placeholder="Username" name="Uname" minlength="5" required="">
		 		<hr>
			 </div>
		 	 <div class="input-area">
		 		<i class="fas fa-key"></i>
		 		<label>Password:</label>
		 		<input class="textbox" type="password"  placeholder="Password" name="password" minlength="6" required="">
			 </div>
			 <hr>
			 <p> Back </p>
			 <button type="submit" name="submit" > Create Account </button>
		</form>
	</div>
</body>
</html>