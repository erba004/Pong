<?php



// Database credentials
$servername = "localhost";
$username = "root";
$password = "Skole123";
$dbname = "Pong";

// Create connection
$conn = @new mysqli($servername, $username, $password, $dbname);

// Get the JSON data sent by the JavaScript
$data = json_decode(file_get_contents('php://input'), true);


$leftSide = $data['leftSide'];
$rightSide = $data['rightSide'];
$name = "jhon doe";
$winner = false;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO score (leftSide, rightSide, winner, name) VALUES ($leftSide, $rightSide, $winner, $name)");
$stmt->bind_param("ssbs", $leftSide, $rightSide, $winner, $name);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}
// Success message
echo json_encode(['success' => "New record created successfully"]);

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>
