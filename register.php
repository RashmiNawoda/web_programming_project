<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connection.php'; // Include database connection

if (\$_SERVER["REQUEST_METHOD"] == "POST") {
    \$fullname = trim(\$_POST['fullname']);
    \$email = trim(\$_POST['email']);
    \$password = \$_POST['password'];
    \$confirm_password = \$_POST['confirm_password'];

    // Check for empty fields
    if (empty(\$fullname) || empty(\$email) || empty(\$password) || empty(\$confirm_password)) {
        die("All fields are required!");
    }

    // Check if passwords match
    if (\$password !== \$confirm_password) {
        die("Passwords do not match!");
    }

    // Check if email is valid
    if (!filter_var(\$email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }

    // Check if email already exists
    \$check_email = "SELECT email FROM users WHERE email = ?";
    \$stmt = \$conn->prepare(\$check_email);
    \$stmt->bind_param("s", \$email);
    \$stmt->execute();
    \$stmt->store_result();
    
    if (\$stmt->num_rows > 0) {
        die("This email is already registered! Try logging in.");
    }
    \$stmt->close();

    // Hash the password for security
    \$hashed_password = password_hash(\$password, PASSWORD_DEFAULT);

    // Insert user into the database
    \$sql = "INSERT INTO users (fullname, email, password_hash) VALUES (?, ?, ?)";
    \$stmt = \$conn->prepare(\$sql);
    
    if (!\$stmt) {
        die("Error preparing statement: " . \$conn->error);
    }

    \$stmt->bind_param("sss", \$fullname, \$email, \$hashed_password);

    if (\$stmt->execute()) {
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        die("Error: " . \$stmt->error);
    }

    \$stmt->close();
    \$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="indexStyles.css">
</head>
<body class="bg-gray-50" style="background-color: #586a8e;">
    <header class="header">
        <div class="log">
            <img src="img/logo.png" alt="Car Logo" class="logo" />
        </div>
        <nav class="navigation">
            <a href="login.php" class="login-btn">Login/Register</a>
            <a href="index.php">Home</a>
            <a href="services.html">Our Services</a>
            <a href="aboutUs.html">About Us</a>
            <a href="contact_us.php">Contact Us</a>
        </nav>
    </header>

    <div class="register-container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" class="register-btn">Register</button>
        </form>
        <div class="login-link">
            <p>Already have an account?</p>
            <a href="login.php" class="login-btn">Login Here</a>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <h2>Car-ing</h2>
            <p>Established in 2020, we offer a wide range of services and repairs at a reasonable price. From all maintenance to repairs, at Car-ing, your car is in safe hands.</p>
        </div>
    </footer>
</body>
</html>
