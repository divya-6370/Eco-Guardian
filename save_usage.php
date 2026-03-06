<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // or your MySQL password
$dbname = 'plastic';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get POST data
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];
$weight = $_POST['weight'];
$co2 = $_POST['co2'];

// Insert into database
$sql = "INSERT INTO usage_track (item, quantity, date, weight, co2) VALUES ('$item', '$quantity', '$date', '$weight', '$co2')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Data saved successfully!']);
} else {
    echo json_encode(['message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>