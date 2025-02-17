<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data
    $sql = "SELECT user_id, fullname, password_hash FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['fullname'] = $user['fullname'];
            echo "Login successful! <a href='index.php'>Go to Dashboard</a>";
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="register-link">
            <p>Don't have an account?</p>
            <a href="register.php" class="login-btn">Register Here</a>
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
