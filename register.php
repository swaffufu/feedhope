<?php
// Initialize session (if not already started)
session_start();

// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store user input
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordrepeat = $_POST['passwordrepeat'];
    $acctype = $_POST['acctype'];
    $phone = $_POST['phone'];
    $icnumber = $_POST['icnumber'];

    // Validate inputs
    $error = "";
    if (empty($fullname) || empty($email) || empty($password) || empty($passwordrepeat) || empty($acctype) || empty($phone) || empty($icnumber)) {
        $error = "All fields are required.";
    } elseif ($password != $passwordrepeat) {
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists in the database
        $stmt = $mysqli->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already exists. Please choose a different email.";
        } else {
            // Insert user into database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $insert_stmt = $mysqli->prepare("INSERT INTO users (fullname, email, password, acctype, phonenumber, icnumber) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param('ssssss', $fullname, $email, $hashed_password, $acctype, $phone, $icnumber);

            if ($insert_stmt->execute()) {
                // Registration successful, set user ID in session
                $_SESSION['user_id'] = $mysqli->insert_id;

                // Redirect to profile page or dashboard
                header("Location: profile.php");
                exit();
            } else {
                $error = "Registration failed. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close database connection
    $mysqli->close();

    // If there's an error, display it and redirect back to registration section of loginpage.php
    if (!empty($error)) {
        echo '<script>alert("' . $error . '"); window.location.href = "loginpage.php#register";</script>';
        exit();
    }
}
?>