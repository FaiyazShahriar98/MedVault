<?php
if (isset($_POST['category'])) {
    $category = $_POST['category'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'medivault');
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepared statement to fetch doctor names by category
    $stmt = $conn->prepare("SELECT id, name FROM doctors WHERE category = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $category);
    $stmt->execute();

    // Fetch result
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Output options for each doctor
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
    } else {
        echo "<option value=''>No doctors found</option>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<option value=''>Invalid request</option>";
}
?>
