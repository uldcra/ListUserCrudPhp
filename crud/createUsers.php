<?php


class createUsers{


    public function saveUser(User $user){
        $servername = "localhost:3306";
        $username = "root";
        $password = "MySecret!478";
        $db="Users";
      
        $conn = new mysqli($servername, $username, $password,$db);
         if(!$conn){
             echo "fail the connection";
             die();
         }
     
             $sql = "INSERT INTO `users` (`name`,`age`,`email`,`job`)
             VALUES ('".$user->getName()."','".$user->getEdad()."','".$user->getEmail()."','".$user->getTrabajo()."')";
             
             if ($conn->query($sql) === TRUE) {
                 echo "New record created successfully";
             } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
             }
    
    }

}











