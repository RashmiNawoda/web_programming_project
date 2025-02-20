<?php
$title = "Cars for You";
include 'header.php';
include 'db_connection.php';
?>

<main>
  <body>
    <!-- Hero Section with Attractive Heading -->
    <section class="car-listings-hero">
      <h1>Find Your Dream Car</h1>
      <p>Explore our collection of high-quality second-hand cars.</p>
    </section>

    <!-- Filter Section -->
    <section class="car-filters">
      <h2>Filter Cars by Price</h2>
      <form method="GET" action="car_listing.php">
        <label for="min_price">Min Price (€):</label>
        <input type="number" name="min_price" id="min_price" placeholder="Min price">

        <label for="max_price">Max Price (€):</label>
        <input type="number" name="max_price" id="max_price" placeholder="Max price">

        <button type="submit">Apply Filters</button>
      </form>
    </section>

    <!-- Car Listings Table (Hidden by Default) -->
    <?php
    if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
      // Build SQL query based on filters
      $sql = "SELECT * FROM cars WHERE 1=1";
      if (isset($_GET['min_price'])) {
        $min_price = $_GET['min_price'];
        $sql .= " AND price >= $min_price";
      }
      if (isset($_GET['max_price'])) {
        $max_price = $_GET['max_price'];
        $sql .= " AND price <= $max_price";
      }
      $sql .= " ORDER BY price ASC";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo '<section class="car-listings">
                <h2>Available Cars</h2>
                <table>
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Model</th>
                      <th>Price</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>';

        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['name']}</td>
                  <td>{$row['model']}</td>
                  <td>{$row['price']}€</td>
                  <td>{$row['description']}</td>
                </tr>";
        }

        echo '</tbody>
              </table>
            </section>';
      } else {
        echo '<section class="car-listings">
                <h2>No Cars Found</h2>
                <p>Sorry, no cars are available in this price range.</p>
              </section>';
      }
    }
    ?>
  </body>
</main>

<?php
include 'footer.php';
?>