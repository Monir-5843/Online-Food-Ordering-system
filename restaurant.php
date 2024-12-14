<?php 
// Include the navbar
include 'navbar.php'; 

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "online food ordering system";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch restaurants with their available food items
$sql = "
    SELECT 
        r.restaurant_id, r.name AS restaurant_name, r.location, r.contact_info,
        f.food_id, f.name AS food_name, f.price, f.description
    FROM 
        Restaurant r
    LEFT JOIN 
        Food f ON r.restaurant_id = f.restaurant_id
    ORDER BY 
        r.restaurant_id, f.food_id";

$result = $conn->query($sql);

// Organize data by restaurants
$restaurants = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $restaurant_id = $row['restaurant_id'];
        if (!isset($restaurants[$restaurant_id])) {
            $restaurants[$restaurant_id] = [
                'name' => $row['restaurant_name'],
                'location' => $row['location'],
                'contact_info' => $row['contact_info'],
                'foods' => []
            ];
        }
        if ($row['food_id']) {
            $restaurants[$restaurant_id]['foods'][] = [
                'food_id' => $row['food_id'],
                'name' => $row['food_name'],
                'price' => $row['price'],
                'description' => $row['description']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants and Foods</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #FF914D, #FFE7C2);
            font-family: 'Arial', sans-serif;
        }
        h1 {
            font-size: 3rem;
            color: #ffffff;
            text-shadow: 2px 2px #FF914D;
            text-align: center;
            margin-top: 20px;
            animation: fadeIn 2s ease-in-out;
        }
        .card {
            margin-bottom: 20px;
            border: none;
            background-color: #fff4e6;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
            overflow: hidden;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }
        .food-table {
            margin-top: 15px;
        }
        .food-table th, .food-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .food-table th {
            background-color: #FF914D;
            color: white;
        }
        .food-table td {
            background-color: #fff4e6;
        }
        .order-button {
            background-color: #FF914D;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .order-button:hover {
            background-color: #e65a50;
        }
    </style>
</head>
<body>
    <h1>Restaurants and Available Foods</h1>
    <div class="container">
        <?php if (!empty($restaurants)): ?>
            <?php foreach ($restaurants as $restaurant_id => $restaurant): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($restaurant['name']); ?></h5>
                        <p><strong>Location:</strong> <?= htmlspecialchars($restaurant['location']); ?></p>
                        <p><strong>Contact:</strong> <?= htmlspecialchars($restaurant['contact_info']); ?></p>

                        <?php if (!empty($restaurant['foods'])): ?>
                            <h6>Available Foods:</h6>
                            <table class="food-table w-100">
                                <thead>
                                    <tr>
                                        <th>Food Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($restaurant['foods'] as $food): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($food['name']); ?></td>
                                            <td>$<?= htmlspecialchars($food['price']); ?></td>
                                            <td><?= htmlspecialchars($food['description']); ?></td>
                                            <td>
                                                <form action="food_details.php" method="GET" style="display: inline;">
                                                    <input type="hidden" name="food_id" value="<?= $food['food_id']; ?>">
                                                    <button type="submit" class="order-button">View Details</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No food available for this restaurant.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No restaurants found.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

