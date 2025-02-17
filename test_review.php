<?php
include 'db_connection.php';

$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Comment: " . $row["comment"] . "<br>";
    }
} else {
    echo "No reviews found.";
}

$conn->close();
?>
