<?php
include 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$model = $_POST['model'];
$price = $_POST['price'];
$description = $_POST['description'];

$sql = "UPDATE cars SET name='$name',model='$model', price=$price, description='$description' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: car_listing.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>