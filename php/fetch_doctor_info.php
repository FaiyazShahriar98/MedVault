<?php
if (isset($_POST['doctor'])) {
    $doctor = $_POST['doctor'];
    $conn = new mysqli('localhost', 'root', '', 'medivault');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT name, details FROM doctors WHERE name = ?");
    $stmt->bind_param("s", $doctor);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctorInfo = $result->fetch_assoc();

    echo json_encode($doctorInfo);

    $stmt->close();
    $conn->close();
}
?>
