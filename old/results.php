<?php
session_start();

$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");

$search_query = $_GET['user_query'];
$results = $conn->query("select * from fa_product where prod_name like '%$search_query%'");


$row = $results->fetch();


 ?>

<?php
session_start();
// Test that the authentication session variable exists
if ( !isset ($_SESSION["username"]))
{
    echo "You're not logged in. Go away!";
	header("refresh:2; url = login.php");
}
else
{
    ?><html>
	<head>
		<title>Farm Ant</title>
		
		<link rel="stylesheet" href="style.css"/>
	</head>

<body background="img/field.jpg">
<!-- MAIN CONTENT BEGIN -->
	<div id="main_wrapper">
	
		<!-- HEADER BEGIN -->
		<div id="header_wrapper">  
			<img id="logo" src="" />

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
				<li><a href="#Messages">Messages</a></li>
				<li><a href="#Finance">Finance</a></li>
				<li><a href="harvest.php">Harvest</a></li>
				
				
			</ul>
			
			
				
			
			
			
		</div>
		<!-- NAVBAR END -->
		
		<!-- OONTENT BEGIN -->
		<div id="content_wrapper">   
		
			
			<div id="content_area">  
				
				<form method="get" action="results.php">
					<input type="text" name="user_query" />
					<input type="submit" name="search" value="Search"/>
				</form>	
			
				<div id="product_box">
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
		echo "<a href='buy.php?ID=$row[prodID]'>Buy</a><br/>";
		echo "<br>";
		
		echo "</div>";
		
		
		$row = $results->fetch();
	
	
	}
}

 

?>  
			</div>
		
		
			<div id="footer">  Footer </div>
		
		</div>
		<!-- CONTENT END -->
		
		
		
	
	
	
	
	
	
	</div>
<!-- MAIN CONTENT ENDS HERE -->
</body>
<!-- https://www.udemy.com/ecommerce-website-in-php-mysqli/learn/v4/t/lecture/1559014?start=0 -->
</html>
    
	
	
    <?php
}
?>