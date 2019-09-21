<html>
	<head>
		<title>Farm Ant</title>
		
		<link rel="stylesheet" href="style.css"/>
		<script src="javascr.js">
</script>
	</head>

<body onload="getmessage()">
<!-- MAIN CONTENT BEGIN -->
	<div id="main_wrapper">
	
		<!-- HEADER BEGIN -->
		<div id="header_wrapper">  
			<img id="logo"src="img/logo.png" />
			
			<?php

// Store Session Data




// Test that the authentication session variable exists
if ( isset ($_SESSION["username"]))
{
   echo "You are logged in as " . $_SESSION["username"];
   
   echo '<br> <a href = "logout.php"> Logout </a>';	
}
    ?>

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
			</ul>
		
		</div>
		<!-- NAVBAR END -->
		
		<!-- OONTENT BEGIN -->
		<div id="content_wrapper"> 
		
			
			<div id="content_area"> 
			
					<!-- <div id="shopping_cart"> 
					<span style="float:right; font-size:18px;  "> <b style="color:yellow"> Shopping Cart </b><a href="cart.php"> Go to Cart</a></span>
				</div> -->
				
				
				
			





			<div id="message">

			

			</div>
			
			</div>
		
		</div>
		<!-- CONTENT END -->
		
		
		<div id="footer">  Footer </div>
	
	
	
	
	
	
	</div>
<!-- MAIN CONTENT ENDS HERE -->
</body>

</html>