<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email input

    // Check if the user has exceeded the reset limit
    $stmt = $conn->prepare("SELECT COUNT(*) FROM password_reset_attempts WHERE email = ? AND timestamp > NOW() - INTERVAL 1 HOUR");
    $stmt->execute([$email]);
    $attempts = $stmt->fetchColumn();

    if ($attempts >= 3) {
        die("You have exceeded the password reset limit. Please try again later.");
    }

    // Generate a secure reset token
    $token = bin2hex(random_bytes(16)); // 32-character secure token
    $expiry = date("Y-m-d H:i:s", time() + 3600); // Token expires in 1 hour

    // Store token in the database
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?");
    $stmt->execute([$token, $expiry, $email]);

    // Log the reset attempt
    $stmt = $conn->prepare("INSERT INTO password_reset_attempts (email, timestamp) VALUES (?, NOW())");
    $stmt->execute([$email]);

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