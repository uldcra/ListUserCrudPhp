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
$sql="UPDATE `users` SET name='".$data['name']."',age= '".$data['age']."', 
email='".$data['email']."', job='".$data['job']."' 
where id='".$data['id']."'
";

             
             if ($conn->query($sql) === TRUE) {
                 
                 $mensage['message']="New User update successfully";

                 
             } else {
                http_response_code(500);
                $mensage['message']="Error: " . $sql . "<br>" . $conn->error;
                 //echo "Error: " . $sql . "<br>" . $conn->error;
             }
   

$mensage['user']=$data;
echo json_encode($mensage);
$conn->close();
?>