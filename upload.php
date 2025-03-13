<?php
session_start();
include 'config.php';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $upload_dir = 'uploads/';

        // Block risky file types (e.g., .php)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'txt'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            die("Error: Only JPG, PNG, and TXT files are allowed.");
        }

        // Move the file to the uploads folder
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            // Log the upload in the database
            $username = $_SESSION['username']; // Get the logged-in user
            $stmt = $conn->prepare("INSERT INTO uploaded_files (username, filename) VALUES (?, ?)");
            $stmt->execute([$username, $file_name]);

            echo "File uploaded successfully! 🔥<br>";
        } else {
            echo "File upload failed 😭";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}

// Fetch all uploaded files
$stmt = $conn->query("SELECT * FROM uploaded_files ORDER BY uploaded_at DESC");
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <style>
        .file-list {
            margin-top: 20px;
        }
        .file-item {
            margin-bottom: 10px;
        }
        .file-link {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
<h1>File Upload/Download</h1>
<div style="margin: 20px; text-align: left;">
    <a href="index.php" style="text-decoration: none; padding: 10px; background: #007bff; color: white; border-radius: 5px;">
        Home Page
    </a>
</div>
<form method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
</form>

<!-- Display uploaded files -->
<div class="file-list">
    <h2>Uploaded Files (press link to download)</h2>
    <?php if (count($files) > 0) : ?>
        <?php foreach ($files as $file) : ?>
            <div class="file-item">
                <a class="file-link" href="uploads/<?php echo $file['filename']; ?>" download>
                    <?php echo $file['filename']; ?>
                </a>
                <span> (Uploaded by: <?php echo $file['username']; ?>)</span>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No files uploaded yet.</p>
    <?php endif; ?>
</div>
</body>
</html>