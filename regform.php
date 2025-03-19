<?php
session_start();

include("dbconnect.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        // Get form data
        $name = $_POST["name"];
        $address = $_POST["address"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $department = $_POST["depart"];

        // Array to hold error messages
        $errorMessages = [];

        // Validate form fields
        if (empty($name) || empty($address) || empty($gender) || empty($dob) || empty($department)) {
            $errorMessages[] = "Please fill all the fields.";
        }

        if (!preg_match("/^[A-Za-z ]+$/", $name)) {
            $errorMessages[] = "Name should only contain letters and spaces.";
        }

        if (!preg_match("/^[A-Za-z0-9\s,-]+$/", $address)) {
            $errorMessages[] = "Address should only contain letters, numbers, space, and hyphen.";
        }

        if (empty($gender)) {
            $errorMessages[] = "Please select your gender.";
        }

        if (empty($department)) {
            $errorMessages[] = "Please select your department.";
        }

        $dobDate = new DateTime($dob);
        $today = new DateTime();
        $age = $today->diff($dobDate)->y;
        if ($age < 18) {
            $errorMessages[] = "Age must be 18 or older.";
        }


        // Insert data if no errors
        if(empty($errorMessages)){

            $qry = "INSERT INTO tbl1 (name, address, Gender, DOB, depart) VALUES ('$name', '$address', '$gender', '$dob', '$department')";
            $result = mysqli_query($conn, $qry);
        
        if ($result) {
            $_SESSION['successMessage'] = "Registration Done"; // Success message
        } else {
            $_SESSION['errorMessages'] = ["Registration failed."]; // Store error in session
        }
        } else{
            $_SESSION['errorMessages'] = $errorMessages; // Store error in session
        }
        //redirect to the same page to show messages
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="regform.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form action="regform.php" method="post">
          
          <?php
            //display success message
             if (isset($_SESSION['successMessage'])) {
                echo '<div class="success" id="successMessage">' . $_SESSION['successMessage'] . '</div>';
                unset($_SESSION['successMessage']); // Clear the session variable after displaying the message
            }
            //display error message
          if (isset($_SESSION['errorMessages'])) {
              echo '<div class="errormes" id="errorMessage">';
              foreach ($_SESSION['errorMessages'] as $error) {
                  echo '<p>' . $error . '</p>';
              }
              echo '</div>';
              unset($_SESSION['errorMessages']); // Clear the session variable after displaying the message
          }

        ?>
      <fieldset>
        <legend>Register Form</legend>

      

        <label for="name">Name:</label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" id="name" name="name" placeholder="Enter your name">
        <div><span id="name_error" class="error"></span></div>
        <br>

        <label for="address">Address:</label>&nbsp;
        <input type="text" id="address" name="address" placeholder="Enter your address">
        <div><span id="address_error" class="error"></span></div>
        <br>

        <label>Gender:</label>
        <input type="radio" id="male" name="gender" value="M">
        <label for="male">M</label> 

        <input type="radio" id="female" name="gender" value="F">
        <label for="female">F</label> 
        <div><span id="gender_error" class="error"></span></div>
        <br>

        <label for="dob">DOB:</label>
        <input type="date" id="dob" name="dob">
        <div><span id="dob_error" class="error"></span></div>
        <br>

        <label>Select Department:</label> <br>
        <input type="radio" id="it" name="depart" value="IT">
        <label for="it">IT</label><br>

        <input type="radio" id="finance" name="depart" value="Finance">
        <label for="finance">Finance</label><br>

        <input type="radio" id="inven" name="depart" value="Inventory">
        <label for="inven">Inventory</label><br>

        <input type="radio" id="prod" name="depart" value="Production">
        <label for="prod">Production</label>
        <div><span id="depart_error" class="error"></span></div>
        <br>

        <input type="submit" value="Submit" name="submit">
        <input type="reset" value="Reset" name="reset">
      </fieldset>

      <hr>

      <div class="footer">
        &nbsp; &nbsp; To display record click <a href="display.php" style="text-decoration: none;">here</a>
      </div>
      
    </form>

    <script>
        //yo chaie server side bata auuney lai handle grna uta rakhda confuse bayo
        $(document).ready(function () {
            // Function to hide messages after a specified timeout
            function hideMessage(messageId, timeout) {
                setTimeout(function () {
                    $("#" + messageId).fadeOut("slow");
                }, timeout); // Hide after specified time
            }

            // Hide success/error messages after 3 seconds
            if ($("#successMessage").length > 0) {
                hideMessage("successMessage", 3000); // 3 seconds delay for success message
            }
            if ($("#errorMessage").length > 0) {
                hideMessage("errorMessage", 5000); // 5 seconds delay for error message
            }
        });
    </script>

<script src="formval.js"></script>

</body>
</html>
