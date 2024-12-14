<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Ordering System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background: linear-gradient(45deg, black, black, black, black, black);
            background-size: 300% 300%;
            animation: gradient-animation 10s ease infinite;
            color: white;
        }
        .navbar .navbar-brand {
            color: white;
            font-size: 1.5rem;
        }
        .navbar .navbar-nav .nav-link {
            color: white;
        }
        .navbar .navbar-nav .nav-link:hover {
            color: orange;
        }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Food Order</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="food_menu.php">Food</a></li>
                    <li class="nav-item"><a class="nav-link" href="restaurant.php">Restaurant</a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="review.php">Review</a></li>
                    <li class="nav-item"><a class="nav-link" href="about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="order_tracking.php">Order Tracking</a></li>
                </ul>
                <li class="nav-item">
                    <!-- Uncomment and update the link if needed -->
                    <!-- <a class="nav-link" href="fetch_order_status.php">Order Tracking</a> -->
                </li>
            </div>
        </div>
    </nav>
</body>
</html>
