<?php
session_start();
header("Content-type: application/json");

$conn = new PDO ("mysql:host=localhost;dbname=korantengj;", "korantengj", "raeshueb");

$result = $conn->query("SELECT * FROM fa_product");
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);
	  

echo json_encode($rows);
 
 

?> 