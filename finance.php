<?php
    require("ajax/database.php");
    session_start();
    $_SESSION['previous_page'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (!isset($_SESSION['username']))
        header("Location: login.php");

    function show_orders()
    {
        $connection = connect();
        $results = $connection->query("SELECT * FROM fa_orders WHERE customerID = $_SESSION[userid]");
        if(!$results || $results->rowCount() < 1)
        {
            echo "Unable to find orders";
            return;
        }
        echo "<table class='order_table'>";
        echo "<tr>    
                <th style='width:10%'>Order ID</th>
                <th>Product</th>
                <th style='width:10%'>Quantity</th>
                <th style='width:10%'>Total Price</th>
                <th>Date</th>
                <th>Status</th>
             </tr>";
        while ($row = $results->fetch())
        {
            echo "<tr>";
            echo "<td>$row[orderID]</td>";
            echo "<td>$row[prod_name]</td>";
            echo "<td>$row[quantity]</td>";
            echo "<td>£$row[total]</td>";
            echo "<td>" . date("F j, Y, g:i a", strtotime($row[date])) . "</td>";
            echo "<td>";
            if($row['confirmed'] == 0)
                echo "<span class='status_pending'>Pending</span>";
            else
                echo "<span class='status_confirmed'>Confirmed</span>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    

?>

<html>
    <head>
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="css/finance.css"/>
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
                
                    <h2 id="order_title">Your orders</h2>
                    <div id="order_panel">
                    
                        <?php show_orders(); ?>
                        
                    </div>
                    
                </div>
                     

            </div>


            <div id="footer">  Jason Koranteng Q10888306 </div>





        </div>
    </body>

</html>