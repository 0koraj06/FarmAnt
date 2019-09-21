<?php
require("ajax/database.php");
session_start();
$_SESSION['previous_page'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['username']))
    header("Location: login.php");

function show_inbox() {
    $connection = connect();
    $results = $connection->query("SELECT
          b.username sender,
          c.username receiver,
          a.senderID,
          a.subject,
          a.content,
          a.date
        FROM 
          fa_message a
            INNER JOIN fa_users b
                ON a.senderID = b.id
            INNER JOIN fa_users c
                ON a.userID = c.id
        WHERE a.userID = $_SESSION[userid] ORDER BY a.date DESC");
    if (!$results || $results->rowCount() < 1) {
        echo "<p class='message_error'>No received messages.</p>";
        return;
    }
    echo "<table class='message_table'>";
    echo "<tr>    
                <th style='width:10%'>From</th>
                <th style='width:20%'>Subject</th>
                <th>Content</th>
                <th style='width:20%'>Date</th>
                <th style='width:10%'></th>
             </tr>";
    while ($row = $results->fetch()) {
        echo "<tr>";
        echo "<td>$row[sender]</td>";
        echo "<td>$row[subject]</td>";
        echo "<td><p>$row[content]</p></td>";
        echo "<td>" . date("F j, Y, g:i a", strtotime($row[date])) . "</td>";
        echo "<td><button onclick='open_message($row[senderID], \"$row[sender]\")'>Reply</button></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function show_outbox() {
    $connection = connect();
    $results = $connection->query("SELECT
          b.username sender,
          c.username receiver,
          a.subject,
          a.content,
          a.date
        FROM 
          fa_message a
            INNER JOIN fa_users b
                ON a.senderID = b.id
            INNER JOIN fa_users c
                ON a.userID = c.id
        WHERE a.senderID = $_SESSION[userid] ORDER BY a.date DESC");
    if (!$results || $results->rowCount() < 1) {
        echo "<p class='message_error'>No sent messages.</p>";
        return;
    }
    echo "<table class='message_table'>";
    echo "<tr>    
                <th style='width:10%'>To</th>
                <th style='width:20%'>Subject</th>
                <th>Content</th>
                <th style='width:20%'>Date</th>
             </tr>";
    while ($row = $results->fetch()) {
        echo "<tr>";
        echo "<td>$row[receiver]</td>";
        echo "<td>$row[subject]</td>";
        echo "<td><p>$row[content]</p></td>";
        echo "<td>" . date("F j, Y, g:i a", strtotime($row[date])) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<html>
    <head>
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
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

            <div id="content_wrapper"> 

                <div id="content_area">
                    
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

                    <div id="page_wrapper">
                    
                        <div id="message_panel">

                            <h2 id="message_title">Received Messages</h2>
                            <?php show_inbox(); ?>

                        </div>
                        <div id="message_panel">

                            <h2 id="message_title">Sent Messages</h2>
                            <?php show_outbox(); ?>

                        </div>
                       
                    </div>

                </div>


            </div>


            <div id="footer">  Jason Koranteng Q10888306 </div>

        </div>
        
        <script src="js/messages.js"></script>

    </body>

</html>