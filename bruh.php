<?php


// Turn on output buffering
ob_start();

// Set the Content-Type to application/json
header('Content-Type: application/json');

// Create an associative array with sample data
$test = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com'
];

// Output the JSON-encoded data
echo json_encode($test);

// Flush the output buffer and turn off output buffering
ob_end_flush();


// Database credentials
$servername = "localhost";
$username = "root";
$password = "Skole123";
$dbname = "Pong";

// Error handling function
function handleError($message) {
    error_log($message);
    echo json_encode(['error' => $message]);
    exit;
}

// Create connection
$conn = @new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    handleError("Connection failed: " . $conn->connect_error);
}

// Get the JSON data sent by the JavaScript
$data = json_decode(file_get_contents('php://input'), true);
// print_r($data);
// echo $data["operacion"];

// Check if data is received
if ($data === null) {
    handleError("No data received or JSON is invalid");
}

// Validate the received data
if (!isset($data['leftSide']) || !isset($data['rightSide'])) {
    handleError("Invalid data: both 'leftSide' and 'rightSide' are required");
}

$leftSide = $data['leftSide'];
$rightSide = $data['rightSide'];
$name = "jhon doe";
$winner = 0;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO score (leftSide, rightSide, winner, name) VALUES ($leftSide, $rightSide, $winner, $name)");
if ($stmt === false) {
    handleError("Prepare statement failed: " . $conn->error);
}

if (!$stmt->bind_param("ss", $leftSide, $rightSide)) {
    handleError("Binding parameters failed: " . $stmt->error);
}

// Execute the statement
if (!$stmt->execute()) {
    handleError("Execute statement failed: " . $stmt->error);
}

// Success message
echo json_encode(['success' => "New record created successfully"]);

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>
