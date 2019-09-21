<?php
    require("ajax/database.php");
    session_start();
    $_SESSION['previous_page'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (!isset($_SESSION['username']))
        header("Location: login.php");
    if($_SESSION['usergroup'] < 1)
            header("Location: index.php");

    function show_purchases() {
        $connection = connect();
        $results = $connection->query("SELECT
              c.username customer,
              s.username seller,
              o.*
            FROM 
              fa_orders o
                INNER JOIN fa_users c
                    ON o.customerID = c.id
                INNER JOIN fa_users s
                    ON o.farmerID = s.id
            WHERE o.confirmed = '0' ORDER BY o.date DESC");
        if (!$results || $results->rowCount() < 1) {
            echo "<p class='order_error'>No orders pending.</p>";
            return;
        }
        echo "<table class='order_table'>";
        echo "<tr>    
                    <th style='width:5%'>ID</th>
                    <th style='width:15%'>Customer</th>
                    <th style='width:15%'>Seller</th>
                    <th style='width:15%'>Product</th>
                    <th style='width:10%'>Quantity</th>
                    <th style='width:10%'>Price</th>
                    <th style='width:20%'>Date</th>
                    <th style='width:10%'></th>
                 </tr>";
        while ($row = $results->fetch()) {
            echo "<tr>";
            echo "<td>$row[orderID]</td>";
            echo "<td>$row[customer]</td>";
            echo "<td>$row[seller]</td>";
            echo "<td>$row[prod_name]</td>";
            echo "<td>$row[quantity]</td>";
            echo "<td>£$row[total]</td>";
            echo "<td>" . date("F j, Y, g:i a", strtotime($row[date])) . "</td>";
            echo "<td><button onclick='confirm_order($row[orderID])'>Confirm</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>

<html>
    <head>
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="css/admin.css"/>
        <script src="js/admin.js"></script>
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

            <div id="content_wrapper"> 

                <div id="content_area">

                    <div id="page_wrapper">
                    
                        <div id="order_panel">

                            <h2 id="order_title">Pending orders</h2>
                            <?php show_purchases(); ?>

                        </div>
                       
                    </div>

                </div>


            </div>


            <div id="footer">  Jason Koranteng Q10888306 </div>

        </div>

    </body>

</html>