<?php

    require("database.php");
    session_start();
    session_regenerate_id();
    
    $_SESSION['username'] = null;
    $_SESSION['usergroup'] = null;
    $_SESSION['userid'] = null;
    
    $connection = connect();
    if(!isset($_GET['username']) || !isset($_GET['password']))
        die();
    
    $username = trim($_GET['username']);
    $password = trim($_GET['password']);
    
    $query = $connection->prepare("SELECT * FROM fa_users WHERE username = :user AND password = :pass");
    $query->bindValue(":user", $username, PDO::PARAM_STR);
    $query->bindValue(":pass", $password, PDO::PARAM_STR);
    if(!$query->execute())
    {
        die();
    }
    $result = $query->fetch();
    if(!$result)
    {
        die();
    }
    $_SESSION['username'] = $result['username'];
    $_SESSION['usergroup'] = $result['isadmin'];
    $_SESSION['userid'] = $result['id'];
    die("Logged in as " . $result['username'] . ".\n\nRedirecting to previous page...");

?>
