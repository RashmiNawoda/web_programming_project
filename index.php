<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$user_id = $_SESSION['user_id'] ?? null; // Avoid undefined key issue
$fullname = $_SESSION['fullname'] ?? "Guest"; // Provide a default value

echo "<h2>Welcome, $fullname!</h2>";

$title = "My Title";

// Include PHP files
include 'header.php';
include 'db_connection.php';

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // If not logged in, alert and redirect to login page.
  if (!isset($_SESSION['user_id'])) {
      echo "<script>
              alert('Please log in to submit a review.');
              window.location.href = 'login.php';
            </script>";
      exit();
  }

  $name = trim($_POST['name']);
  $review = trim($_POST['comment']);

  // PHP validation: Ensure fields are not empty
  if (empty($name) || empty($review)) {
      echo "<p>Please fill in both the name and the review fields.</p>";
  } elseif (strlen($review) > 500) {
      echo "<p>Review must be under 500 characters.</p>";
  } else {
      // Sanitize inputs
      $name = htmlspecialchars($name);
      $review = htmlspecialchars($review);
      
      // Get logged-in user ID
      $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

      
      // Insert review into database with the associated user_id
      $stmt = $conn->prepare("INSERT INTO reviews (name, comment, user_id) VALUES (?, ?, ?)");
      $stmt->bind_param("ssi", $name, $review, $user_id);
      $stmt->execute();
      $stmt->close();

      // Refresh page to show new review
      header("Location: index.php");
      exit();
  }
}

// Fetch reviews for display
$sql = "SELECT id, name, comment, user_id FROM reviews ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);
?>

<main>
  <body>
    <section class="whyChoose">
      <div class="texts">
        <h2>Welcome to Car-ing!</h2>
        <p>
          Your trusted partner for reliable, efficient, and affordable car
          servicing!
        </p>
        <p>Why choose us?</p>
        <ul>
          <li>✅ Experienced Professionals</li>
          <li>✅ Comprehensive Services</li>
          <li>✅ Customer Satisfaction</li>
          <li>✅ Affordable Pricing</li>
        </ul>
      </div>
    </section>
    <!-- pricing -->
    <section class="pricing">
      <h2 class="h2-pricing">Pricing</h2>
      <div class="pricingCards">
        <div class="card">
          <h2>Basic</h2>
          <p class="price">20€</p>
          <p>Wash, Tire change.</p>
          <a href="services.html"
            ><button><b>Book</b></button></a
          >
        </div>
        <div class="card">
          <h2>Regular</h2>
          <p class="price">50€</p>
          <p>
            Wash, Tire change, Shine. <br />
            Engine Maintenance
          </p>
          <a href="services.html"
            ><button><b>Book</b></button></a
          >
        </div>
        <div class="card">
          <h2>High End</h2>
          <p class="price">150 Euros</p>
          <p>
            Free Wash, Touch up, Full Cleaning, <br />
            Engine Maintenance
          </p>
          <a href="services.html"
            ><button><b>Book</b></button></a
          >
        </div>
      </div>
    </section>
    <!-- testimonials -->
    <section class="testimonials">
  <h2>What Our Customers Say</h2>
  <div id="carouselExampleFade" class="carousel slide carousel-fade">
    <div class="carousel-inner">
      <?php
      $first = true;
      while ($row = $result->fetch_assoc()) {
          ?>
          <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
            <div class="testimonial">
              <p>"<?php echo htmlspecialchars($row['comment']); ?>"</p>
              <h4>- <?php echo htmlspecialchars($row['name']); ?></h4>
              
              <?php
              // If user is logged in and this review belongs to them, show Edit and Delete buttons.
              if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']) {
                  ?>
                  <!-- EDIT button -->
                  <form action="edit_review.php" method="GET" style="display:inline;">
                      <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                      <button type="submit" class="edit-btn">Edit</button>
                  </form>

                  <!-- DELETE button -->
                  <form action="delete_review.php" method="POST" style="display:inline;">
                      <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                      <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button>
                  </form>
              <?php
              }
              ?>
            </div>
          </div>
      <?php
          $first = false;
      }
      ?>
    </div>
    <!-- Carousel buttons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
  </div>
  
  <!-- Review Submission Form -->
  <div class="review-form-container text-center">
    <h6>Leave a Review</h6>
    <form method="POST" action="index.php">
      <input type="text" name="name" placeholder="Your Name" required>
      <textarea name="comment" placeholder="Write your review here..." required></textarea>
      <button type="submit">Submit Review</button>
    </form>
  </div>
</section>

    <!-- added bootstrap javascript -->
    <script src="indexScript.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</main>

<?php
// Include the footer file
include 'footer.php';
?>
