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

// Fetch user data based on session user_id
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT fullname, email, acctype, phonenumber, icnumber FROM users WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($fullname, $email, $acctype, $phone, $icnumber);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Site Metas -->
    <title>User Profile - Feed Hope</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css" />

</head>

<body>
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

    <!-- User Profile Section -->
    <div class="customer-reviews-box">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto text-center" style="margin-top:100px">
                    <div class="col-lg-12">
                        <div class="heading-title text-center">
                            <h5 class="mt-4 mb-0">
                                <strong
                                    class="text-warning text-uppercase"><?php echo htmlspecialchars($fullname); ?></strong>
                            </h5>
                            <h6 class="text-dark m-0">
                                <?php
                                if ($acctype == 'Donor') {
                                    echo "Donor";
                                } elseif ($acctype == 'Volunteer') {
                                    echo "Volunteer";
                                } elseif ($acctype == 'Recipient') {
                                    echo "Recipient";
                                } elseif ($acctype == 'Admin') {
                                    echo "Admin";
                                }
                                ?>
                            </h6>
                            <p>
                                Email: <?php echo htmlspecialchars($email); ?><br />
                                Phone: <?php echo htmlspecialchars($phone); ?><br />
                                IC Number: <?php echo htmlspecialchars($icnumber); ?><br />
                                Account Type: <?php echo htmlspecialchars($acctype); ?><br />
                            </p>
                            <a href="edit_profile.php" class="btn btn-primary" style="margin-top:50px">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End User Profile Section -->
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