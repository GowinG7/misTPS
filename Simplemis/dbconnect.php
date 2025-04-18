<?php
$hostname = "localhost";
$Username = "root";
$password = "";
$database = "mis";
//create database connection
$conn = mysqli_connect($hostname, $Username, $password, $database);
//connection successful or not
if (!$conn)
    die("Connection failed!" . mysqli_connect_error());
?>