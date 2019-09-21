<?php 

    require("ajax/database.php");
    session_start();
    
    $_SESSION['previous_page'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if(!isset($_SESSION['username']))
        header("Location: login.php");

    function show_items()
    {
        $connection = connect();
        $results = $connection->query("SELECT * FROM fa_product WHERE sellerID = $_SESSION[userid]");
        
        if(!$results)
            die("Error connecting to database.");
        
        while ($row = $results->fetch())
        {
            echo "<li id='$row[prod_name]'>";
            echo "<div class='product'>";
            echo "<img src='$row[product_image]' alt=''/>";
            echo "<p><span class='product_attribute'>Item name:</span> <span class='product_value'>$row[prod_name]</span></p>";
            echo "<p><span class='product_attribute'>Price per KG:</span> <span class='product_value'>£$row[price]</span></p>";
            echo "<p><span class='product_attribute'>Stock:</span> <span class='product_value'>$row[stock]</span></p>";
            echo "<p><span class='product_attribute'>Description:</span> <span class='product_value'>$row[description]</span></p>";
            echo "<p><a href='updateitem.php?ID=$row[prodID]'>Update</a></p>";
            echo "<p><a href='deleteitem.php?ID=$row[prodID]'>Delete</a></p>";
            echo "</div>";
            echo "</li>";
        } 
        
    }

?>

<html>
    <head>
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="css/harvest.css"/>
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
                        <div class="search_form">
                            <button onclick="window.location.href='additem.php'">Add new item</button>
                        </div>
                        <div id="list_wrapper">
                            <ul class="product_list">
                                <?php 
                                    show_items(); 
                                ?>
                                <h2 id="product_error">No items found</h2>
                            </ul>
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