<?php
    
    session_start();
    
    if(!isset($_SESSION['username']))
        die();
    
    die($_SESSION['previous_page']);
    
?>
