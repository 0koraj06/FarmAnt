<?php 

    require("ajax/database.php");
    session_start();
    
    $_SESSION['previous_page'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    if(!isset($_SESSION['username']))
        header("Location: login.php");

    function show_items()
    {
        $connection = connect();
        $results = $connection->query("SELECT p.*, s.username seller
                                        FROM fa_product p
                                        INNER JOIN fa_users s
                                        ON p.sellerID = s.id;");
        
        if(!$results)
            die("Error connecting to database.");
        
        while ($row = $results->fetch())
        {
            if($row['stock'] > 0)
            {
                echo "<li id='$row[prod_name]'>";
                echo "<div class='product'>";
                echo "<img src='$row[product_image]' alt=''/>";
                echo "<p><span class='product_attribute'>Item name:</span> <span class='product_value'>$row[prod_name]</span></p>";
                echo "<p><span class='product_attribute'>Price per KG:</span> <span class='product_value'>£$row[price]</span></p>";
                echo "<p><span class='product_attribute'>Description:</span> <span class='product_value'>$row[description]</span></p>";
                echo "<p><span class='product_attribute'>Seller:</span> <a href='#' onclick='open_message($row[sellerID], \"$row[seller]\")'>$row[seller]</a></p>";
                echo "<p><span class='product_attribute'>Location:</span> <span class='product_value'>$row[location]</span></p>";
                echo "<button class='buy_button' onclick='open_modal($row[prodID], \"$row[prod_name]\")'>Buy</button>";
                echo "</div>";
                echo "</li>";
            } else
            {
                echo "<li id='$row[prod_name]'>";
                echo "<div class='product'>";
                echo "<img src='$row[product_image]' alt=''/>";
                echo "<p><span class='product_attribute'>Item name:</span> <span class='product_value'>$row[prod_name]</span></p>";
                echo "<p><span class='product_attribute'>Price per KG:</span> <span class='product_issue'>Out of stock</span></p>";
                echo "<p><span class='product_attribute'>Description:</span> <span class='product_value'>$row[description]</span></p>";
                echo "<p><span class='product_attribute'>Seller:</span> <a href='#' onclick='open_message($row[sellerID], \"$row[seller]\")'>$row[seller]</a></p>";
                echo "<p><span class='product_attribute'>Location:</span> <span class='product_value'>$row[location]</span></p>";
                echo "<button class='buy_button' disabled>Out of stock</button>";
                echo "</div>";
                echo "</li>";
            }
            
        }
        
    }

?>

<html>
    <head>
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="css/marketplace.css"/>
        <link rel="stylesheet" href="css/messages.css"/>
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
                            <input type="text" name="user_query" id="product_search" onkeyup="search_items()"/>
                            <input type="submit" name="search" value="Search"/>
                        </div>
                        <div id="modal_popup" class="purchase_modal">
                            <div class="purchase_modal_content">
                                <div class="purchase_modal_header">
                                    <span class="purchase_modal_close">&times;</span>
                                    <h2 id="modal_title">Buy</h2>
                                </div>
                                <div class="purchase_modal_body">
                                    <h3>Enter quantity (KG): <input type="number" id="user_quantity" min="1" max="10"/></h3>
                                    <h3 id="modal_error_message">Error</h3>
                                    <button id="modal_buy">Purchase</button>
                                </div>
                                <div class="purchase_modal_footer">
                                </div>
                            </div>
                        </div>
                        
                        <div id="message_popup" class="message_modal">
                            <div class="message_modal_content">
                                <div class="message_modal_header">
                                    <span class="message_modal_close">&times;</span>
                                    <h2 id="message_title">Send Message</h2>
                                </div>
                                <div class="message_modal_body">
                                    <h3>Subject:
                                    <input type="text" id="user_subject"/></h3>
                                    <h3>Content: <textarea id="user_content" cols="50" rows="5"></textarea></h3>
                                    <h3 id="message_modal_error_message">Error</h3>
                                    <button id="modal_send">Send</button>
                                </div>
                                <div class="message_modal_footer">
                                </div>
                            </div>
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
        <script src="js/messages.js"></script>
        
    </body>

</html>