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
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle user search
if (isset($_GET['user_search'])) {
    $search_term = $_GET['user_search'];
    $query_users = "SELECT user_id, fullname, email, acctype, phonenumber, icnumber FROM users WHERE fullname LIKE '%$search_term%' OR email LIKE '%$search_term%'";
} else {
    $query_users = "SELECT user_id, fullname, email, acctype, phonenumber, icnumber FROM users";
}
// Handle food bank search
if (isset($_GET['foodbank_search'])) {
    $search_term = $_GET['foodbank_search'];
    $query_foodbanks = "SELECT food_bank_id, name, managed_by, description FROM food_banks WHERE name LIKE '%$search_term%' OR managed_by LIKE '%$search_term%'";
} else {
    $query_foodbanks = "SELECT food_bank_id, name, managed_by, description FROM food_banks";
}

// Delete user
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    $delete_user_query = "DELETE FROM users WHERE user_id = $user_id";
    if ($mysqli->query($delete_user_query)) {
        // Redirect to refresh the page after deletion
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting user: " . $mysqli->error;
    }
}

// Delete food bank
if (isset($_GET['delete_foodbank'])) {
    $food_bank_id = $_GET['delete_foodbank'];
    $delete_foodbank_query = "DELETE FROM food_banks WHERE food_bank_id = $food_bank_id";
    if ($mysqli->query($delete_foodbank_query)) {
        // Redirect to refresh the page after deletion
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting food bank: " . $mysqli->error;
    }
}

// Fetch donations
$query_donations = "SELECT users.fullname as donor_name, donations.amount, donations.donation_date 
                    FROM donations 
                    JOIN users ON donations.user_id = users.user_id";
$result_donations = $mysqli->query($query_donations);

// Fetch food donations
$query_food_donations = "SELECT users.fullname as donor_name, donations.food_name, donations.quantity, donations.donation_date 
                         FROM donations 
                         JOIN users ON donations.user_id = users.user_id";
$result_food_donations = $mysqli->query($query_food_donations);

// Calculate total money donations
$query_total_donations = "SELECT SUM(amount) as total_amount FROM donations";
$result_total_donations = $mysqli->query($query_total_donations);
$total_donations = $result_total_donations->fetch_assoc()['total_amount'];

// Fetch food banks for dropdown
$food_banks = $mysqli->query("SELECT food_bank_id, name FROM food_banks");

// Handle specific food bank selection
$selected_food_bank = null;
if (isset($_GET['food_bank_id']) && $_GET['food_bank_id'] !== '') {
    $selected_food_bank = $_GET['food_bank_id'];
    $query_specific_donations = "SELECT users.fullname as donor_name, donations.amount, donations.donation_date 
                                 FROM donations 
                                 JOIN users ON donations.user_id = users.user_id 
                                 WHERE donations.food_bank_id = $selected_food_bank";
    $result_specific_donations = $mysqli->query($query_specific_donations);

    $query_specific_food_donations = "SELECT users.fullname as donor_name, donations.food_name, donations.quantity, donations.donation_date 
                                      FROM donations 
                                      JOIN users ON donations.user_id = users.user_id 
                                      WHERE donations.food_bank_id = $selected_food_bank";
    $result_specific_food_donations = $mysqli->query($query_specific_food_donations);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Site Metas -->
    <title>Admin Dashboard</title>
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

    <!-- Pickadate CSS -->
    <link rel="stylesheet" href="css/classic.css" />
    <link rel="stylesheet" href="css/classic.date.css" />
    <link rel="stylesheet" href="css/classic.time.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Navigation bar -->
    <div id="nav-placeholder"></div>

    <script>
        $(function () {
            $("#nav-placeholder").load("nav.php");
        });
    </script>
    <!-- End Navigation bar -->

    <!-- Admin Dashboard -->
    <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Admin Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Navigation -->
    <div class="container" id="admin-nav" style="margin-top:100px">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#users">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#foodbanks">Manage Food Banks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#donations">View Donations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#addfoodbank">Add Food Bank</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="margin-top:50px">
            <!-- Manage Users Section -->
            <div id="users" class="container tab-pane active">
                <h2>Manage Users</h2>
                <form class="form-inline mb-3" method="get"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group mr-2">
                        <input type="text" class="form-control" name="user_search" placeholder="Search Users">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Account Type</th>
                            <th>Phone Number</th>
                            <th>IC Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_users = $mysqli->query($query_users);
                        if ($result_users->num_rows > 0) {
                            while ($row = $result_users->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['fullname'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['acctype'] . "</td>";
                                echo "<td>" . $row['phonenumber'] . "</td>";
                                echo "<td>" . $row['icnumber'] . "</td>";
                                echo "<td><a href='edit_user.php?user_id=" . $row['user_id'] . "'>Edit</a> | <a href='admin.php?delete_user=" . $row['user_id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <!-- Manage Food Banks Section -->
            <div id="foodbanks" class="container tab-pane fade">
                <h2>Manage Food Banks</h2>
                <form class="form-inline mb-3" method="get"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group mr-2">
                        <input type="text" class="form-control" name="foodbank_search" placeholder="Search Food Banks">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Food Bank ID</th>
                            <th>Name</th>
                            <th>Managed By</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result_foodbanks = $mysqli->query($query_foodbanks);
                        if ($result_foodbanks->num_rows > 0) {
                            while ($row = $result_foodbanks->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['food_bank_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['managed_by'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td><a href='edit_foodbank.php?food_bank_id=" . $row['food_bank_id'] . "'>Edit</a> | <a href='admin.php?delete_foodbank=" . $row['food_bank_id'] . "' onclick='return confirm(\"Are you sure you want to delete this food bank?\")'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No food banks found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- View Donations Section -->
            <div id="donations" class="container tab-pane fade">
                <h2>View Donations</h2>
                <p>Total money donations received: RM<?php echo $total_donations; ?></p>

                <!-- Select Food Bank -->
                <form class="form-inline mb-3" method="get"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group mr-2">
                        <select name="food_bank_id" class="form-control">
                            <option value="">Select Food Bank</option>
                            <?php
                            if ($food_banks->num_rows > 0) {
                                while ($row = $food_banks->fetch_assoc()) {
                                    $selected = $selected_food_bank == $row['food_bank_id'] ? 'selected' : '';
                                    echo "<option value='" . $row['food_bank_id'] . "' $selected>" . $row['name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <!-- Money Donations Table -->
                <h3>Money Donations</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Amount</th>
                            <th>donations Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($selected_food_bank !== null) {
                            $result_donations = $result_specific_donations;
                        }

                        if ($result_donations->num_rows > 0) {
                            while ($row = $result_donations->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['donor_name'] . "</td>";
                                echo "<td>RM" . $row['amount'] . "</td>";
                                echo "<td>" . $row['donation_date'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No money donations found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Food Donations Table -->
                <h3>Food Donations</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Food Name</th>
                            <th>Quantity</th>
                            <th>donations Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($selected_food_bank !== null) {
                            $result_food_donations = $result_specific_food_donations;
                        }

                        if ($result_food_donations->num_rows > 0) {
                            while ($row = $result_food_donations->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['donor_name'] . "</td>";
                                echo "<td>" . $row['food_name'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['donation_date'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No food donations found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Add Food Bank Section -->
            <div id="addfoodbank" class="container tab-pane fade">
                <h2>Add Food Bank</h2>
                <form method="post" action="add_food_bank.php">
                    <div class="form-group">
                        <label for="food_bank_name">Food Bank Name:</label>
                        <input type="text" class="form-control" id="food_bank_name" name="food_bank_name" required>
                    </div>
                    <div class="form-group">
                        <label for="managed_by">Managed By:</label>
                        <input type="text" class="form-control" id="managed_by" name="managed_by" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Food Bank</button>
                </form>
            </div>
        </div>
    </div>

    <!--End bar-->
    <div id="end-placeholder" style="margin-top:200px"></div>

    <script>
        $(function () {
            $("#end-placeholder").load("end.html");
        });
    </script>
    <!--end of End bar-->

    <!-- jQuery -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
</body>

</html>