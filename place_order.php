<?php
include 'navbar.php';

session_start();
if (!isset($_SESSION['customer_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Order processing logic goes here
// After order is placed, clear the cart or proceed to confirmation

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

// Get food ID from the URL
$food_id = isset($_GET['food_id']) ? intval($_GET['food_id']) : 0;

$query = "SELECT * FROM Food WHERE food_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $food_id);
$stmt->execute();
$result = $stmt->get_result();
$food = $result->fetch_assoc();

if (!$food) {
    echo "<p class='text-center'>Food item not found!</p>";
    exit;
}

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_SESSION['customer_id']; // Use session data
    $total_price = $food['price'];
    $order_date = date('Y-m-d H:i:s');
    $status = 'Pending';

    // Insert the order into the database
    $query = "INSERT INTO Orders (customer_id, food_id, order_date, total_price, order_status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisds", $customer_id, $food_id, $order_date, $total_price, $status);

    if ($stmt->execute()) {
        // Fetch the last inserted order ID to pass to payment.php
        $order_id = $conn->insert_id;
        echo "<script>window.location.href = 'payment.php?order_id=" . $order_id . "';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to place the order. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f6d365, #fda085);
            color: #fff;
            font-family: Arial, sans-serif;
            min-height: 100vh;
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
            color: #f6d365;
        }
        .order-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
            width: 50%;
            margin: 80px auto; /* Ensure spacing from navbar */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        .food-image img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        .btn-submit {
            background-color: #ff6f61;
            border: none;
        }
        .btn-submit:hover {
            background-color: #e65a50;
        }
        .animated-bg {
            animation: gradient 6s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="animated-bg">
    <div class="order-container">
        <div class="food-image">
            <img src="../images/<?= htmlspecialchars($food['image'] ?? 'default_food.jpg'); ?>" alt="<?= htmlspecialchars($food['name']); ?>">
        </div>
        <h2 class="text-center text-dark"><?= htmlspecialchars($food['name']); ?></h2>
        <p class="text-dark"><strong>Description:</strong> <?= htmlspecialchars($food['description']); ?></p>
        <p class="text-dark"><strong>Price:</strong> $<?= htmlspecialchars($food['price']); ?></p>
        
        <form method="POST">
            <div class="text-center">
                <button type="submit" class="btn btn-submit btn-lg">Confirm Order</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
