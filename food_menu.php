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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(45deg, #ff6f61, #ffca28, #4caf50, #2196f3);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: white;
            font-family: 'Arial', sans-serif;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .menu-title {
            text-align: center;
            color: #fff;
            margin-top: 50px;
            font-size: 2.5rem;
        }

        .food-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .food-card {
            margin-bottom: 20px;
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .card-body {
            padding: 15px;
        }

        .btn-warning {
            background-color: #ff6f61;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e65a50;
        }

        .card-title, .card-text {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="menu-title">Our Delicious Menu</h2>
        <div class="row">
            <?php
            // Fetch all food items from the database
            $query = "SELECT * FROM Food";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imagePath = !empty($row['image']) ? '../images/' . $row['image'] : '../images/default_food.jpg';
                    ?>
                    <div class="col-md-4">
                        <div class="card food-card">
                            <!-- Display food image -->
                            <img src="<?= htmlspecialchars($imagePath); ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']); ?>">
                            <div class="card-body">
                                <!-- Display food name, price, and description -->
                                <h5 class="card-title"><?= htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text">Price: $<?= htmlspecialchars($row['price']); ?></p>
                                <a href="restaurant.php?food_id=<?= $row['food_id']; ?>" class="btn btn-warning">Go Forward</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>No food items found!</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
