<?php
// Database configuration
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

// Fetch orders from the database
$sql = "SELECT * FROM Orders";
$result = $conn->query($sql);

// Update order status
if (isset($_GET['order_id']) && isset($_GET['status'])) {
    $order_id = $_GET['order_id'];
    $status = $_GET['status'];

    $update_sql = "UPDATE Orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $order_id);
    if ($stmt->execute()) {
        echo "<script>alert('Order status updated successfully!'); window.location.href='manage_orders.php';</script>";
    } else {
        echo "<script>alert('Failed to update order status.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Manage Orders</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Food ID</th>
                <th>Customer ID</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['food_id']; ?></td>
                        <td><?php echo $row['customer_id']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="manage_orders.php?order_id=<?php echo $row['order_id']; ?>&status=Completed" class="btn btn-success">Mark as Completed</a>
                            <a href="manage_orders.php?order_id=<?php echo $row['order_id']; ?>&status=Cancelled" class="btn btn-danger">Cancel</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No orders found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
