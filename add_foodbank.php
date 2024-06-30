<?php
// Initialize session (if not already started)
session_start();

// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

// Check if user is logged in and is admin (you can adjust this based on your user roles)
if (!isset($_SESSION['user_id']) || $_SESSION['acctype'] !== 'Admin') {
    header("Location: loginpage.php");
    exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = $mysqli->real_escape_string(trim($_POST['name']));
    $managed_by = $mysqli->real_escape_string(trim($_POST['managed_by']));
    $established = $mysqli->real_escape_string(trim($_POST['established']));
    $description = $mysqli->real_escape_string(trim($_POST['description']));

    // Check if any field is empty
    if (empty($name) || empty($managed_by) || empty($established) || empty($description)) {
        echo "All fields are required.";
    } else {
        // Insert the new food bank into the database
        $query = "INSERT INTO food_banks (name, managed_by, established, description) VALUES ('$name', '$managed_by', '$established', '$description')";

        if ($mysqli->query($query)) {
            // Redirect to admin dashboard after successful addition
            header("Location: admin.php");
            exit();
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food Bank</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Add Food Bank</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Food Bank Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="managed_by">Managed By:</label>
                <input type="text" class="form-control" id="managed_by" name="managed_by" required>
            </div>
            <div class="form-group">
                <label for="established">Date Established:</label>
                <input type="date" class="form-control" id="established" name="established" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Food Bank</button>
        </form>
    </div>
</body>

</html>