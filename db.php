<?php
// Database configuration
$servername = "localhost"; // Usually 'localhost'
$username = "root";        // Default username for XAMPP
$password = "";            // Default password for XAMPP (empty)
$dbname = "online food ordering system"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} //else {
   // echo "Successfully connected to the database!";
//}
?>
