<?php
session_start();


$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");

$results = $conn->query("select * from fa_products");


$row = $results->fetch();


 ?>
<html>
<head>
<title> Search results </title>
<link rel="stylesheet" TYPE="text/css" HREF="style.css"/>
</head>
<body>



</body>
</html>
	
	

 

<?php

if ($row == false) 
{
    echo "No matching rows!";
}

else
{
	while ($row)
	{
		echo "<p>";
		echo " Name: $row[prod_name] <br/>";
		echo " Price: $row[price] <br/>";
		echo " Category: $row[category] <br/>";
		echo " Stock: $row[stock] <br/>";
		echo " Seller: $row[farmerid] <br/>";
		echo " Description: $row[description] <br/>";
		echo " Location: $row[location] <br/>";

		
		
	
		
		echo "<p>";
		
		
		$row = $results->fetch();
	
	
	}
}

 

?>