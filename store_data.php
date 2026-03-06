<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Database connection
$conn = new mysqli("localhost", "root", "", "plastic_tracker");

// Extract data
$userId = $data['userId'];
$item = $data['item'];
$qty = $data['quantity'];
$usageDate = $data['usageDate'];
$weight = $data['weight'];
$co2 = $data['co2'];

// Prepare and execute insert
$stmt = $conn->prepare("INSERT INTO usage_entries (user_id, item, quantity, usage_date, weight, co2) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssissd", $userId, $item, $qty, $usageDate, $weight, $co2);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Data stored successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to store data"]);
}
?>