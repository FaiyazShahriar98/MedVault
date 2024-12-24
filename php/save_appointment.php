<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'medivault');
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
        exit();
    }

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'message' => 'You must be logged in to schedule an appointment.']);
        exit();
    }

    $username = $_SESSION['username'];
    $doctor_id = $_POST['doctor'];
    $appointment_date = $_POST['date'];
    $additional_message = isset($_POST['message']) ? $_POST['message'] : "";

    // Check for duplicate appointments
    $check_stmt = $conn->prepare("SELECT * FROM appointments WHERE username = ? AND doctor_id = ? AND appointment_date = ?");
    $check_stmt->bind_param("sis", $username, $doctor_id, $appointment_date);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'You have already scheduled an appointment with this doctor on the selected date.']);
        exit();
    }
    $check_stmt->close();

    // Insert new appointment
    $stmt = $conn->prepare("INSERT INTO appointments (username, doctor_id, appointment_date, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $username, $doctor_id, $appointment_date, $additional_message);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Appointment successfully scheduled!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to schedule the appointment.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit();
}
?>
