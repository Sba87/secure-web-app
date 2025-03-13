<?php
session_start();
include 'config.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SECURE CODE: Prepared statement for SQL Injection
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Bypass password check (intentionally left unfixed)
    if ($user) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Redirect to index.php
        exit(); // Stop script execution
    } else {
        echo "Invalid username or password 😭";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

</head>

<body>

<h1>Login</h1>
<div style="margin: 20px; text-align: left;">
    <a href="index.php" style="text-decoration: none; padding: 10px; background: #007bff; color: white; border-radius: 5px;">
        home Page
    </a>
</div>
<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
    <a href="forgot-password.php">Forgot Password?</a>
</form>
</body>
</html>