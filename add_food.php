<?php
session_start();

// Include the admin navbar
include 'admin_navbar.php';

// Initialize variables for success and error messages
$success = $error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form inputs
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $restaurant_id = $_POST['restaurant_id'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image
    if (isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["tmp_name"] !== "") {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $error = "File is not an image.";
            $upload_ok = 0;
        }
    } else {
        $error = "No image file selected.";
        $upload_ok = 0;
    }

    // Allow only specific file formats
    if (!in_array($image_file_type, ["jpg", "jpeg", "png", "gif"])) {
        $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $upload_ok = 0;
    }

    // Ensure the upload directory is writable
    if (!is_dir($target_dir) || !is_writable($target_dir)) {
        $error = "Upload directory is not writable or does not exist.";
        $upload_ok = 0;
    }

    // Move file to target directory
    if ($upload_ok && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = $target_file;
    } else {
        $error = $error ?: "There was an error uploading the file.";
        $upload_ok = 0;
    }

    // Proceed with database insertion if there were no upload errors
    if ($upload_ok) {
        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'online food ordering system');

        // Check database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Validate the restaurant ID exists
        $check_restaurant = $conn->prepare("SELECT restaurant_id FROM restaurant WHERE restaurant_id = ?");
        $check_restaurant->bind_param("i", $restaurant_id);
        $check_restaurant->execute();
        $result = $check_restaurant->get_result();

        if ($result->num_rows > 0) {
            // Insert food into the database
            $stmt = $conn->prepare("INSERT INTO food (name, price, description, restaurant_id, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sdsss", $name, $price, $description, $restaurant_id, $image_path);

            if ($stmt->execute()) {
                $success = "Food item added successfully!";
            } else {
                $error = "Database error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = "Invalid restaurant ID.";
        }

        $check_restaurant->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
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
            margin-top: 100px;
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        label {
            font-weight: bold;
        }

        button {
            background-color: #ff6f61;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e65a50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Add New Food</h2>
        <?php if ($error) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <?php if ($success) { echo "<div class='alert alert-success'>$success</div>"; } ?>
        <form method="POST" action="add_food.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Food Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="restaurant_id" class="form-label">Restaurant ID</label>
                <input type="number" class="form-control" id="restaurant_id" name="restaurant_id" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Food Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Food</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
