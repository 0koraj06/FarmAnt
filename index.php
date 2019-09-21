<?php
    session_start();
    $_SESSION['previous_page'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<!DOCTYPE HTML>
<html>
    <head>
    <!-- Start -->
        <title>Farm Ant</title>

        <link rel="stylesheet" href="style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body background="img/field.jpg">
        <!-- MAIN CONTENT BEGIN -->
        <div id="main_wrapper">

            <!-- HEADER BEGIN -->
            <div id="header_wrapper">  
                <img id="logo" src="img/logo.png" />

            </div>
            
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

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">

                                <img src="img/carrots.jpg" alt="Carrots" style="width: 100%;">
                                <div class="carousel-caption">
                                    <h1>Buy And Sell Good Quality Fresh Local Produce</h1>

                                </div>

                            </div>

                            <div class="item" style= "object-fit: cover; width: 100%;">
                                <img src="img/sprouts.jpg" alt="Sprouts" style="width:100%;">
                                <div class="carousel-caption">
                                    <h1>Interact With Fellow Users!</h1>

                                </div>
                            </div>

                            <div class="item">
                                <img src="img/soil.png" alt="Soil">
                                <div class="carousel-caption">
                                    <h1> Join A Fast Growing Community!</h1>

                                </div>
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>			



                </div>


                <div id="footer">  Jason Koranteng Q10888306 </div>

            </div>
            <!-- CONTENT END -->









        </div>
        <!-- MAIN CONTENT ENDS HERE -->
    </body>

</html>

