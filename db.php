<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "syskart_db";//when Database Created 

//create database connection
$conn = mysqli_connect($server,$user,$password,$database);

//confirm connection is successful

if(!$conn){
    //Die if Connection was not successful
    die("sorry we failed to Connect:". mysqli_connect_error());
}
// else{
//     //connection successful message
//     echo "Connection Was Successful.";
// }
?>