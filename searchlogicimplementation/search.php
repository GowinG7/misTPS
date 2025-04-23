<?php
include("../dbconnect.php");

$search = isset($_GET['search']) ? $_GET['search'] : "";

$query = !empty($search) 
    ? "SELECT * FROM tbl1 WHERE name LIKE '%$search%'" 
    : "SELECT * FROM tbl1";

$result = $conn->query($query);

if ($result && mysqli_num_rows($result) > 0): ?>
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

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['Gender'] ?></td>
                <td><?= $row['DOB'] ?></td>
                <td><?= $row['depart'] ?></td>
                <td><a href="update.php?id=<?= $row['id'] ?>">Update</a></td>
                <td><a href="delete.php?id=<?= $row['id'] ?>" style="color: red;" onclick="return confirm('Are you sure?')">Delete</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No users found</p>
<?php endif;

$conn->close();
?>

