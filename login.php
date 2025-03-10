<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // INSECURE CODE: Vulnerable to SQL Injection (intentionally left unfixed)
    $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
    
    try {
        $result = $conn->query($sql);
    } catch (PDOException $e) {
        echo "Query error: " . $e->getMessage();
        exit;
    }

    if ($result) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
    } else {
        $user = false;
    }

    // Bypass password check to demonstrate vulnerability
    if ($user) {
        $_SESSION['username'] = $user['username'];
        echo "Welcome, " . $user['username'] . " 🔥";
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
<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
</body>
</html>