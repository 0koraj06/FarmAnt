<?php 
session_start();

$pname = $_POST['prod_name'];
$pcat = $_POST['prod_cat'];
$pstock = $_POST['prod_stock'];
$pdesc = $_POST['prod_desc'];
$pprice = $_POST['prod_price'];
$buyer = $_SESSION['username'];
$seller = $_POST['seller'];
$quantity = $_POST['quantity'];
//connect to database
$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");





$result = $conn->query("SELECT * FROM products WHERE prodID = '$prodid'");
$row = $result->fetch();	

			
// check if date exists
if ($row["stock"] >= $quantity)
	{


		
	
	
// checks if there is availability		
	if($row["stock"] > 0)
		{
			
		
		
			echo "Item Purchased! Please See Messages for Confirmation";
			header("HTTP/1.1 200 OK");
			

			// insert entry into bookings
			$result = $conn->query("INSERT INTO fa_orders (customerID, productID, prod_name, quantity, price, total, date, farmerID) VALUES ('$seller','$prodID', '$prod_name', '$quantity','$price','$quantity*$price','$date','$seller')");
	
			// update latest availability
			$result = $conn->query("UPDATE fa_product SET stock=stock-'$quantity' WHERE prodID = '$prodid' ");
			
			$result = $conn->query("INSERT INTO fa_message (subject, username,content,sender) VALUES('Order Confirmation','$seller', 'Thank you for your purchase </br><h1> Order Details</h1></br><p>
			
			
			</p>','FarmAnt')");
		
			}
			
			
	else	{
			echo "E";
			header("HTTP/1.1 401 Bad Request - av"); // availability
			}			
		}	
	
	}
	
			else 
				{ 
					echo "There is no existing accommodation on this date!";
					header("HTTP/1.1 403 Bad Request - date"); // date
				}

	
		
	


	




?> 