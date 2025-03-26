<?php
session_start();
include("dbconnect.php");

// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access!");
}

$id = $_SESSION["user_id"]; // Use session-stored ID

// Fetch user data from tbl1
$query = "SELECT * FROM tbl1 WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $address = $row['address'];
    $gender = $row['Gender']; // Read-only
    $dob = $row['DOB'];
    $department = $row['depart']; // Read-only
} else {
    die("User not found!");
}

// Handle form submission
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $dob = $_POST["dob"];

    // Update only Name, DOB, and Address
    $update_query = "UPDATE tbl1 SET name='$name', address='$address', DOB='$dob' WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Data updated successfully'); window.location.href='display.php';</script>";
        exit();
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link rel="stylesheet" href="regform.css">
</head>
<body>
    <form action="" method="POST">
        <fieldset>
            <legend>Update Form</legend>

            <label for="id">ID:</label>
            <input type="text" name="id" value="<?php echo $id; ?>" readonly><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>

            <label for="dob">DOB:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required><br><br>

            <label>Gender:</label>
            <input type="text" id="gender" name="gender" value="<?php echo $gender; ?>" readonly><br><br>

            <label>Department:</label>
            <input type="text" id="department" name="department" value="<?php echo $department; ?>" readonly><br><br>

            <input type="submit" value="Update" name="submit">
            <input type="reset" value="Reset">
        </fieldset>
    </form>
</body>
</html>
