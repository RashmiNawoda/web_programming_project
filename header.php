<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car-ing Homepage</title>
    <!-- added bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="indexStyles.css" />
  </head>
  <body>
    <header class="header">
      <!-- logo-->
      <div class="log">
        <img src="img/logo.png" alt="Car Logo" class="logo" />
      </div>
      <!-- navigation -->
      <nav class="navigation">
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="logout.php" class="login-btn">Log Out</a>
        <?php else: ?>
          <a href="login.php" class="login-btn">Login/Register</a>
        <?php endif; ?>
        <a href="index.php">Home</a>
        <a href="services.html">Our Services</a>
        <a href="aboutUs.php">About Us</a>
        <a href="contact_us.php">Contact Us</a>
        <a href="car_listing.php">Cars for You</a> <!-- New Link -->
      </nav>
    </header>
