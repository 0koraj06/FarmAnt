<?php 

    require("ajax/database.php");
    session_start();
    
    $_SESSION['previous_page'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if(!isset($_SESSION['username']))
        header("Location: login.php");
    
?>

<html>
    <head>
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="css/additem.css"/>
        <script src="js/marketplace.js"></script>
    </head>

    <body>
        <!-- MAIN CONTENT BEGIN -->
        <div id="main_wrapper">

            <!-- HEADER BEGIN -->
            <div id="header_wrapper">  
                <img id="logo"src="img/logo.png" />
            </div>
            <!-- HEADER END -->
            <!-- NAVBAR BEGIN -->
            <div id="menubar">

                <ul id="menu">	
                    <li><a href="index.php">Home</a></li>
                    <li><a href="marketplace.php">Marketplace</a></li>
                    <li><a href="messages.php">Messages</a></li>
                    <li><a href="finance.php">Orders</a></li>
                    <li><a href="harvest.php">Harvest</a></li>
                    <?php
                        if($_SESSION['usergroup'] > 0)
                        {
                            echo "<li><a href='admin.php'>Admin</a></li>";
                        }
                    ?>
                </ul>
            </div>
            <?php
                if(isset($_SESSION['username']))
                {
                    echo "<div id='login_bar'>";
                    echo "<span class='login_text'>Logged in as: <span class='login_name'>$_SESSION[username]</span> <a href='logout.php'>Logout</a></span>";
                    echo "</div>";
                }
            ?>
            <!-- NAVBAR END -->

            <!-- OONTENT BEGIN -->
            <div id="content_wrapper"> 


                <div id="content_area">
                    <div id="product_wrapper">
                        
                        <h2 id="add_title">Add new item</h2>
                        <div id="add_panel">
                            
                            <?php
                            
                                if(isset($_POST['add']))
                                {
                                    $pname = $_POST['prod_name'];
                                    $pcat = $_POST['prod_cat'];
                                    $pstock = $_POST['prod_stock'];
                                    $pdesc = $_POST['prod_desc'];
                                    $pprice = $_POST['prod_price'];
                                    $seller = $_SESSION['userid'];
                                    $image_loc = $_POST['image_loc'];

                                    try {

                                        $conn = new PDO("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $sql = "INSERT INTO fa_product(prod_name, category, stock, description, price, sellerID, product_image) VALUES ('$pname','$pcat','$pstock','$pdesc','$pprice','$seller','$prodimage')";
                                        $conn->exec($sql);
                                        echo "<h2 id='add_title'>Successfully added new item.</h2>";
                                        echo "<script>
                                                setTimeout(function(){
                                                     window.location = 'harvest.php';
                                                }, 2000);
                                           </script>";
                                    } catch (PDOException $e) {
                                        echo "<h2 id='add_title'>Error adding new item.</h2>";
                                    }

                                    $conn = null;
                                }
                            
                            ?>
                            
                            <form action="additem.php" method="POST" enctype="multipart/form-data">
                                
                                <table class="add_table">
                                    
                                    <tr>
                                        <td>Item Name:</td>
                                        <td><input type="text" name="prod_name" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Category:</td>
                                        <td><select name="prod_cat">
                                            <option value="fruit">Fruit</option>
                                            <option value="vegetable">Vegetable</option>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Image location:</td>
                                        <td><input type="text" name="image_loc" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Stock:</td>
                                        <td><input type="number" name="prod_stock" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Price per KG:</td>
                                        <td><input type="text" name="prod_price" required/></td>
                                    </tr>
                                    <tr>
                                        <td>Description:</td>
                                        <td><input type="text" name="prod_desc" required/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" name="add" value="Add Item"/></td>
                                    </tr>
                                </table>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>

            </div>
            <!-- CONTENT END -->


            <div id="footer">  Jason Koranteng Q10888306 </div>





        </div>
        
        <script src="js/modal.js"></script>
        
    </body>

</html>