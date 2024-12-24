<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];

    $conn = new mysqli('localhost', 'root', '', 'medivault');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT DISTINCT hospital_name FROM doctors WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['hospital_name'] . "'>" . $row['hospital_name'] . "</option>";
    }

    $stmt->close();
    $conn->close();
}
?>
