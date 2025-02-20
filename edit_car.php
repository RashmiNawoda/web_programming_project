<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch car details
    $sql = "SELECT * FROM cars WHERE id = $id";
    $result = $conn->query($sql);
    $car = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $model = $_POST['model'];
    $price = $_POST['price'];
    $description = $_POST['description'];

  
    $sql = "UPDATE cars SET model='$model', price='$price', description='$description' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Car updated successfully!";
        header("Location: index.php"); // Redirect back to home page
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="edit_car.php">
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
  <label for="name">Name (Make):</label>
  <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

  <label for="model">Model:</label>
  <input type="text" name="model" value="<?php echo $row['model']; ?>" required>

  <label for="price">Price (€):</label>
  <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required>

  <label for="description">Description:</label>
  <textarea name="description" required><?php echo $row['description']; ?></textarea>

  <button type="submit">Update</button>
</form>
