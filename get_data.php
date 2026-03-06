<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'];

$conn = new mysqli("localhost", "root", "", "plastic_tracker");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "DB connection failed"]);
    exit;
}

$sql = "SELECT date, SUM(weight) as total_weight, SUM(co2) as total_co2 FROM usage_entries WHERE user_id = ? GROUP BY date ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>