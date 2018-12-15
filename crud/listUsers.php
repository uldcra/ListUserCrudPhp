<?php

include ('../connection.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");

$connection=new Connection;
$conn=$connection->myConnection();


if(!$conn){
    echo "fail the connection";
    die();
}

    $sql = "SELECT * FROM users;  ";
    $result = $conn->query("SELECT * FROM users");

//Copy result into a associative array
    $json_array=array();
    while($row=mysqli_fetch_assoc($result)){
        $json_array[]=$row;
    }

    echo json_encode($json_array);
    

    $conn->close();
