<?php

class Connection 
{
    public $servername = "localhost:3306";
    public $username = "root";
    public $password = "MySecret!478";
    public $db="Users";
    
    public function myConnection(){
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password,$this->db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
            return $conn;
    }
    
}



