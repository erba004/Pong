<?php
    // Database connection parameters
    $servername = "172.20.128.23";
    $username = "root";
    $password = "Skole123";
    $database = "Pong";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

        // Get the raw POST data
    $rawData = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($rawData, true);

    if ($data) {
        $leftSide = $data['leftSide'];
        $rightSide = $data['rightSide'];

        // Process the data as needed
        // For example, you can save the data to a database or perform some operations

        // Send a response back to the JavaScript
        echo json_encode(["status" => "success", "message" => "Data received successfully"]);
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

    } else {
        echo json_encode(["status" => "error", "message" => "Invalid data"]);
    }
    


?>
