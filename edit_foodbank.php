<?php
// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['food_bank_id'])) {
    $food_bank_id = $_GET['food_bank_id'];

    // Fetch food bank data
    $stmt = $mysqli->prepare("SELECT name, managed_by, description FROM food_banks WHERE food_bank_id = ?");
    $stmt->bind_param('i', $food_bank_id);
    $stmt->execute();
    $stmt->bind_result($name, $managed_by, $description);
    $stmt->fetch();
    $stmt->close();
}

// Handle form submission to update food bank details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_bank_id = $_POST['food_bank_id'];
    $name = $_POST['name'];
    $managed_by = $_POST['managed_by'];
    $description = $_POST['description'];

    // Update food bank in database
    $stmt = $mysqli->prepare("UPDATE food_banks SET name = ?, managed_by = ?, description = ? WHERE food_bank_id = ?");
    $stmt->bind_param('sssi', $name, $managed_by, $description, $food_bank_id);

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food Bank</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <!-- Edit Food Bank Form -->
        <h2>Edit Food Bank</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="food_bank_id" value="<?php echo $food_bank_id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="managed_by">Managed by:</label>
                <input type="text" class="form-control" id="managed_by" name="managed_by"
                    value="<?php echo $managed_by; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="<?php echo $description; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>