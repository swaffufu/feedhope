<?php
// Include database connection or configuration file
require_once "dbfoodbank.php";

// Function to safely redirect and display a message
function redirectWithMessage($url, $message)
{
    echo '<script>alert("' . $message . '"); window.location.href = "' . $url . '";</script>';
    exit();
}

// Check if form is submitted for money donation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["money_donation"])) {
    // Sanitize and validate inputs
    $amount = $_POST["amount"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];
    $bank_name = $_POST["bank_name"];
    $account_name = $_POST["account_name"];
    $account_number = $_POST["account_number"];
    $reference = $_POST["reference"];

    // Insert money donation data into database
    $sql = "INSERT INTO money_donations (amount, donor_name, donor_email, donor_phone, message, bank_name, account_name, account_number, reference) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("dssssssss", $amount, $name, $email, $phone, $message, $bank_name, $account_name, $account_number, $reference);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to a success page or display success message
            redirectWithMessage("success.php", "Thank you for your donation!");
        } else {
            // Redirect to an error page or display error message
            redirectWithMessage("error.php", "Oops! Something went wrong. Please try again later.");
        }
    }
}

// Check if form is submitted for food donation
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["food_donation"])) {
    // Sanitize and validate inputs
    $food_category = $_POST["food_category"];
    $food_name = $_POST["food_name"];
    $quantity = $_POST["quantity"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Insert food donation data into database
    $sql = "INSERT INTO food_donations (food_category, food_name, quantity, donor_name, donor_email, donor_phone, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssssss", $food_category, $food_name, $quantity, $name, $email, $phone, $message);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to a success page or display success message
            redirectWithMessage("success.php", "Thank you for your donation!");
        } else {
            // Redirect to an error page or display error message
            redirectWithMessage("error.php", "Oops! Something went wrong. Please try again later.");
        }
    }
}

// Close statement if it exists
if (isset($stmt)) {
    $stmt->close();
}

// Close connection
$mysqli->close();
?>