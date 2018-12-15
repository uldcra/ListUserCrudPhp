<?php
include ('../connection.php');

$connection=new Connection;
$conn=$connection->myConnection();

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(30) NOT NULL,
    age int(3) NOT NULL,
    email VARCHAR(50),
    job VARCHAR(50)
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table Users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    
    $conn->close();