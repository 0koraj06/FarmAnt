<?php
session_start();

if(isset($_POST['add'])){
	
$pname = $_POST['prod_name'];
$pcat = $_POST['prod_cat'];
$pstock = $_POST['prod_stock'];
$pdesc = $_POST['prod_desc'];
$pprice = $_POST['prod_price'];
$seller = $_SESSION['username'];

print_r($_FILES);

switch($_FILES['product_image']['error'])
{
	case UPLOAD_ERR_OK:
		break;
		
	case UPLOAD_ERR_NO_FILE:
		die("No file sent");
		
		
	case UPLOAD_ERR_INI_SIZE:
	case UPLOAD_ERR_FORM_SIZE:
		die("File too big");
		
		
	default:
		die("Help! I don't know the code ". $_FILES['product_image']['error']);
}

//getting the image from fiecld
$prodimage_temp = $_FILES['product_image']['tmp_name'];
$prodimage = $_FILES['product_image']['name'];

$filetype = $_FILES['product_image']['type'];
$filepath = '/home/korantengj/public_html/diss/farmant/product_images/'. $prodimage;

echo "Trying to move file from $prodimage_temp to $filepath<br />";

move_uploaded_file($prodimage_temp,$filepath);

try {
	
    $conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO fa_product(prod_name, category, stock, description, price, seller, product_image)VALUES ('$pname','$pcat','$pstock','$pdesc','$pprice','$seller','$prodimage')" ;

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;



}


?>


<?php
session_start();
// Test that the authentication session variable exists
if ( !isset ($_SESSION["username"]))
{
    echo "You're not logged in. Go away!";
	header("refresh:2; url = login.php");
}
?>






		
	




<html>
	<head>
		<title>Add Item</title>
		
		<link rel="stylesheet" href="style.css"/>
	</head>

<body background="img/field.jpg">
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
				<li><a href="#Messages">Messages</a></li>
				<li><a href="#Finance">Finance</a></li>
				<li><a href="harvest.php">Harvest</a></li>
				
				
			</ul>
			
			
				
			
			
			
		</div>
		<!-- NAVBAR END -->
		
		<!-- OONTENT BEGIN -->
		
		<div id="content_wrapper">   
		
			
			<div id="content_area">  
				<form action="additem.php" method="POST" enctype="multipart/form-data">
	
		<table align="center" width="1000px" border="2">
		
			<tr>
				<td><h2> Add New Item</h2></td>
			</tr>
			
			
			<tr align="right">
				<td> Item Name:</td>
				<td><input type="text" name="prod_name" /> </td>
			</tr>
			
			<tr align="right">
			
				<td> Item Category:</td>
				<td>
				<select name="prod_cat">
					<option value="fruit">Fruit</option>
					<option value="vegetable">Vegetable</option>

				</td>
			</tr>
			
			<tr align="right">
				<td> Item Image:</td>
				<td><input type="file" name="product_image" /> </td>
			</tr>
			
			
				
				<td><input type="hidden" name="username" value= " <?php echo $_SESSION["username"]?>" /> </td>
			
			
			<tr align="right">
				<td> Stock:</td>
				<td><input type="number" name="prod_stock" /> </td>
			</tr>
			
			<tr align="right">
				<td> Description:</td>
				<td><input type="text" name="prod_desc" /> </td>
			</tr>
			
			<tr align="right">
				<td> Price Per KG:</td>
				<td><input type="text" name="prod_price" /> </td>
			</tr>
			
			<tr align="center">
				<td colspan="8"> <input type="submit" name="add" value="Add Item"/> </td>
			</tr>
			
			
			
			
				
		</table>
		
	</form>
			
			</div>
		
		
			<div id="footer">  Footer </div>
		
		</div>
		<!-- CONTENT END -->
		
		
		
	
	
	
	
	
	
	</div>
<!-- MAIN CONTENT ENDS HERE -->
</body>

</html>