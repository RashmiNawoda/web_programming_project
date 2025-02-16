<?php
$servername = "localhost";
$username = "root"; // Default for XAMPP/WAMP
$password = ""; // Default XAMPP password is empty
$dbname = "customer_management"; // Make sure this matches your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
