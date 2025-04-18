<!DOCTYPE html>
<html lang="en">

<head>
    <title>Display record</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: whitesmoke;
        }

        form {
            background-color: white;
            border: 1px solid black;
            margin: 10px;
            padding: 20px;
            margin-bottom: 70px;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<?php
session_start();
include("dbconnect.php");

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $name = trim($_POST['name']);
    $dob = trim($_POST['dob']);


    $query = "SELECT * FROM tbl1 WHERE name = '$name' AND dob = '$dob'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION['message'] = "No registered user found for the entered Name and DOB";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
    }
}

// Fetch user details if session user_id is set
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM tbl1 WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
}
?>

<body>
    <form method="POST" action="display.php">
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="error-message" id="message">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']); // Clear the message after displaying
        }
        ?>
        <div class="heading">
            <h4>Enter your data to display record</h4>
        </div>

        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter your name" required />
        <br><br>
        <label>DOB:</label>
        <input type="date" name="dob" required>
        <br><br>
        <button type="submit" name="search">Search</button>
        <br><br>
        <hr>
        &nbsp;&nbsp;Click here to go <a href="regform.php" style="text-decoration: none;">Home page</a>
    </form>

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top:350px;margin-left:-380px;">
        <caption>
            <h2 style="margin-left: -250px;">Your record</h2>
        </caption>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Department</th>
            <th>Action</th>
            <th>Action</th>
        </tr>

        <?php
        if (isset($result) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["Gender"] . "</td>";
                echo "<td>" . $row["DOB"] . "</td>";
                echo "<td>" . $row["depart"] . "</td>";
                echo "<td><a href='update.php?id=" . $row['id'] . "'>Update</a></td>"; 
                echo "<td><a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                echo "</tr>";
            }
        }
        mysqli_close($conn);
        ?>
    </table>

    <script>
        setTimeout(function () {
            var message = document.getElementById("message");
            if (message) {
                message.style.transition = "opacity 0.5s";
                message.style.opacity = "0";
                setTimeout(() => message.remove(), 500);
            }
        }, 3000);
    </script>
</body>

</html>