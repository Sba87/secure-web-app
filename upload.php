<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $upload_dir = 'uploads/';

        // INSECURE CODE: Allow ANY file type (no validation)
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            echo "File uploaded successfully! 🔥<br>";
            echo "File Name: " . htmlspecialchars($file_name); // Display sanitized name
        } else {
            echo "File upload failed 😭";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
<h1>File Upload</h1>
<form method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
</form>
</body>
</html>