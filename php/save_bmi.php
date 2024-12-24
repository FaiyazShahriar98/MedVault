<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve input values
    $username = $_SESSION['username'];
    $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);
    $height = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_FLOAT);
    $bmi = filter_input(INPUT_POST, 'bmi', FILTER_VALIDATE_FLOAT);

    // Validate required fields
    if ($weight === false || $height === false || $bmi === false) {
        echo "Error: Invalid input values.";
        exit();
    }

    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'medivault');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username exists in the users table
    $user_check = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $user_check->bind_param("s", $username);
    $user_check->execute();
    $result = $user_check->get_result();

    if ($result->num_rows === 0) {
        echo "Error: Username does not exist.";
        $user_check->close();
        $conn->close();
        exit();
    }

    $user_check->close();

    // Insert BMI record
    $stmt = $conn->prepare("INSERT INTO bmi_records (username, weight, height, bmi, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sddd", $username, $weight, $height, $bmi);

    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: ../bmi.php?success=BMI record saved successfully!");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to the BMI page if accessed without POST
    header("Location: ../bmi.php");
    exit();
}
?>
