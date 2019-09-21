<?php
session_start();

$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");

$seller = $_SESSION['userid'];

$results = $conn->query("select * from fa_product WHERE sellerID = '$seller'");


$row = $results->fetch();


 ?>
<?php

// Test that the authentication session variable exists
if ( !isset ($_SESSION["username"]))
{
    echo "You're not logged in. Go away!";
	header("refresh:2; url = login.php");
}
else
{
    ?>
 <html>
	<head>
		<title>Farm Ant</title>
		
		<link rel="stylesheet" href="style.css"/>
	</head>

<body>
<!-- MAIN CONTENT BEGIN -->
	<div id="main_wrapper">
	
		<!-- HEADER BEGIN -->
		<div id="header_wrapper">  
			<img id="logo" src="img/logo.png" />
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
				<li><a href="additem.php">Add Item</a></li>
			</ul>
		
		</div>
		<!-- NAVBAR END -->
		
		<!-- OONTENT BEGIN -->
		<div id="content_wrapper"> 
		
			
			<div id="content_area"> 
			
<?php

if ($row == false) 
{
    echo "No matching rows!";
}

else
{
	while ($row)
	{
		echo "<div id='product'>";
			
		echo " Item Name: $row[prod_name] <br/>";
		echo " Category: $row[category] <br/>";
		echo " Price Per KG: $row[price] <br/>";
		echo " Stock Count: $row[stock] <br/>";
		echo " Seller: $row[seller] <br/>";
		echo " Description: $row[description] <br/>";
		echo " Location: $row[location] <br/>";
		echo "<a href='updateitem.php?ID=$row[prodID]'>Update</a><br/>";
		echo "<a href='deleteitem.php?ID=$row[prodID]'>Delete</a><br/>";
		echo "<br>";
		
		echo "</div>";
		
		
		$row = $results->fetch();
	
	
	}
}

 

?>  
			</div>
		
		</div>
		<!-- CONTENT END -->
		
		
		<div id="footer">  Footer </div>
	
	
	
	
	
	
	</div>
<!-- MAIN CONTENT ENDS HERE -->
</body>

</html>
    <?php
}
?>