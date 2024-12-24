<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.html");
    exit();
}

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'medivault');
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM medical_records WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: ../profile.php?success=Record+deleted+successfully");
    } else {
        // Failed to delete
        header("Location: ../profile.php?error=Failed+to+delete+record");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to profile if 'id' is not set
    header("Location: ../profile.php?error=Invalid+request");
    exit();
}
?>
