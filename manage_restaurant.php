<?php
// Start the session
session_start();

// Include the database connection
$conn = new mysqli('localhost', 'root', '', 'online_food_ordering_system');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a new restaurant
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    $admin_id = $_POST['admin_id'];

    // Use prepared statements to safely insert data
   // Use prepared statements to safely insert data
// Insert query for restaurant table
$stmt = $conn->prepare("INSERT INTO restaurant (name, location, contact_info, admin_id) VALUES (?, ?, ?, ?)");

// Bind parameters to the prepared statement
$stmt->bind_param("sssi", $name, $location, $contact_info, $admin_id);

// Execute the statement
if ($stmt->execute()) {
    $message = "Restaurant added successfully!";
} else {
    $message = "Error: " . $stmt->error;
}

$stmt->close();

}

// Fetch existing restaurants
$sql = "SELECT * FROM restaurant";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Restaurants</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(45deg, #ff6f61, #ffca28, #4caf50, #2196f3);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            font-family: 'Arial', sans-serif;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #ff6f61;
            color: white;
        }

        .message {
            font-size: 1.2rem;
            color: green;
            text-align: center;
            margin-top: 20px;
        }

        .form-container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Include navbar -->
    <?php include 'admin_navbar.php'; ?>

    <h1 class="text-center">Manage Restaurants</h1>

    <!-- Message after form submission -->
    <?php if (isset($message)) { echo "<div class='message'>$message</div>"; } ?>

    <!-- Form to add new restaurant -->
    <div class="form-container">
        <form method="POST" action="" class="bg-light p-4 rounded">
            <h3 class="text-center">Add New Restaurant</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Restaurant Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter restaurant name" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Enter location" required>
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info</label>
                <input type="text" id="contact_info" name="contact_info" class="form-control" placeholder="Enter contact information" required>
            </div>
            <div class="mb-3">
                <label for="admin_id" class="form-label">Admin ID</label>
                <input type="number" id="admin_id" name="admin_id" class="form-control" placeholder="Enter admin ID" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Restaurant</button>
        </form>
    </div>

    <!-- Table to display restaurants -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Restaurant ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Contact Info</th>
                <th>Admin ID</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['restaurant_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_info']); ?></td>
                        <td><?php echo htmlspecialchars($row['admin_id']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No restaurants found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Close database connection -->
<?php $conn->close(); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
