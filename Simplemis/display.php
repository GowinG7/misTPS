<!DOCTYPE html>
<html lang="en">

<head>
    <title>Display record</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: whitesmoke;

            margin: 0;
            padding: 0;
        }

        form {
            margin-top: 20px;
            margin-left: 490px;
        }

        table {
            background-color: white;
            border: 1px solid black;

        }

        button {
            padding: 4px;
            margin: 10px;
            text-align: center;
            background-color: skyblue;
            cursor: pointer;
        }

        input[name="search"] {
            padding: 4px;
        }
    </style>
</head>

<body>
    <?php

    include("dbconnect.php");

    //search by entering name backend code
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    } else {
        $search = "";
    }

    if (!empty($search)) {
        $query = "Select * from tbl1 where name like '%$search%' ";
    } else {
        $query = "SELECT * FROM tbl1";
    }
    $result = $conn->query($query);
    ?>


    <?php
    if (isset($result) && mysqli_num_rows($result) > 0) {
        ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <caption>

                <!-- search box for users record  -->
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search by Name" value="<?php echo $search; ?>">
                    <!-- Get method so url ma visible hunxa lekhya naam ani mathi sql operation -->
                    <button type="submit">Search</button>
                </form>

                <h2><u>Users Record</u></h2>

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

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["Gender"] . "</td>";
                echo "<td>" . $row["DOB"] . "</td>";
                echo "<td>" . $row["depart"] . "</td>";
                echo "<td><a href=update.php?id=" . $row['id'] . ">Update</a></td>";
                echo "<td><a href='delete.php?id=" . $row['id'] . "'  style='color: red;'   onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <?php
    } else {
        echo "<p>No users found</p>";
    }
    mysqli_close($conn);
    ?>


</body>

</html>