<?php
// Database configuration
include'admin_navbar.php';
$host = "localhost";
$username = "root";
$password = "";
$database = "online food ordering system";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders and other data
$sql = "SELECT * FROM Orders";
$result = $conn->query($sql);

$sql_food = "SELECT * FROM Food";
$result_food = $conn->query($sql_food);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Online Food Ordering System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4caf50, #8bc34a, #cddc39);
            font-family: Arial, sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #333;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 12px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .card {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #0288d1;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0277bd;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3 class="text-center text-white">Admin Dashboard</h3>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="manage_orders.php">Manage Orders</a>
    <a href="manage_food.php">Manage Food</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Main content -->
<div class="content">
    <h1>Welcome to the Admin Dashboard</h1>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Orders</h4>
                    <table class="table table-bordered table-striped text-white">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Food</th>
                                <th>Customer</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['order_id']; ?></td>
                                        <td><?php echo $row['food_id']; ?></td>
                                        <td><?php echo $row['customer_id']; ?></td>
                                        <td><?php echo $row['order_status']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="4">No orders found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Food Items</h4>
                    <table class="table table-bordered table-striped text-white">
                        <thead>
                            <tr>
                                <th>Food ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result_food->num_rows > 0): ?>
                                <?php while ($row = $result_food->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['food_id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>$<?php echo $row['price']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="4">No food items available.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <a href="add_food.php" class="btn btn-primary">Add New Food Item</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
