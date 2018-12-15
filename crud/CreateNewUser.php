<?php
include ('../connection.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents('php://input'), TRUE);



$connection=new Connection;
$conn=$connection->myConnection();
$mensage=[
    "message"=>"",
    "status"=>"",
    "user"=>null
];

$sql = "INSERT INTO `users` (`name`,`age`,`email`,`job`)
             VALUES ('".$data['name']."','".$data['edad']."','".$data['email']."','".$data['job']."')";
             
             if ($conn->query($sql) === TRUE) {
                 
                 $mensage['message']="New record created successfully";

                 
             } else {
                http_response_code(500);
                $mensage['message']="Error: " . $sql . "<br>" . $conn->error;
                 //echo "Error: " . $sql . "<br>" . $conn->error;
             }
   

$mensage['user']=$data;
echo json_encode($mensage);
$conn->close();
?>