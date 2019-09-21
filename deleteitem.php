<?php
session_start();
$conn = new PDO("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");

if (isset($_GET["ID"])) {
    $prodid = $_GET["ID"];
    $results = $conn->query("delete from `fa_product` WHERE prodID = '$prodid' ");
}

echo "Product has been deleted successfully!";
header("refresh:2; url = harvest.php");
?>
<html>
    <head>
        <title> Delete POI </title>
        <link rel="stylesheet" TYPE="text/css" HREF=".css"/>
    </head>
    <body>



    </body>
</html>