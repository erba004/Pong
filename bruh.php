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

    // Sample data to insert
    $name = "John Doe";
    $leftScore = 19;
    $rightScore = 20;

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
