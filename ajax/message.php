<?php

    require("database.php");
    session_start();
    
    $receiver_id = $_GET['user'];
    $subject = $_GET['subject'];
    $content = $_GET['content'];
    $userid = $_SESSION['userid'];
    
    if(!isset($receiver_id) || !isset($subject) || !isset($userid) || !isset($content))
    {
        header("HTTP/1.1 401 Unauthorized");
        die();
    }

    $connection = connect();
    $query = $connection->prepare("INSERT INTO fa_message (userID, subject, content, senderID) VALUES (:user, :subject, :content, :sender);");
    $query->bindValue(":user", $receiver_id);
    $query->bindValue(":subject", $subject);
    $query->bindValue(":content", $content);
    $query->bindValue(":sender", $userid);
    if(!$query->execute())
    {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    
    header("HTTP/1.1 200 OK");
    
?>