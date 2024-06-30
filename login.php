<?php
// Initialize session (if not already started)
session_start();

// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

// Initialize variable to store error message
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store user input
    $email = $_POST['email'];
    $password = $_POST['password'];
    $acctype = $_POST['acctype'];

    // Prepare SQL statement to fetch user details based on email and account type
    $stmt = $mysqli->prepare("SELECT user_id, email, password, acctype FROM users WHERE email = ? AND acctype = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $acctype);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        // Bind result variables
        $stmt->bind_result($user_id, $db_email, $db_password, $db_acctype);
        $stmt->fetch();

        // Verify hashed password
        if (password_verify($password, $db_password)) {
            // Password correct, start session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $db_email;
            $_SESSION['acctype'] = $db_acctype;

            // Redirect user to their dashboard or home page
            header("Location: index.php");
            exit();
        } else {
            // Password incorrect
            $error = "Invalid password. Please try again.";
        }
    } else {
        // User not found
        $error = "Account not found. Please check your email and account type.";
    }

    // Close statement and database connection
    $stmt->close();
    $mysqli->close();

    // Redirect back to login page with error message
    header("Location: loginpage.php?error=" . urlencode($error) . "#login");
    exit();
}
?>