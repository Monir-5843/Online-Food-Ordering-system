<?php 
include 'navbar.php';
include 'db.php';
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch order status and history
$current_status = null;
$order_history = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Fetch current order status
    $status_query = "SELECT status FROM Order_Tracking WHERE order_id = ? ORDER BY updated_at DESC LIMIT 1";
    $stmt = $conn->prepare($status_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $status_result = $stmt->get_result();
    if ($status_row = $status_result->fetch_assoc()) {
        $current_status = $status_row['status'];
    }

    // Fetch order tracking history
    $history_query = "SELECT status, updated_at FROM Order_Tracking WHERE order_id = ? ORDER BY updated_at DESC";
    $stmt = $conn->prepare($history_query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $history_result = $stmt->get_result();
    while ($row = $history_result->fetch_assoc()) {
        $order_history[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #9face6);
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding-top: 0px; /* Space for the navbar */
        }
        .card {
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.5s;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .btn {
            background: #6a11cb;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            border-radius: 10px;
        }
        .btn:hover {
            background: #2575fc;
            background: linear-gradient(45deg, #2575fc, #6a11cb);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h3 class="text-center mb-4">Track Your Order</h3>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="orderId" class="form-label">Order ID</label>
                    <input type="number" id="orderId" name="order_id" class="form-control" placeholder="Enter Order ID" required>
                </div>
                <button type="submit" class="btn w-100">Track Order</button>
            </form>

            <?php if (!is_null($current_status)): ?>
                <div class="mt-4">
                    <h5 class="text-center">Current Status: <span class="badge bg-success"><?php echo $current_status; ?></span></h5>
                </div>
            <?php endif; ?>

            <?php if (!empty($order_history)): ?>
                <div class="mt-4">
                    <h5>Order History:</h5>
                    <ul class="list-group">
                        <?php foreach ($order_history as $history): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?php echo $history['status']; ?></span>
                                <span class="badge bg-secondary"><?php echo $history['updated_at']; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
