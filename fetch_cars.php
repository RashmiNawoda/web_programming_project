<?php
include 'db_connection.php';

$min_price = isset($_GET['min_price']) ? (int) $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int) $_GET['max_price'] : 1000000;

$sql = "SELECT * FROM cars WHERE price >= $min_price AND price <= $max_price ORDER BY price ASC";
$result = $conn->query($sql);

$cars = [];
while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cars);
?>
