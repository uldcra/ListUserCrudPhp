<?php 

include ('../connection.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents('php://input'), TRUE);

$id=$_GET['id'];

$connection=new Connection;
$conn=$connection->myConnection();
$mensage=[
    "message"=>"",
    "status"=>200,
    "user"=>null
];

$sql = "DELETE FROM `users` where id='".$id."'";
             
             if ($conn->query($sql) === TRUE) {
                http_response_code(200);
                 $mensage['message']="Usuario eliminado";
                 $mensage['status']=200;
                 
             } else {
                http_response_code(500);
                $mensage['message']="Error: " . $sql . "<br>" . $conn->error;
                 //echo "Error: " . $sql . "<br>" . $conn->error;
             }
   
             $conn->close();
$mensage['user']=$data;
echo json_encode($data);
