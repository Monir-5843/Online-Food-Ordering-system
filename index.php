<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Ordering System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Full-page animated background styling */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(45deg, #ff6f61, #ffc107, #4caf50, #2196f3);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: white;
            font-family: 'Arial', sans-serif;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Navbar Styling */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black */
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }

        /* Content Styling */
        .content {
            text-align: center;
            padding: 80px 20px 20px 20px; /* Added top padding to avoid overlap with navbar */
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
            margin-top: 100px;
        }

        .content h1 {
            font-size: 4rem;
            font-weight: bold;
        }

        .content p {
            font-size: 1.5rem;
        }

        .btn-primary {
            background-color: #ffc107;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ffca28;
        }
    </style>
</head>
<body>

    

    <!-- Content below navbar -->
    <div class="content">
        <h1>Welcome to Online Food Ordering System</h1>
        <p>Order your favorite food anytime, anywhere!</p>
        <a href="food_menu.php" class="btn btn-primary btn-lg">Explore Menu</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
