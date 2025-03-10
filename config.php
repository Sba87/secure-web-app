<?php
// Database Connection
$host = "localhost"; 
$username = "root";
$password = "Kokoko88"; //  
$dbname = "secure_web_app"; 
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connected successfully 🔥";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
