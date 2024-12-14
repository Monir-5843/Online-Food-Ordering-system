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

// Fetch food items from the database
$sql = "SELECT * FROM Food";
$result = $conn->query($sql);

// Delete food item
if (isset($_GET['delete_food_id'])) {
    $delete_food_id = $_GET['delete_food_id'];
    $delete_sql = "DELETE FROM Food WHERE food_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_food_id);
    if ($stmt->execute()) {
        echo "<script>alert('Food item deleted successfully!'); window.location.href='manage_food.php';</script>";
    } else {
        echo "<script>alert('Failed to delete food item.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Food - Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Manage Food Items</h1>
    <a href="add_food.php" class="btn btn-primary mb-3">Add New Food Item</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Food ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['food_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <a href="edit_food.php?food_id=<?php echo $row['food_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="manage_food.php?delete_food_id=<?php echo $row['food_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this food item?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No food items found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
