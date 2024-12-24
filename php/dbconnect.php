<?php
$host = 'localhost';
$db = 'medivault';
$user = 'root';
$password = ''; // Leave blank for XAMPP

$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
