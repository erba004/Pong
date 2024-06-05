<?php
    // Database connection parameters
    $servername = "172.20.128.23";
    $username = "root";
    $password = "Skole123";
    $database = "Pong";

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
    }

    

    // Sample data to insert
    $name = "John Doe";
    $leftScore = $leftSide;
    $rightScore = $rightSide;
    $winner = "";

    if ($leftScore > $rightScore) {
        $winner = "Left";
    } elseif ($rightScore > $leftScore) {
        $winner = "Right";
    } else {
        $winner = "Tie";
    }

    

    // Prepare SQL statement
    $sql = "INSERT INTO score (leftScore, rightScore, winner, name) VALUES ($leftScore, $rightScore, $winner, $name)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssi", $leftScore, $rightScore, $winner, $name);

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
