<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "web_programming_project");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $review = $_POST['review'];

    if (!empty($name) && !empty($review)) {
        $stmt = $conn->prepare("INSERT INTO reviews (name, review) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $review);
        $stmt->execute();
        $stmt->close();

        // Refresh the page to show the new review
        header("Location: testimonial.php");
        exit();
    }
}

// Fetch reviews for display
$sql = "SELECT name, review FROM reviews ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Review Form -->
    <div class="review-form-container">
        <h2>Leave a Review</h2>
        <form method="post" action="">
            <input type="text" name="name" placeholder="Your Name" required>
            <textarea name="review" placeholder="Write your review here..." required></textarea>
            <button type="submit">Submit Review</button>
        </form>
    </div>

    <!-- Testimonial Carousel -->
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $first = true;
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                    <div class="testimonial">
                        <p>"<?php echo htmlspecialchars($row['review']); ?>"</p>
                        <h4>- <?php echo htmlspecialchars($row['name']); ?></h4>
                    </div>
                </div>
                <?php
                $first = false;
            }
            ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

</body>
</html>
