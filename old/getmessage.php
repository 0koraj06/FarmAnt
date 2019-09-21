<?php
session_start();
header("Content-type: application/json");

$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");

$seller = $_SESSION['username'];

$results = $conn->query("select * from fa_message WHERE username = '$seller'");

$rows = $results->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);

 ?>