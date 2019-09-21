<?php

    require("database.php");
    session_start();
    
    $product_id = $_GET['product_id'];
    $product_quantity = $_GET['product_quantity'];
    $userid = $_SESSION['userid'];
    
    if(!isset($product_id) || !isset($product_quantity) || !isset($userid))
    {
        header("HTTP/1.1 401 Unauthorized");
        die();
    }

    $connection = connect();
    $query = $connection->prepare("SELECT * FROM fa_product WHERE prodID = :prod");
    $query->bindValue(":prod", $product_id, PDO::PARAM_INT);
    if(!$query->execute())
    {
        header("HTTP/1.1 403 Forbidden");
        die("Invalid second");
    }
    
    $product_result = $query->fetch();
    if(!$product_result || $product_result['stock'] < $product_quantity)
    {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    
    $query = $connection->prepare("INSERT INTO fa_orders (customerID, productID, prod_name, quantity, price, total, farmerID) VALUES " .
                                  "(:user, :prodid, :prodname, :quantity, :price, :total, :farmer);");
    $query->bindValue(":user", $userid);
    $query->bindValue(":prodid", $product_id);
    $query->bindValue(":prodname", $product_result['prod_name']);
    $query->bindValue(":quantity", $product_quantity);
    $query->bindValue(":price", $product_result['price']);
    $query->bindValue(":total", ($product_result['price'] * $product_quantity));
    $query->bindValue(":farmer", $product_result['sellerID']);
    
    if(!$query->execute())
    {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    
    $query = $connection->prepare("UPDATE fa_product SET stock=stock-:quantity WHERE prodID = :prodid");
    $query->bindValue(":quantity", $product_quantity);
    $query->bindValue(":prodid", $product_id);
    
    if(!$query->execute())
    {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    
    $query = $connection->prepare("INSERT INTO fa_message (userID, subject, content, senderID) VALUES (:user, :subject, :content, :sender);");
    $query->bindValue(":user", $userid);
    $query->bindValue(":subject", "Your purchase");
    $query->bindValue(":content", "Your recent purchase of " . $product_result['prod_name'] . " is being processed.");
    $query->bindValue(":sender", $product_result['sellerID']);
    
    if(!$query->execute())
    {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    
    header("HTTP/1.1 200 OK");
    
?>