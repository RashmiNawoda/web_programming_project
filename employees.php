<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if you have a database password
$database = "car_service";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
// Fetch employees
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
 
// Prepare JSON response
$employees = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
 
// Output JSON
header('Content-Type: application/json');
echo json_encode($employees);
 
// Close connection
$conn->close();
?>