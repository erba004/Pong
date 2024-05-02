<?php
    // Database connection parameters
    $servername = "172.20.128.78";
    $username = "root";
    $password = "12345";
    $database = "bruh";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Read the raw POST data
    $json_data = file_get_contents('php://input');

    // Decode the JSON data into a PHP associative array
    $data = json_decode($json_data, true);

    // Check if decoding was successful
    if ($data === null) {
        // JSON decoding failed
        http_response_code(400); // Bad Request
        echo "Error: Invalid JSON data";
    } else {
        // JSON decoding successful
        // Access the data
        $leftSide = $data['leftSide'];
        $rightSide = $data['rightSide'];

        // Process the data as needed
        // For example, you can perform database operations, calculations, etc.

        // Send a response if necessary
        echo "Received data: winSide = $leftSide, loseSide = $rightSide";
    }

    // Sample data to insert
    $name = "John Doe";
    $leftScore = $leftSide;
    $rightScore = $rightSide;

    // Prepare SQL statement
    $sql = "INSERT INTO score (Username, LeftScore, RightScore) VALUES ($name, $leftScore, $rightScore)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssi", $name, $leftScore, $rightScore);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
?>
