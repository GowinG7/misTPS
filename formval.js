
    $(document).ready(function () {
    var isValid; // Flag to track if the form is valid

    // Function to hide messages after 1 second
    function hideMessage(messageId) {
        setTimeout(function () {
            $("#" + messageId).fadeOut("slow");
        }, 2000); // Hide after 1 second
    }

    // Hide success/error messages after 1 second
    if ($("#successMessage").length > 0) {
        hideMessage("successMessage");
    }
    if ($("#errorMessages").length > 0) {
        hideMessage("errorMessages");
    }

    // Validate Name
    $("#name").on("input", function () {
        var name = $(this).val().trim();
        if (name === "") {
            showError("name", "Name cannot be empty.");
            isValid = false; // Mark form as invalid
        } else if (!/^[A-Za-z ]+$/.test(name)) {
            showError("name", "Name should contain only letters and spaces.");
            isValid = false; // Mark form as invalid
        } else {
            hideError("name");
        }
    });

    // Validate Address
    $("#address").on("input", function () {
        var address = $(this).val().trim();
        if (address === "") {
            showError("address", "Address cannot be empty.");
            isValid = false; // Mark form as invalid
        } else if (!/^[A-Za-z0-9\s,-]+$/.test(address)) {
            showError("address", "Address should contain only letters, numbers, spaces, commas, and hyphens.");
            isValid = false; // Mark form as invalid
        } else {
            hideError("address");
        }
    });

    // Validate Gender Selection
    $("input[name='gender']").on("change", function () {
        if (!$("input[name='gender']:checked").val()) {
            showError("gender", "Please select a gender.");
            isValid = false; // Mark form as invalid
        } else {
            hideError("gender");
        }
    });

    // Validate Date of Birth (Age must be 18+)
    $("#dob").on("input", function () {
        var dob = $(this).val();
        if (!dob) {
            showError("dob", "Please select your date of birth.");
            isValid = false; // Mark form as invalid
            return;
        }

        var dobDate = new Date(dob);
        var today = new Date();
        var age = today.getFullYear() - dobDate.getFullYear();
        var monthDiff = today.getMonth() - dobDate.getMonth();
        var dayDiff = today.getDate() - dobDate.getDate();

        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
            age--;
        }

        if (age < 18) {
            showError("dob", "You must be at least 18 years old.");
            isValid = false; // Mark form as invalid
        } else {
            hideError("dob");
        }
    });

    // Validate Department Selection
    $("input[name='depart']").on("change", function () {
        if (!$("input[name='depart']:checked").val()) {
            showError("depart", "Please select a department.");
            isValid = false; // Mark form as invalid
        } else {
            hideError("depart");
        }
    });

    // Function to show error message
    function showError(input, message) {
        $("#" + input + "_error").text(message).css("color", "red").show();
    }

    // Function to hide error message
    function hideError(input) {
        $("#" + input + "_error").hide();
    }

    // Prevent form submission if there are validation errors
    $("form").on("submit", function (e) {
        isValid = true; // Reset validation flag

    // Trigger validation for each field
    // When the user clicks Submit, this line forces all validation functions to run on all form fields at once.
    // If any field is invalid, it will show an error.
    // Prevents submitting an incomplete or incorrect form.
        $("#name, #address, #dob").trigger("input");
        $("input[name='gender'], input[name='depart']").trigger("change");  // For radio buttons

        // If form is invalid, prevent submission and show alert
        if (!isValid) {
            e.preventDefault(); // Prevent form submission
            alert("Please fill in all the required fields correctly.");
        }
    });
    });


    //  JavaScript to remove messages after 3 seconds 
    setTimeout(function() {
        // Handle success message
        var successMessage = document.getElementById("successMessage");
        if (successMessage) {
            successMessage.style.transition = "opacity 0.5s";
            successMessage.style.opacity = "0";
            setTimeout(() => successMessage.remove(), 500); // Remove after fade out
        }
    }, 3000); //3-second delay before fading out

