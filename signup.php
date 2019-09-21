<?php


$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");
session_start();
$statement = $conn->prepare ("INSERT INTO fa_users(username, password, isadmin, location) VALUES (?,?,0, ?)");
$a = htmlentities($_POST["username"]);
$b = htmlentities($_POST["password"]);
$c = htmlentities($_POST["location"]);


$statement->bindParam(1,$a);
$statement->bindParam(2,$b);
$statement->bindParam(3,$c);
$statement->execute();




  
if (!empty($_POST["username"])|| (!empty($_POST["password"]))){
      
	 

  echo ' Sign Up Success! Redirecting to home page in 5 seconds';

header( "refresh:5;url=index.php" );

}


?>




<html>
	<head>
		<title>Farm Ant</title>
		
		<link rel="stylesheet" href="style.css"/>
	</head>

<body background="img/field.jpg">
<!-- MAIN CONTENT BEGIN -->
	<div id="main_wrapper">
	
		<!-- HEADER BEGIN -->
		<div id="header_wrapper">  
			<img id="logo" src="img/logo.png" />
			
		
		</div>
		<!-- HEADER END -->
		<!-- NAVBAR BEGIN -->
		<div id="menubar">
		
			<ul id="menu">	
				<li><a href="index.php">Home</a></li>
				<li><a href="marketplace.php">Marketplace</a></li>
				<li><a href="message.php">Messages</a></li>
				<li><a href="#Finance">Finance</a></li>
				<li><a href="harvest.php">Harvest</a></li>
				<?php
				session_start();
				if ( !isset ($_SESSION["username"]))
{
    echo "<li><a href='login.php'>Login/Sign Up</a></li>";
}
				
				?>
				
			</ul>
			
			
				
			
			
			
		</div>
		<!-- NAVBAR END -->
		
		<!-- OONTENT BEGIN -->
		<div id="content_wrapper">   
		
			
			<div id="content_area">  
				
		<form method="post" action="signup.php">

	<label> Username: </label><br> <input name = "username" required="required"/> <br>
	
<br>

	<label> Password: </label><br><input type="password" name = "password" required="required"/> <br>
	<br>

	<label> Confirm Password: </label><br><input type="password" name = "password" required="required"/> <br>
<br>

	<label> Location: </label><br><input type="text" name = "location" required="required"/> <br>
<br>
	<input type="submit" value="Go!"/><br>
				
			</div>
		
		
			<div id="footer">  Footer </div>
		
		</div>
		<!-- CONTENT END -->
		
		
		
	
	
	
	
	
	
	</div>
<!-- MAIN CONTENT ENDS HERE -->
</body>

</html>