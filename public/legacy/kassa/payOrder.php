<?php

// Receive order data
$orderData = json_decode($_POST["orderData"]);

require_once('config/dbconfig.php');

$conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // set all sales into sales table
    for($index = 0; $index < sizeof($orderData); $index++){
        $order = $orderData[$index];
        $sql = "INSERT INTO sales (itemId, amount, saleDate) VALUES ($order->id, $order->amount, NOW())";
        $result = $conn->query($sql);
    }

    $conn->close();
}

echo json_encode("Verkoop succesvol");

?>