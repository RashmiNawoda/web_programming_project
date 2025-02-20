<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    $nameRegex = "/^[A-Za-z\s]+$/"; // Only letters and spaces
    $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/"; // Basic email format

    // Validation
    if (empty($name) || !preg_match($nameRegex, $name)) {
        $error = "Please enter a valid name (letters and spaces only).";
    } elseif (empty($email) || !preg_match($emailRegex, $email)) {
        $error = "Please enter a valid email address.";
    } elseif (empty($message) || strlen($message) < 10) {
        $error = "Your message must be at least 10 characters long.";
    } else {
        // If validation passes, process the form (e.g., send an email or store in a database)
        $success = "We got your message. Thank you for contacting us!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="indexStyles.css" />
     <script>
        <?php if (isset($success)): ?>
            window.onload = function() {
                alert("<?php echo $success; ?>");
                window.location.href = "index.php"; 
            };
        <?php endif; ?>
    </script>
</head>
<body class="bg-gray-50" style="background-color: #586a8e">
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
            <a href="car_listing.php">Cars for You</a>
             <!-- car_listing addition -->
        </nav>
    </header>
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-100 p-4 rounded-xl shadow-md text-center">
                <h2 class="text-xl font-bold mb-2">Location</h2>
                <p>123 Main Street, Cityville</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl shadow-md text-center">
                <h2 class="text-xl font-bold mb-2">Contact Number</h2>
                <p>+1 234 567 890</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-xl shadow-md text-center">
                <h2 class="text-xl font-bold mb-2">Email</h2>
                <p>info@carservice.com</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold mb-4">Inquiry Form</h2>
            <?php if (isset($error)): ?>
                <p class="text-red-500"><?php echo $error; ?></p>
            <?php elseif (isset($success)): ?>
                <p class="text-green-500"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="contact_us.php" method="post" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium mb-1">Enter Your Name:</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Enter Your Email:</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium mb-1">Message:</label>
                    <textarea id="message" name="message" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required></textarea>
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">Submit</button>
                    <button type="reset" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500">Clear</button>
                </div>
            </form>
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
