<?php

echo("helo world");

$servername = "localhost";  //MySQL server name
$username = "root";         //MySQL username
$password = "Skole123";     //MySQL password
$dbname = "Pong";           //MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else  echo("it worked maybe");

// Data to be inserted
$name = "John Doe";
$leftScore = 2;
$rightScore = 3;
$winner = true;

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO score (leftScore, rightScore, winner, name) VALUES ($leftScore, $rightScore, $winner, $name)");
$stmt->bind_param("ss", $name, $email);

$stmt->execute();

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
