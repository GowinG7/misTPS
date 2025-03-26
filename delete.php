<?php
session_start();
include("dbconnect.php");

//to check is the session is set or not
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access!");
}

// Use the session-stored user ID directly
$id = $_SESSION["user_id"];

// Delete only the logged-in user's record
$query = "DELETE FROM tbl1 WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "<script>alert('Record deleted successfully'); window.location.href='display.php';</script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
