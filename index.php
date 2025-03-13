<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Secure Web App</title>
</head>
<body>
    <h1>Welcome to the Secure Web App</h1>
    <?php if (isset($_SESSION['username'])) : ?>
        <p>Logged in as: <?php echo $_SESSION['username']; ?></p>
       <a href="logout.php">Logout</a>
    <?php else : ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
    <hr>
    <h2>Features:</h2>
    <ul>
        <li><a href="upload.php">Upload Files</a></li>
        <li><a href="weather.php">Check Weather</a></li>
    </ul>
</body>
</html>