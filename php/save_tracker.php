<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'medivault';

// Connect to database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $blood_pressure = $_POST['blood_pressure'];
    $sugar_level = $_POST['sugar_level'];

    $sql = "INSERT INTO blood_sugar_tracker(user_id, date, blood_pressure, sugar_level) VALUES (1, '$date', '$blood_pressure', '$sugar_level')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
