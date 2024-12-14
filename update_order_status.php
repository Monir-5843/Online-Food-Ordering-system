<?php
include 'admin_navbar.php';
// Include database connection file
include 'db.php';

// Handle the POST request to update order status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    $response = [];

    if (!empty($order_id) && !empty($new_status)) {
        // Update the Orders table
        $query = "UPDATE Orders SET order_status = ? WHERE order_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $new_status, $order_id);

        if ($stmt->execute()) {
            // Insert into Order_Tracking table
            $tracking_query = "INSERT INTO Order_Tracking (order_id, status) VALUES (?, ?)";
            $stmt_tracking = $conn->prepare($tracking_query);
            $stmt_tracking->bind_param("is", $order_id, $new_status);
            $stmt_tracking->execute();

            $response = ["message" => "Order status updated successfully!", "type" => "success"];
        } else {
            $response = ["message" => "Failed to update order status.", "type" => "danger"];
        }
    } else {
        $response = ["message" => "Invalid input.", "type" => "danger"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .card {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: #fff;
        }
        .btn {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h3 class="text-center mb-4">Update Order Status</h3>

            <?php if (!empty($response)): ?>
                <div class="alert alert-<?php echo $response['type']; ?>">
                    <?php echo $response['message']; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="orderId" class="form-label">Order ID</label>
                    <input type="number" id="orderId" name="order_id" class="form-control" placeholder="Enter Order ID" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Order Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Status</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
