<?php
session_start();

require_once 'dbfoodbank.php'; // Ensure this file contains your database connection code

$errorMSG = "";

// Function to sanitize input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted from Community section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['community_submit'])) {
    // Validate and sanitize inputs
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $ic = test_input($_POST["ic"]);
    $address = test_input($_POST["address"]);
    $details = test_input($_POST["details"]);
    $dependents = test_input($_POST["dependents"]);

    // Validate required fields
    if (empty($name)) {
        $errorMSG .= "Name is required ";
    }
    if (empty($email)) {
        $errorMSG .= "Email is required ";
    }
    if (empty($phone)) {
        $errorMSG .= "Phone is required ";
    }
    if (empty($ic)) {
        $errorMSG .= "IC is required ";
    }
    if (empty($address)) {
        $errorMSG .= "Address is required ";
    }
    if (empty($details)) {
        $errorMSG .= "Details are required ";
    }
    if (empty($dependents)) {
        $errorMSG .= "Dependents are required ";
    }

    // If no validation errors, proceed with database insertion
    if ($errorMSG == "") {
        // Prepare SQL statement
        $stmt = $mysqli->prepare("INSERT INTO requests (food_bank_id, request_type, name, email, phone, ic, address, details, dependents) VALUES (?, 'community', ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssi", $food_bank_id, $name, $email, $phone, $ic, $address, $details, $dependents);

        // Set food_bank_id - replace with actual value
        $food_bank_id = 1; // Example value, replace with the actual food_bank_id from your application

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Your community request has been submitted successfully."); window.location.href = "profile.php";</script>';
        } else {
            echo '<script>alert("Something went wrong. Please try again."); window.location.href = "error_page.html";</script>';
        }

        // Close statement
        $stmt->close();
    } else {
        echo '<script>alert("' . $errorMSG . '"); window.location.href = "error_page.html";</script>';
    }

    // Close connection
    $mysqli->close();
    exit();
}

// Check if form is submitted from Student section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_submit'])) {
    // Validate and sanitize inputs
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $matrix = test_input($_POST["matrix"]);
    $course = test_input($_POST["course"]);
    $semester = test_input($_POST["semester"]);
    $details = test_input($_POST["details"]);

    // Validate required fields
    if (empty($name)) {
        $errorMSG .= "Name is required ";
    }
    if (empty($email)) {
        $errorMSG .= "Email is required ";
    }
    if (empty($phone)) {
        $errorMSG .= "Phone is required ";
    }
    if (empty($matrix)) {
        $errorMSG .= "Matrix number is required ";
    }
    if (empty($course)) {
        $errorMSG .= "Course is required ";
    }
    if (empty($semester)) {
        $errorMSG .= "Semester is required ";
    }
    if (empty($details)) {
        $errorMSG .= "Details are required ";
    }

    // If no validation errors, proceed with database insertion
    if ($errorMSG == "") {
        // Prepare SQL statement
        $stmt = $mysqli->prepare("INSERT INTO requests (food_bank_id, request_type, name, email, phone, matrix, course, semester, details) VALUES (?, 'student', ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssis", $food_bank_id, $name, $email, $phone, $matrix, $course, $semester, $details);

        // Set food_bank_id - replace with actual value
        $food_bank_id = 1; // Example value, replace with the actual food_bank_id from your application

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Your student request has been submitted successfully."); window.location.href = "success_page.html";</script>';
        } else {
            echo '<script>alert("Something went wrong. Please try again."); window.location.href = "error_page.html";</script>';
        }

        // Close statement
        $stmt->close();
    } else {
        echo '<script>alert("' . $errorMSG . '"); window.location.href = "error_page.html";</script>';
    }

    // Close connection
    $mysqli->close();
    exit();
}

// Check if form is submitted from Volunteer section
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['volunteer_submit'])) {
    // Validate and sanitize inputs
    $foodbank_id = test_input($_POST["foodbank"]); // Assuming you have a hidden field or select option for foodbank

    // Validate required fields
    if (empty($foodbank_id)) {
        $errorMSG .= "Foodbank selection is required ";
    }

    // If no validation errors, proceed with database insertion
    if ($errorMSG == "") {
        $volunteer_status = 'Pending'; // Default status for new volunteers
        // Prepare SQL statement
        $stmt = $mysqli->prepare("INSERT INTO volunteers (user_id, food_bank_id, volunteer_status) VALUES (?, ?, ?)");
        $stmt->bind_param('iis', $_SESSION['user_id'], $foodbank_id, $volunteer_status);
        // Execute the statement
        if ($stmt->execute()) {
            // Success
            echo '<script>alert("Application submitted successfully!"); window.location.href = "profile.php";</script>';
            exit();
        } else {
            // Error
            echo '<script>alert("Something went wrong. Please try again."); window.location.href = "volunteer.php";</script>';
            exit();
        }

        // Close statement
        $stmt->close();
    } else {
        echo '<script>alert("' . $errorMSG . '"); window.location.href = "volunteer.php";</script>';
        exit();
    }
}

// If script execution reaches here, there was an error
echo "Error: Form submission failed.";
?>