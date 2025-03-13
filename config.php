<?php
// Database Connection
$host = "localhost"; // or "localhost:3308" if using a nonstandard port
$username = "root";
$password = "Kokoko88"; // Use your MySQL password here
$dbname = "secure_web_app"; // Ensure this matches your database name

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Remove the echo statement below
    // echo "Database connected successfully 🔥";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// OpenWeatherMap API Key
$api_key = "685194827bdaf5ce64fd1c8963866af8"; // Add this line
?>