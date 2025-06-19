<?php

// Receive order data
$overviewData = json_decode($_POST["overviewData"]);

require_once('config/dbconfig.php');

$beginDate = $overviewData->beginDate;
$endDate = $overviewData->endDate;
$returnArray = array();

if($beginDate === "" || $endDate === ""){
    echo json_encode("begindatum of einddatum niet ingevuld!");
    die();
}

$beginDate = date_create($beginDate);
$endDate = date_create($endDate);

if($beginDate > $endDate){
    echo json_encode("Einddatum is eerder dan begindatum!");
    die();
}

$conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // get stuff from the sales and menu tables
    $sql = "SELECT a.naam, a.price, b.amount, b.saleDate FROM menu a, sales b WHERE  a.id = b.itemId AND DATE(b.saleDate) <= '".$endDate->format('Y-m-d')."' AND DATE(b.SaleDate) >= '".$beginDate->format('Y-m-d')."'";
    $result = $conn->query($sql);

    if ($result!= null && $result->num_rows > 0) {
        while($row=$result->fetch_assoc()){
            $returnArray[] = $row;
        }
    }

    echo json_encode($returnArray);

    $conn->close();

    die();
}
?>