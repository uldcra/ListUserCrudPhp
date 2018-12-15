<?php
include ('./models/User.php');
include ('./crud/createUsers.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



function comparaArrays(array $myarray,array $myarray2){
    for( $i=0;i<count($myarray);$i++){

    }

}
$data=[
    "name"=>"",
    "message"=>"",
    "csv"=>"",
    "iguales"=>"",
    "err"=>""
];
$iguales;
$mesage="";
$csv=[];
$csv_header=[];
$csv_content=[];
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$uploadOk = 0;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if(isset($_FILES["fileToUpload"]["tmp_name"])){
        $uploadOk = 1;
    }
    /*if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }*/

    if ($uploadOk == 0) {
        $mesage= "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $mesage=  "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            $mesage= "Sorry, there was an error uploading your file.";
        }
    }
    //$fila = 1;
    $comprobacion=[
        "ID",
        "NOMBRE",
        "Edad",
        "TRABAJO",
        "EMAIL"];
    if (($gestor = fopen($target_file, "r")) !== FALSE) {
        $contador=0;
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            $numero = count($datos);
            
          // $texto="$numero de campos en la línea $fila+1:";
          
          
            
            for ($c=0; $c < $numero; $c++) {
                if($c==$contador){
                    array_push($csv_header,$datos[$c]);
                    $contador++;
                }else{
                    array_push($csv_content,$datos[$c]);
                }
              
            }
           // $fila++;
        }
       
        fclose($gestor);
        
    }else{
        array_push($csv,"no ha entrado");
    }
   

try{

    /*$data=[
        "name"=>$_FILES["fileToUpload"]["tmp_name"],
        "message"=>$mesage,
        "csv_header"=>$csv_header,
        "csv_content"=>$csv_content
    ];*/
    if($comprobacion!=$csv_header){
        $data=[
            "name"=>"",
            "message"=>"",
            "csv_header"=>"",
            "csv_content"=>"",
            "error"=>"no coinciden los campos",
        ];
        
    }
    if(count($csv_header)>count($comprobacion)){
        $data['error'].=" Hay mas campos de los solicitados";
        }
       
}catch(Exception $e){

    $data=[
        "name"=>"",
        "message"=>"error inesperado",
        "csv"=>""
    ];
}
$users=array();
for ($i=0; $i <count($csv_content) ; $i++) { 
    $newUser=new User;
    $newUser->setId($csv_content[$i]);
    $newUser->setName($csv_content[$i+1]);
    $newUser->setEdad($csv_content[$i+2]);
    $newUser->setTrabajo($csv_content[$i+3]);
    $newUser->setEmail($csv_content[$i+4]);
    array_push($users,$newUser);
    $i+=4;
 } 
 
 //array_push($data,$users);
$data['users']=$users;
$data['count']=count($csv_content);
/*$newCreateUsers=new CreateUser;
$newCreateUsers->createUser($users[0]);*/
$saveUser=new createUsers;

for ($i=0; $i <count($users) ; $i++) { 
    # code...
    $saveUser->saveUser($users[$i]);
    
    
}


echo json_encode($data);




?>