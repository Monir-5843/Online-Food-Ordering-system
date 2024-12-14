<?php 
include 'navbar.php';
session_start();
// Database connection
$conn = new mysqli('localhost', 'root', '', 'online food ordering system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input to prevent SQL injection
    $customer_id = $conn->real_escape_string($_POST['customer_id']);
    $restaurant_id = $conn->real_escape_string($_POST['restaurant_id']);
    $food_id = $conn->real_escape_string($_POST['food_id']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $comments = $conn->real_escape_string($_POST['comments']);

    // Check if foreign key values (customer_id, restaurant_id, food_id) exist in their respective tables
    $checkRestaurant = "SELECT restaurant_id FROM Restaurant WHERE restaurant_id = '$restaurant_id'";
    $checkFood = "SELECT food_id FROM Food WHERE food_id = '$food_id'";
    $checkCustomer = "SELECT customer_id FROM Customer WHERE customer_id = '$customer_id'";

    $isRestaurantValid = $conn->query($checkRestaurant)->num_rows > 0;
    $isFoodValid = $conn->query($checkFood)->num_rows > 0;
    $isCustomerValid = $conn->query($checkCustomer)->num_rows > 0;

    if ($isRestaurantValid && $isFoodValid && $isCustomerValid) {
        // Insert review into the Reviews table
        $sql = "INSERT INTO Reviews (customer_id, restaurant_id, food_id, rating, comments) 
                VALUES ('$customer_id', '$restaurant_id', '$food_id', '$rating', '$comments')";
        if ($conn->query($sql) === TRUE) {
            $message = "Review submitted successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Invalid customer, restaurant, or food ID. Please check your input.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Review</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #ff6f61, #ffca28, #4caf50, #2196f3);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 80px; /* Space for the fixed navbar */
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        form {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background-color: #ff6f61;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e65a50;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p.message {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #4caf50;
        }

        p.error {
            color: #ff6f61;
        }
    </style>
</head>
<body>
    <form method="POST" action="review.php">
        <h1>Submit a Review</h1>
        <label for="customer_id">Customer ID:</label>
        <input type="number" name="customer_id" id="customer_id" placeholder="Enter your customer ID" required>
        <label for="restaurant_id">Restaurant ID:</label>
        <input type="number" name="restaurant_id" id="restaurant_id" placeholder="Enter your restaurant ID" required>
        <label for="food_id">Food ID:</label>
        <input type="number" name="food_id" id="food_id" placeholder="Enter the food ID" required>

        <label for="rating">Rating (1-5):</label>
        <select name="rating" id="rating" required>
            <option value="">--Select Rating--</option>
            <option value="1">1 - Very Poor</option>
            <option value="2">2 - Poor</option>
            <option value="3">3 - Average</option>
            <option value="4">4 - Good</option>
            <option value="5">5 - Excellent</option>
        </select>

        <label for="comments">Comments:</label>
        <textarea name="comments" id="comments" rows="4" placeholder="Write your comments here..." required></textarea>

        <button type="submit">Submit Review</button>
        <?php 
        if (isset($message)) {
            echo "<p class='" . (strpos($message, "Error") === false ? "message" : "error") . "'>$message</p>";
        }
        ?>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
