<?php include 'navbar.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: orange;
        }
        .food-details {
            margin-top: 50px;
        }
        .food-image img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }
        .btn-warning {
            background-color: #ff6f61;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e65a50;
        }
    </style>
</head>
<body>
    <div class="container food-details">
        <div class="row">
            <div class="col-md-6 food-image">
                <img src="../images/<?= htmlspecialchars($food['image'] ?? 'default_food.jpg'); ?>" alt="<?= htmlspecialchars($food['name']); ?>">
            </div>
            <div class="col-md-6">
                <h2><?= htmlspecialchars($food['name']); ?></h2>
                <p><strong>Price:</strong> $<?= htmlspecialchars($food['price']); ?></p>
                <p><?= htmlspecialchars($food['description']); ?></p>
                <a href="place_order.php?food_id=<?= $food['food_id']; ?>" class="btn btn-warning">Order Now</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
