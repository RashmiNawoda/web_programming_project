<?php
include 'header.php';
include 'db_connection.php';

if (isset($_GET['review_id'])) {
    $review_id = intval($_GET['review_id']);

    // Fetch the review details from the database
    $sql = "SELECT * FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if review exists
    if ($result->num_rows > 0) {
        $review = $result->fetch_assoc();
    } else {
        echo "Review not found!";
        exit();
    }
    $stmt->close();
} else {
    echo "Invalid review ID.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the form submission to update the review
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if (!empty($name) && !empty($comment)) {
        // Update review in the database
        $sql = "UPDATE reviews SET name = ?, comment = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $comment, $review_id);
        $stmt->execute();
        $stmt->close();

        // Redirect to the home page after successful update
        header("Location: index.php");
        exit();
    } else {
        echo "Please fill out all fields!";
    }
}
?>

<main>
    <section class="edit-review">
        <h2>Edit Your Review</h2>
        <form method="POST" action="edit_review.php?review_id=<?php echo $review_id; ?>">
            <input type="text" name="name" value="<?php echo htmlspecialchars($review['name']); ?>" required>
            <textarea name="comment" required><?php echo htmlspecialchars($review['comment']); ?></textarea>
            <button type="submit">Update Review</button>
        </form>
    </section>
</main>

<?php
include 'footer.php';
?>
