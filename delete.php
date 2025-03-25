<?php
session_start();
include("dbconnect.php");

if(!isset($_SESSION["userid"])){
    die("Unauthorized access");
}
$id = $_GET['id'];

//to ensure user can only delete own record only
if($_SESSION["userid"] != $id){
    die("Unauthorized access");
}
$query = "Delete from tbl1 where id ='$id' ";
mysqli_query($conn, $query);

header("Location:display.php");
exit;

?>