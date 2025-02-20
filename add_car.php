<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $model = $_POST['model'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Insert into the database
    $sql = "INSERT INTO cars (model, price, description) VALUES ('$model', '$price', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "New car added successfully!";
        header("Location: index.php"); // Redirect back to home page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<form method="POST" action="add_car.php">
  <label for="name">Name (Make):</label>
  <input type="text" name="name" required>

  <label for="model">Model:</label>
  <input type="text" name="model" required>

  <label for="price">Price (€):</label>
  <input type="number" step="0.01" name="price" required>

  <label for="description">Description:</label>
  <textarea name="description" required></textarea>

  <button type="submit">Save</button>
</form>