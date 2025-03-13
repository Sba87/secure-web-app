<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email']; // Unsanitized input

    // Generate insecure token
    $token = rand(100000, 999999); // 6-digit predictable token

    // Store token in the database (no expiry)
    $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
    $stmt->execute([$token, $email]);

    // No rate limiting or logging of attempts

    // Send reset link (fake email function for demonstration)
    $reset_link = "http://localhost/secure-web-app/reset-password.php?token=$token";
    echo "Password reset link sent to $email: $reset_link"; // For demo purposes
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
<h1>Forgot Password</h1>
<div style="margin: 20px; text-align: left;">
    <a href="index.php" style="text-decoration: none; padding: 10px; background: #007bff; color: white; border-radius: 5px;">
        Home Page
    </a>
</div>
<form method="post">
    Enter your email: <input type="email" name="email" required>
    <button type="submit">Send Reset Link</button>
</form>
</body>
</html>