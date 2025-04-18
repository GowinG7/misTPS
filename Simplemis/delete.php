<?php

include("dbconnect.php");


$id = $_GET['id'];

$query = "DELETE FROM tbl1 WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "<script>alert('Record deleted successfully'); window.location.href='display.php';</script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
