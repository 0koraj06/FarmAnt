<!DOCTYPE>

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
	?>
<html>
	<head>
		<title>Edit Item</title>
		
		<link rel="stylesheet" href="style.css"/>
	</head>

<body>



<?php

$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");

if(isset($_GET["ID"])){
	
$prodid = $_GET["ID"];
$pname = $_get['prod_name'];
$pcat = $_get['prod_cat'];
$pstock = $_get['prod_stock'];
$pdesc = $_GET['prod_desc'];
$pprice = $_GET['prod_price'];

	
$results = $conn->query("select * from fa_product where prodID = '$prodid' ");


$row = $results->fetch();

}




if(isset($_GET['submit'])){
	
$pname = $_GET['prod_name'];
$pcat = $_GET['prod_cat'];
$pstock = $_GET['prod_stock'];
$pdesc = $_GET['prod_desc'];
$pprice = $_GET['prod_price'];


//getting the image from field
$prodimage = $_FILES['product_image']['name'];
$prodimage_temp = $_FILES['product_image']['temp_name'];

move_uploaded_file($prodimage_temp,"product_images/$prodimage");



$results = $conn->query ("UPDATE fa_product SET (prod_name = '$pname', prod_cat = '$pcat', prod_stock = '$pstock', prod_desc = '$pdesc', prod_price = '$pprice', product_image = '$prodimage' where prodID = '$prodid' )");
}

?>
<?php

// Store Session Data




// Test that the authentication session variable exists
if ( isset ($_SESSION["username"]))
{
   echo "You are logged in as " . $_SESSION["username"];
   
   echo '<br> <a href = "logout.php"> Logout </a>';	
}
    ?>
	
	
	<form action="updateitem.php" method="get">
	
		<table align="center" width="1000" border="2">
		
			<tr>
				<td><h2> Update Item</h2></td>
			</tr>
			
			
			<tr align="right">
				<td> Item Name:</td>
				<td><input type="text" name="prod_name" value="<?php echo  $_GET['prod_name'];  ?> " /> </td>
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
			
			
			<tr align="right">
				<td> Stock:</td>
				<td><input type="text" name="prod_stock" /> </td>
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
				<td colspan="8"> <input type="submit" name="update" value="Update Item"/> </td>
			</tr>
			
			
			
			
				
		</table>
		
	</form>
</body>

</html>

    <?php
}
?>