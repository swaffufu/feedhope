<?php
// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

$user_id = null;
$fullname = "";
$email = "";
$password = "";
$acctype = "";
$phonenumber = "";
$icnumber = "";

// Function to sanitize input data
function sanitize_input($data)
{
    return htmlspecialchars(trim($data));
}

// Check if user_id is provided in GET request and fetch user data
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
    $user_id = sanitize_input($_GET['user_id']);

    // Fetch user data
    $stmt = $mysqli->prepare("SELECT fullname, email, password, acctype, phonenumber, icnumber FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($fullname, $email, $password, $acctype, $phonenumber, $icnumber);
    $stmt->fetch();
    $stmt->close();
}

// Handle form submission to update user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $user_id = sanitize_input($_POST['user_id']);
    $fullname = sanitize_input($_POST['fullname']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']); // Note: You should hash the password for security.
    $acctype = sanitize_input($_POST['acctype']);
    $phonenumber = sanitize_input($_POST['phonenumber']);
    $icnumber = sanitize_input($_POST['icnumber']);

    // Update user in database
    $stmt = $mysqli->prepare("UPDATE users SET fullname = ?, email = ?, password = ?, acctype = ?, phonenumber = ?, icnumber = ? WHERE user_id = ?");
    $stmt->bind_param('ssssssi', $fullname, $email, $password, $acctype, $phonenumber, $icnumber, $user_id);

    if ($stmt->execute()) {
        // Success message for popup
        $success_message = "User details updated successfully.";

        // Close MySQL connection
        $stmt->close();

        // JavaScript for success popup and redirection
        echo "<script>";
        echo "alert('" . addslashes($success_message) . "');";
        echo "window.location.href = 'admin.php';";
        echo "</script>";
        exit();
    } else {
        // Error handling for database operation
        echo "<p>Error: " . $mysqli->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <!-- Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional JavaScript for Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Include any additional styles or meta tags as needed -->
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Edit User</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        // Display success message if present in URL parameter
                        if (isset($_GET['success'])) {
                            echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_GET['success']) . '</div>';
                        }
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                            <div class="form-group">
                                <label for="fullname">Full Name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    value="<?php echo htmlspecialchars($fullname); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    value="<?php echo htmlspecialchars($password); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="acctype">Account Type:</label>
                                <input type="text" class="form-control" id="acctype" name="acctype"
                                    value="<?php echo htmlspecialchars($acctype); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="phonenumber">Phone Number:</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                                    value="<?php echo htmlspecialchars($phonenumber); ?>">
                            </div>

                            <div class="form-group">
                                <label for="icnumber">IC Number:</label>
                                <input type="text" class="form-control" id="icnumber" name="icnumber"
                                    value="<?php echo htmlspecialchars($icnumber); ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>