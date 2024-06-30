<?php
// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['food_bank_id'])) {
    $food_bank_id = $_GET['food_bank_id'];

    // Delete food bank from database
    $stmt = $mysqli->prepare("DELETE FROM food_banks WHERE food_bank_id = ?");
    $stmt->bind_param('i', $food_bank_id);

    if ($stmt->execute()) {
        // Success message or redirect
        header("Location: admin.php#foodbanks");
        exit();
    } else {
        // Error handling
        echo "Error: " . $mysqli->error;
    }
}
?>