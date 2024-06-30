<?php
// Initialize session (if not already started)
session_start();

// Include database connection file (adjust the path as per your project)
include_once "dbfoodbank.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit();
}

// Initialize variables for user data
$fullname = $email = $phonenumber = $icnumber = '';
$error = $success = '';
$foodbank_name = ''; // Variable to store food bank name for volunteers

// Fetch user data based on session user_id
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT fullname, email, phonenumber, icnumber, acctype FROM users WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($fullname, $email, $phonenumber, $icnumber, $acctype);
$stmt->fetch();
$stmt->close();

// Fetch food bank information if the user is a volunteer
if ($acctype == 'Volunteer') {
    $stmt_foodbank = $mysqli->prepare("SELECT fb.name FROM users u JOIN volunteers v ON u.user_id = v.user_id JOIN food_banks fb ON v.food_bank_id = fb.food_bank_id WHERE u.user_id = ?");
    $stmt_foodbank->bind_param('i', $user_id);
    $stmt_foodbank->execute();
    $stmt_foodbank->bind_result($foodbank_name);
    $stmt_foodbank->fetch();
    $stmt_foodbank->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store user input
    $new_fullname = $_POST['fullname'];
    $new_email = $_POST['email'];
    $new_phonenumber = $_POST['phonenumber'];
    $new_icnumber = $_POST['icnumber'];

    // Validate inputs
    if (empty($new_fullname) || empty($new_email) || empty($new_phonenumber) || empty($new_icnumber)) {
        $error = "All fields are required.";
    } else {
        // Update user data in database
        $update_stmt = $mysqli->prepare("UPDATE users SET fullname = ?, email = ?, phonenumber = ?, icnumber = ? WHERE user_id = ?");
        $update_stmt->bind_param('ssssi', $new_fullname, $new_email, $new_phonenumber, $new_icnumber, $user_id);

        if ($update_stmt->execute()) {
            // Update successful, set success message and redirect
            $success = "Profile updated successfully.";
            // Fetch updated data for display
            $fullname = $new_fullname;
            $email = $new_email;
            $phonenumber = $new_phonenumber;
            $icnumber = $new_icnumber;
        } else {
            $error = "Update failed. Please try again later.";
        }

        $update_stmt->close();
    }

    // If there's an error, display it
    if (!empty($error)) {
        echo '<script>alert("' . $error . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Edit Profile - Feed Hope</title>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/custom.css" />
</head>

<body>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->

    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>

    <!--Navigation bar-->
    <div id="nav-placeholder"></div>
    <script>
        $(function () {
            $("#nav-placeholder").load("nav.php");
        });
    </script>
    <!--end of Navigation bar-->

    <div class="container">
        <div class="row">
            <div class="col-md-6 mr-auto ml-auto">
                <h2 class="text-center" style="margin-top: 200px;">Edit Profile</h2>
                <form method="post" action="edit_profile.php" style="margin-bottom: 200px;">
                    <div class="form-group" style="margin-top: 100px;">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="<?php echo htmlspecialchars($fullname); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Phone Number</label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                            value="<?php echo htmlspecialchars($phonenumber); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="icnumber">IC Number</label>
                        <input type="text" class="form-control" id="icnumber" name="icnumber"
                            value="<?php echo htmlspecialchars($icnumber); ?>" required>
                    </div>
                    <?php if ($acctype == 'Volunteer'): ?>
                        <div class="form-group">
                            <label for="foodbank">Current Food Bank</label>
                            <input type="text" class="form-control" id="foodbank" name="foodbank"
                                value="<?php echo htmlspecialchars($foodbank_name); ?>" readonly>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!--End bar-->
    <div id="end-placeholder"></div>
    <script>
        $(function () {
            $("#end-placeholder").load("end.html");
        });
    </script>
    <!--end of End bar-->

</body>

</html>