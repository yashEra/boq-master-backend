<?php
header("Content-Type: application/json");

// Allow requests from your React app's origin
header("Access-Control-Allow-Origin: http://localhost:3000"); // Update with your React app's URL

// Allow specific headers and methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Check for preflight (OPTIONS) request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(204);
  exit();
}

require_once '../../Classess/PartsOfConstructions/Walls.php';

// Get the posted data
$data = json_decode(file_get_contents("php://input"));

// Example: Accessing the "height", "length", and "unit" fields
$height = $data->height;
$length = $data->length;
$unit = $data->unit;

$wallobj = new Walls($height, $length);

// Process the data or perform necessary actions
$response = array(
  "message" => "Data received successfully",
  "height" => $height,
  "length" => $length,
  "unit" => $unit
);



echo json_encode($response);
?>
