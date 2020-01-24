<?php
session_start();

$host= "localhost";
$user= "admin";
$password= "pass123";
$db= "login";

$connections = mysqli_connect($host, $user, $password,$db);
if (!$connections) {
    # code...
    die ("Connection Failed:" . mysqli_connect_error());
    echo("Connection Error!");
}

//else{
//    echo("Connection Successfully");
//}

?>