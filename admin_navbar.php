<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        nav {
            background: linear-gradient(to right, #ff6f61, #ffca28, #4caf50, #2196f3);
            animation: gradientAnimation 10s ease infinite;
            padding: 10px 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #ffd700;
        }

        .nav-link {
            color: white;
            font-size: 1rem;
            margin-right: 10px;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .nav-link:hover {
            color: #ffd700;
            text-decoration: underline;
            transform: scale(1.1);
        }

        .navbar-toggler {
            background-color: white;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_signup.php">Signup</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_food.php">Manage Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_orders.php">Manage Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_restaurant.php">Manage Restaurant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="delivery_personnel.php">Manage Delivery Personnel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_reviews.php">View Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update_order_status.php">Update Order Status</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
