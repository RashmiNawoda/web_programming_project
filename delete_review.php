<?php
include 'db_connection.php'; // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review_id'])) {
    $review_id = intval($_POST['review_id']); // Convert to integer for security

    // Ensure ID is valid before proceeding
    if ($review_id > 0) {
        // Prepare SQL statement to delete the review
        $sql = "DELETE FROM reviews WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $review_id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: index.php"); // Redirect after successful deletion
            exit();
        } else {
            echo "Error deleting review: " . $conn->error;
        }
    } else {
        echo "Invalid review ID.";
    }
} else {
    echo "Invalid request.";
}
?>
