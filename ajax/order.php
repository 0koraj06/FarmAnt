<?php

    require("database.php");
    session_start();
    
    $order_id = $_GET['order'];
    $usergroup = $_SESSION['usergroup'];
    
    if(!isset($order_id) || !isset($usergroup) || $usergroup < 1)
    {
        header("HTTP/1.1 401 Unauthorized");
        die();
    }

    $connection = connect();
    $query = $connection->prepare("UPDATE fa_orders SET confirmed=1 WHERE orderID = :order");
    $query->bindValue(":order", $order_id);
    if(!$query->execute())
    {
        header("HTTP/1.1 403 Forbidden");
        die("Invalid second");
    }
    
    header("HTTP/1.1 200 OK");
    
?>