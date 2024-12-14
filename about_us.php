<?php 
// Include the navbar
include 'navbar.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:pink; /* orange background */
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('path/to/your/background-image.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        .content-section {
            margin: 40px 0;
        }
        .content-section h2 {
            color: #f77f00; /* Orange theme color */
        }
        .content-section p {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <h1>About Us</h1>
        <p>Your one-stop solution for online food ordering!</p>
    </div>

    <!-- Main Content Section -->
    <div class="container">
        <div class="content-section">
            <h2>Who We Are</h2>
            <p>
                At <strong>Food Order</strong>, we are passionate about connecting food lovers with their favorite restaurants. 
                We aim to make food ordering simple, fast, and hassle-free, so you can enjoy your meals from the comfort of your home.
            </p>
        </div>
        <div class="content-section">
            <h2>Our Mission</h2>
            <p>
                Our mission is to revolutionize the food delivery industry by providing an intuitive platform that brings convenience to customers and businesses alike.
                Whether you're craving a juicy burger or authentic Asian cuisine, we’ve got you covered!
            </p>
        </div>
        <div class="content-section">
            <h2>Why Choose Us?</h2>
            <ul>
                <li>Wide selection of restaurants and cuisines.</li>
                <li>Easy-to-use interface for seamless ordering.</li>
                <li>Secure payment options and reliable delivery service.</li>
                <li>Dedicated support to resolve your queries quickly.</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4" style="background-color: #343a40; color: white;">
        <p>&copy; <?php echo date("Y"); ?> Food Order. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
