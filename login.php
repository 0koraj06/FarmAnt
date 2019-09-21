<?php

session_start();

if(isset($_SESSION['username']))
    header("Location: logout.php");

?>

<html>
    <head>
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="./css/login.css"/>
        <script type="text/javascript" src="./js/login.js"></script>
    </head>

    <body background="img/field.jpg">
        <!-- MAIN CONTENT BEGIN -->
        <div id="main_wrapper">

            <!-- HEADER BEGIN -->
            <div id="header_wrapper">  
                <img id="logo" src="img/logo.png" />
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

            <div id="content_wrapper">   


                <div id="content_area">
                    <div id="loginform">
                        <ul style="list-style: none">
                            <li><label class="loginlabel" for="username"><b>Username</b></label>
                                <br>
                                <input class="logininput" type="text" placeholder="Enter Username" name="username" id="username" required></li>
                            <br>
                            <li><label class="loginlabel" for="password"><b>Password</b></label>
                                <br>	
                                <input class="logininput" type="password" placeholder="Enter Password" name="password" id="password" required></li>
                            <br>
                            <li><button id="loginbutton" type="submit" onclick="sendLogin()">Login</button></li>
                        </ul>
                        <br>
                        <p id="loginMessage">If you do not have an account you can <a href="signup.php">Register</a></p>
                    </div>	
                </div>


                <div id="footer">  Jason Koranteng Q10888306 </div>

            </div>

        </div>
        <!-- MAIN CONTENT ENDS HERE -->
    </body>

</html>

