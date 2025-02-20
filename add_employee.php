<?php
// Include database connection
include('db_connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input values
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Insert the data into the employees table
    $sql = "INSERT INTO employees (name, position, email, phone) 
            VALUES ('$name', '$position', '$email', '$phone')";

    if (mysqli_query($conn, $sql)) {
        echo "Team member added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Redirect to the home page
    header("Location: index.php");
    exit();
}
?>