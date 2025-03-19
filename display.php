<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Display record</title>
        <style>
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: whitesmoke;
                }
            form{
                background-color: white;
                border: 1px solid black;
                margin: 10px;
                padding: 20px;
                margin-bottom: 70px;
            }

            .error-message{
                color: red;
                
            }
        </style>
    </head>

    <?php
    session_start();
        include("dbconnect.php");
        $message = ""; 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['search'])) {
            $name = $_POST['name'];
            $dob = $_POST['dob'];

            $query = "Select * from tbl1 where name = '$name' AND dob = '$dob'  ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                $_SESSION['message'] = " NO registered user found for the entered Name and DOB";

                header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page to prevent resubmission
                exit; // Make sure no further code is executed
            } 
           }
        }
        ?>

    <body>
        
        <form method="POST" action="display.php">

            <!-- message displaying of user not found which is stored in $message -->
            <!-- here the message is already initialized so used !empty() 
            if used isset($message) always return empty even when it's empty-->
    

            <?php
             if (isset($_SESSION['message'])) {
                echo '<div class="error-message" id="message">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']); // Clear the session variable after displaying the message
            }
        ?>
        <div class="heading">
            <h4>Enter your data to display record</h4>
        </div>


            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter your name"/>
            <br><br>
            <label>DOB:</label>
            <input type="date" name="dob" required>
            <br><br>
            <button type="submit" name="search">Search</button>
            <br><br>
              <hr>
            &nbsp;&nbsp;Click here to go <a href="regform.php" style="text-decoration: none;" >Home page</a>

        </form>
       
   
        <table border="1" cellpadding="10" cellspacing="0" style="margin-top:350px;margin-left:-380px;">
            <caption> <h2 style="margin-left: -250px;">Your record</h2></caption>
            <tr> <th>ID</th><th>Name</th><th>Address</th><th>Gender</th><th>DOB</th><th>Department</th><th>Action</th></tr>
           
           <?php
            //check if we have a valid result
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
        //  JavaScript to remove messages after 3 seconds 
        setTimeout(function() {
        // Handle success message
        var message = document.getElementById("message");
        if (message) {
            message.style.transition = "opacity 0.5s";
            message.style.opacity = "0";
            setTimeout(() => message.remove(), 500); // Remove after fade out
        }
        }, 3000); //3-second delay before fading out
  
        </script>
      
    </body>
</html>