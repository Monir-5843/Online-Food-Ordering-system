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

// Get order_id from URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Fetch order details using the order_id
$order_query = "SELECT Orders.order_id, Orders.total_price, Food.name AS food_name 
                FROM Orders 
                INNER JOIN Food ON Orders.food_id = Food.food_id 
                WHERE Orders.order_id = ?";
$order_stmt = $conn->prepare($order_query);
$order_stmt->bind_param("i", $order_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

if ($order_result->num_rows > 0) {
    $order = $order_result->fetch_assoc();
} else {
    echo "<script>alert('Invalid Order ID!'); window.location.href='place_order.php';</script>";
    exit();
}

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_mode = $_POST['payment_mode'];
    $amount = $order['total_price'];
    $payment_date = date('Y-m-d H:i:s');

    // Insert payment into the database
    $payment_query = "INSERT INTO Payment (order_id, payment_date, amount, payment_mode) VALUES (?, ?, ?, ?)";
    $payment_stmt = $conn->prepare($payment_query);
    $payment_stmt->bind_param("isds", $order_id, $payment_date, $amount, $payment_mode);

    if ($payment_stmt->execute()) {
        // Update order status to 'Paid'
        $update_order_query = "UPDATE Orders SET order_status = 'Paid' WHERE order_id = ?";
        $update_order_stmt = $conn->prepare($update_order_query);
        $update_order_stmt->bind_param("i", $order_id);
        $update_order_stmt->execute();

        echo "<script>alert('Payment Successful!'); window.location.href='order_summary.php';</script>";
    } else {
        echo "<script>alert('Payment Failed! Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            color: #333;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
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
            color: #74ebd5;
        }
        .payment-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            margin: 80px auto; /* Ensure spacing from navbar */
        }
        .payment-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4c67a3;
        }
        .btn-submit {
            background-color: #4caf50;
            border: none;
            width: 100%;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Payment Details</h2>
        <p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']) ?></p>
        <p><strong>Food Name:</strong> <?= htmlspecialchars($order['food_name']) ?></p>
        <p><strong>Total Price:</strong> $<?= htmlspecialchars($order['total_price']) ?></p>
        
        <form method="POST">
            <div class="form-group mb-3">
                <label for="payment_mode">Payment Mode</label>
                <select class="form-control" id="payment_mode" name="payment_mode" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="UPI">UPI</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" class="btn btn-submit btn-lg">Pay Now</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
