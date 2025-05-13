<!--this is my own concept model with form for searching and search button to display data --> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Display record with search button triggering</title>
    <style>
        body {
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
        }

         form {
            margin-left: 10%;
            justify-content: center;
            padding: 7px;
            } 

        .search-bar{

            position: sticky;
            background-color: whitesmoke;
            

        }

        table {
            background-color: white;
            border: 1px solid black;
            justify-content: center;
            align-items: center;
            margin-left: 10%;
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
        /* for showing info if no record found */
        p{
            margin-left: 10%;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <?php

    include("../Simplemis/dbconnect.php");

        // Search by entering name - backend code
        if (isset($_GET['search'])) {
            $search = $_GET['search'];   // The name 'search' here should match the input field name in the form
        } else {
            $search = "";   // Default to an empty string if no search is provided
        }

        // Prepare the SQL query based on the search term
        if (!empty($search)) {
            $query = "SELECT * FROM tbl1 WHERE name LIKE '%$search%' ";
        } else {
            $query = "SELECT * FROM tbl1";  // If no search term, retrieve all records
        }
        $result = $conn->query($query);
    ?>

    <div class="search-box">
        <!-- Search form for user records -->
        <form method="GET" action=""> 

        <!-- The input field's name must match the PHP variable ($_GET['search']) 
        flow : Form submission → Data in URL → PHP picks it using $_GET → Stores in $search → Echoed back into form 
        
        -->
        <input type="text" name="search" id="searchbox" placeholder="Search by Name" value="<?php echo $search; ?>">

        <!-- PHP echo $search is used to retain the previously entered value in the input field after form submission. -->
        <!-- When the form is submitted and the page reloads, the value entered by the user stays in the search box for a better user experience. -->

        <button type="submit">Search</button>
        </form>
    </div>


    <?php
    if (isset($result) && mysqli_num_rows($result) > 0) {
        ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <caption>
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