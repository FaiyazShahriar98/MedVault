<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../php/login.php");
    exit();
}

// Fetch the username from the session
$username = $_SESSION['username'];

// Check if the phone number is sent via POST
if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'medivault');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to update the phone number
    $stmt = $conn->prepare("UPDATE users SET phone = ? WHERE username = ?");
    $stmt->bind_param("ss", $phone, $username);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the profile page with a success message
        header("Location: ../profile.php?success=Phone number updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Phone number not set.";
}
?>
