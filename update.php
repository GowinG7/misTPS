    <?php
    session_start();
    include("dbconnect.php");
    
    if(!isset($_SESSION["userid"])){
        die("Unauthorized access!");
    }
    $id = $_GET['id'];

    //url ko id value change grderw manipulate huna sakxa so 
    if($_SESSION["userid"] != $id ){
        die("Unauthorized access!");
    }

    // Fetch user data from tbl1
    $query = "SELECT * FROM tbl1 WHERE id = $id"; // Directly use $id in query
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $address = $row['address'];
        $gender = $row['Gender'];
        $dob = $row['DOB'];
        $department = $row['depart'];
    } else {
        die("User not found!");
    }

    // Handle form submission
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $gender = $_POST["gender"]; // Get the selected gender from the form

        // Update user data
        $update_query = "UPDATE tbl1 SET name='$name', address='$address', Gender='$gender' WHERE id=$id"; // Directly use $id

        if (mysqli_query($conn, $update_query)) {
            echo "Data updated successfully";
            header("Location: display.php"); // Redirect after update
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
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"><br><br>

            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="M" <?php if ($gender == "M") echo "checked"; ?>>
            <label for="male">M</label> 

            <input type="radio" id="female" name="gender" value="F" <?php if ($gender == "F") echo "checked"; ?>>
            <label for="female">F</label> 
            <br><br>

            <label for="dob">DOB:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" readonly><br><br>

            <label>Select Department:</label> <br>
            <input type="radio" id="it" name="depart" value="IT" <?php if ($department == "IT") echo "checked"; ?> disabled>
            <label for="it">IT</label><br>

            <input type="radio" id="finance" name="depart" value="Finance" <?php if ($department == "Finance") echo "checked"; ?> disabled>
            <label for="finance">Finance</label><br>

            <input type="radio" id="inven" name="depart" value="Inventory" <?php if ($department == "Inventory") echo "checked"; ?> disabled>
            <label for="inven">Inventory</label><br>

            <input type="radio" id="prod" name="depart" value="Production" <?php if ($department == "Production") echo "checked"; ?> disabled>
            <label for="prod">Production</label><br><br>

            <input type="submit" value="Update" name="submit">
            <input type="reset" value="Reset">
        </fieldset>
    </form>
</body>
</html>
