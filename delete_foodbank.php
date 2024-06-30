<?php
// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['food_bank_id'])) {
    $food_bank_id = $_GET['food_bank_id'];

    // Fetch food bank data
    $stmt = $mysqli->prepare("SELECT name FROM food_banks WHERE food_bank_id = ?");
    $stmt->bind_param('i', $food_bank_id);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
}

// Handle form submission to update food bank details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_bank_id = $_POST['food_bank_id'];
    $name = $_POST['name'];

    // Update food bank in database
    $stmt = $mysqli->prepare("UPDATE food_banks SET name = ? WHERE food_bank_id = ?");
    $stmt->bind_param('si', $name, $food_bank_id);

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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include head content as needed -->
</head>

<body>
    <!-- Edit Food Bank Form -->
    <h2>Edit Food Bank</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="food_bank_id" value="<?php echo $food_bank_id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>

</html>