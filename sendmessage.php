<?php

$subject = $_POST['subject'];
$username = $_POST['username'];
$content = $_POST['content'];
$date = $_POST['date'];
$sender = $_SESSION['username'];




$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");






$results = $conn->query ("INSERT INTO fa_message(username, content, date, sender, subject) VALUES ('$username','$content','$date','$sender','$subject')") ;




?>
<html>
<link rel="stylesheet" href="style.css"/>
<form id="Contactform">
            
            <fieldset>
                <legend> Contact Form </legend>
                <p> <label> To</label> <input type="text" name="username" required>
                </p>
                <p> <label> Subject </label> <input type="text" name="subject" required>
                </p>
				<p> <label> From </label> <input type="text" name="sender" value="<?php echo $_SESSION["username"]?>" required>
                </p>
                <p> <label> Message </label> <input type="text" name="content" required >
                </p>
                
                
            </fieldset>
     
            
            
            
            
            <!-- Submit button -->            
            <p> <input type="submit">      
    
            
        
        </form>
		</html>