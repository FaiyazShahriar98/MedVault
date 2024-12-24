<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../php/login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'medivault');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging: Check if the form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
}

if (isset($_FILES['medical-record'])) {
    $username = $_SESSION['username'];
    $file = $_FILES['medical-record'];

    // Allowed file types
    $allowed_types = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx', 'xlsx', 'xls', 'txt'];

    // Extract file information
    $file_name = basename($file['name']);
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Debugging: Validate file input
    if (empty($file_name)) {
        die("No file selected for upload!");
    }

    // Validate file type
    if (!in_array($file_ext, $allowed_types)) {
        die("File type not allowed! Allowed types are: " . implode(", ", $allowed_types));
    }

    // Validate file size (optional: limit size to 5MB)
    if ($file_size > 5 * 1024 * 1024) {
        die("File size exceeds the maximum limit of 5MB!");
    }

    // Upload file to the server
    $upload_dir = '../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $upload_path = $upload_dir . $file_name;

    if (move_uploaded_file($file_tmp_name, $upload_path)) {
        $stmt = $conn->prepare("INSERT INTO medical_records (username, file_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $file_name);

        if ($stmt->execute()) {
            header("Location: ../profile.php?upload_success=1");
            exit();
        } else {
            echo "Error saving file record: " . $conn->error;
        }
    } else {
        die("Failed to upload the file. Please try again.");
    }
} else {
    die("No file uploaded! Ensure your form input has the correct name attribute.");
}
?>
