<?php

echo("helo world");



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