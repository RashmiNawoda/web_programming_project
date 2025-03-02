<!-- Sadia Rumpa - About_Us Page -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style.css" />
    
</head>
<body >

    <header class="header" >
    <!-- logo-->
    <div class="log">
        <img src="img/logo.png" alt="Car Logo" class="logo" />
    </div>
    <!-- navigation -->
    <nav class="navigation">
        <a href="login.php" class="login-btn">Login/Register</a>
        <a href="index.php">Home</a>
        <a href="services.html">Our Services</a>
        <a href="aboutUs.php">About Us</a>
        <a href="contact_us.php">Contact Us</a>
        <a href="car_listing.php">Cars for You</a>

    </nav>
    </header>

    <div class="about-body">
        <header class="aboutusheader">
            <h1>About us</h1>
            <p>Your Trusted Car Service Partner</p>
        </header>
        <!--introduction section-->
        <h2 class="h2-1">Who we are</h2>
        <p>
            At car-ing, we are dedicated to providing top notch car maintanance and repair services to keep
            your vehicle in excellent condition.With years of exprience in the industry, we pride ourselves 
            on delivering exceptional quality and unmatched customer service.
        </p>
        <!--mission-->
        <h2>Our Mission</h2>
        <p>
            Our mission is to ensure the safety and satisfaction of every customer by offering reliable,
            efficient and affordable car servicing.
        </p>
        <!--vision-->
        <h2>Vision</h2>
        <p>
            Building long lasting relationships based on trust and excellence.
        </p>
        <!--Team member-->
        <!--
        <h3> Team Members</h3>
        <p>
            Sadia  - Lead Mechanic ,
            Shuvo  - Service Manager,
            Nikhil - Customer Suuport,
            Rashmi - Customer Suuport.
        </p> 
    -->

  <h3>Team Members</h3>
<ul id="employee-list">
    <?php
    // Include the database connection
    include('db_connection.php');

    // Query to fetch employee data
    $sql = "SELECT * FROM employees";
    $result = mysqli_query($conn, $sql);

    // Check if any team members exist
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>{$row['name']} - {$row['position']} - {$row['email']} - {$row['phone']}</li>";
        }
    } else {
        echo "<li>No team members found.</li>";
    }
    ?>
</ul>
    <h3>Add New Team Member</h3>
<form action="add_employee.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="position">Position:</label>
    <input type="text" id="position" name="position" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required><br>

    <button type="submit">Add Team Member</button>
</form>
    <script>
    fetch('employees.php')
        .then(response => response.json())
        .then(data => {
            let employeeList = document.getElementById('employee-list');
            data.forEach(employee => {
                let listItem = document.createElement('li');
                listItem.textContent = `${employee.name} - ${employee.position}`;
                employeeList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching employee data:', error));
    </script>
     




    </div>

    <footer class="footer">
        <div class="footer-content">
          <h2>Car-ing</h2>
          <p>
            Established in 2020, we offer a wide range of services and repairs at
            a reasonable price. From all maintenance to repairs, at Car-ing, your
            car is in safe hands.
          </p>
        </div>
      </footer>
    
</body>
</html>


<!-- Sadia Rumpa - About_Us Page -->