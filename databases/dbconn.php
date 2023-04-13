<?php
$servername='localhost';
$username="root";
$password="";
$dbname="review_management";
$conn = mysqli_connect($servername, $username, $password);

if($conn){
    $query="SELECT schema_name FROM information_schema.schemata WHERE schema_name='$dbname'";
    $result=mysqli_query($conn, $query);
    if(mysqli_num_rows($result)==0){
        mysqli_query($conn, "CREATE DATABASE ".$dbname);
        $conn = mysqli_connect($servername, $username, $password,$dbname); 
        if($conn){
            creteTables();
        }
    }else{
        $conn = mysqli_connect($servername, $username, $password,$dbname); 
    }
}

function creteTables(){
    $query = "CREATE TABLE IF NOT EXISTS users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(250),
        contact_info JSON,
        rating INT,
        description LONGTEXT,
        create_date DATETIME,
        last_update DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if(mysqli_query($GLOBALS['conn'], $query)) {
        echo "<script>alert('All Configuration Set Successfully')</script>";
    }
}