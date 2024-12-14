<?php
include 'navbar.php';

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online food ordering system";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Simulate customer ID (replace with session data for logged-in user)
$customer_id = 1;

// Fetch the latest order details for the customer
$query = "
    SELECT Orders.order_id, Food.name AS food_name, Orders.total_price, Orders.order_date, Orders.order_status 
    FROM Orders 
    INNER JOIN Food ON Orders.food_id = Food.food_id 
    WHERE Orders.customer_id = ? 
    ORDER BY Orders.order_date DESC 
    LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f093fb, #f5576c);
            color: #fff;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }
        .navbar {
            background-color: #343a40;
            padding: 10px;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
        }
        .navbar a:hover {
            color: #f093fb;
        }
        .summary-container {
            background: red(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            width: 50%;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            margin: 80px auto; /* Ensure spacing from navbar */
        }
        .summary-container h2 {
            color: black;
            font-weight: bold;
        }
        .summary-container p {
            font-size: 1.2rem;
        }
        .btn-home {
            background-color: greenyellow;
            border: none;
        }
        .btn-home:hover {
            background-color: orangered;
        }
    </style>
</head>
<body>
    <div class="summary-container">
        <?php if ($order): ?>
            <h2>Order Summary</h2>
            <p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']); ?></p>
            <p><strong>Food Name:</strong> <?= htmlspecialchars($order['food_name']); ?></p>
            <p><strong>Total Price:</strong> $<?= htmlspecialchars($order['total_price']); ?></p>
            <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']); ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($order['order_status']); ?></p>
        <?php else: ?>
            <h2>No Order Found</h2>
            <p>You have not placed any orders yet.</p>
        <?php endif; ?>
        <a href="food_menu.php" class="btn btn-home btn-lg mt-3">Order More</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
