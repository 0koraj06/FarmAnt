
<?php

session_start();



$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");



$results = $conn->query("select * from fa_product");


$row = $results->fetch();
 ?>
<html>
	<head>
		<title>Farm Ant</title>
		
		<link rel="stylesheet" href="style.css"/>
		<script src="javascr.js">
</script>
	</head>

<body>
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
				<div id="shopping_cart"> 
					<span style="float:right; font-size:18px;  "> <b style="color:yellow"> Shopping Cart </b><a href="cart.php"> Go to Cart</a></span>
				</div>
				
				
				
			


<!-- The Modal -->
<div id="myModal" style="display: none;"  class="modal">

  <!-- Modal content -->
  <div id="modal1 "class="modal-content">
    <span class="close" onclick="closeModal()" > x </span>
    <p><form method='POST'><input type='text' placeholder='Enter Quantity(KG)' id='quantity'/> <input type='text' value="<?php echo $row[prodID] ?> " /> <input type='button' onclick='buy()' value='Buy'/></form> </p>
  </div>

</div>


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
		echo "<a href='buy.php?ID=$row[prodID]'>Buy</a> <input type='button' onclick='openModal()' value='Buy'/><br/> ";
		echo "<br>";
		
		echo "</div>";
		
		
		$row = $results->fetch();
	
	
	}
}

 

?> 
			</div>
			</div>
		
		</div>
		<!-- CONTENT END -->
		
		
		<div id="footer">  Footer </div>
	
	
	
	
	
	
	</div>
<!-- MAIN CONTENT ENDS HERE -->
</body>

</html>