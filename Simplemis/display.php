<!DOCTYPE html>
<html lang="en">

<head>
    <title>Display record</title>
    <style>
        body {
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
        }

        .search-box {
            margin-left: 10%;
            padding: 7px;
        }

        table {
            background-color: white;
            border: 1px solid black;
            margin-left: 10%;
            border-collapse: collapse;
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

        th, td {
            padding: 8px;
        }

        p {
            margin-left: 10%;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <?php
    include("dbconnect.php");

    $query = "SELECT * FROM tbl1";
    $result = $conn->query($query);
    ?>

    <div class="search-box">
        <input type="text" id="searchbox" placeholder="Search by Name" onkeyup="filterTable()">
    </div>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <caption><h2><u>Users Record</u></h2></caption>
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
            <tbody id="table-body">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td class="name"><?= $row['name'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['Gender'] ?></td>
                        <td><?= $row['DOB'] ?></td>
                        <td><?= $row['depart'] ?></td>
                        <td><a href="update.php?id=<?= $row['id'] ?>">Update</a></td>
                        <td><a href="delete.php?id=<?= $row['id'] ?>" style="color: red;" onclick="return confirm('Are you sure?')">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found</p>
    <?php endif; ?>

    <script>
        function filterTable() {
            const input = document.getElementById("searchbox").value.toLowerCase();
            const rows = document.querySelectorAll("#table-body tr");

            rows.forEach(row => {
                const nameCell = row.querySelector(".name").textContent.toLowerCase();
                row.style.display = nameCell.includes(input) ? "" : "none";
            });
        }
    </script>
</body>

</html>



    <!-- ❌ Not ideal for:
    -  1,000+ records or more.
    -  Public systems where data grows frequently.
    -  Phones or older devices with slow JS processing.
    
    Program Title: Real-time Record Filter using PHP and JavaScript

    Concept:
    This program displays all user records from the database and allows real-time filtering 
    by name as the user types into the search box. It does not use AJAX or page reloads.

    Flow of the Program:
    1. PHP connects to the MySQL database and fetches all data from `tbl1` table.
    2. The data is displayed in an HTML table using PHP.
    3. A search input box is provided above the table.
    4. JavaScript handles the `onkeyup` event on the input field.
       - It captures the user input.
       - It filters the visible table rows by matching the name column text with the input.
    5. Matching rows remain visible; non-matching rows are hidden.
    
    Note:
    This solution is efficient for small to moderate datasets where all data can be loaded
    initially. For large datasets, use AJAX + backend search for better performance. -->

