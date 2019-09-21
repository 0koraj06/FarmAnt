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
		<title>Farm Ant</title>
		
		<link rel="stylesheet" href="style.css"/>
		<script src="javascr.js">
</script>
	</head>
<body>
<?php

$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");




if(isset($_POST['send'])){
	
$subject = $_POST["subject"];
$username = $_POST["username"];
$content = $_POST["content"];
//$date = $_POST['date'];
$sender = $_SESSION["username"];


$result = $conn->query ("INSERT INTO `fa_message` ( `username`,`content`,`sender`,`subject` ) VALUES ('$username','$content','$sender','$subject')") ;

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




<form action="contactform.php" method="post">
	
		<table align="center" width="1000" border="2">
		
			<tr>
				<td><h2> Send Message</h2></td>
			</tr>
			
			
			
			
				<tr align="right">
				<td> To:</td>
				<td><input type="text" name="username" /> </td>
			</tr>
			
			<tr align="right">
				<td> Subject:</td>
				<td><input type="text" name="subject" /> </td>
			</tr>
			
			
				
			<td><input type="hidden" name="sender" value= " <?php echo $_SESSION["username"]?>" /> </td>
		
			
			<tr align="right">
				<td> Message:</td>
				<td><input type="text" name="content" /> </td>
			</tr>
			
			
			
			<tr align="center">
				<td colspan="8"> <input type="submit" name="send" value="Send Message"/> </td>
			</tr>
			
			
			
			
				
		</table>
		
	</form>
	</body>
  </html>
      <?php
}
?>