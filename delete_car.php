<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

 
    $sql = "DELETE FROM cars WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Car deleted successfully!";
        header("Location: index.php"); // Redirect back to home page
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
