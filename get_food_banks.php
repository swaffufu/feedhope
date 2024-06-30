<?php
session_start();

// Include database connections
include 'dbfoodbank.php'; // Connection to foodbanks database

// Check if user is logged in and fetch user details from dbfoodbanks
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query to fetch user details including role from users database
    $queryUser = "SELECT * FROM users WHERE user_id = $user_id";
    $resultUser = mysqli_query($mysqli, $queryUser);

    if ($resultUser && mysqli_num_rows($resultUser) > 0) {
        $user = mysqli_fetch_assoc($resultUser);
        $userRole = $user['acctype']; // Assuming 'role' is the field containing the user's role
    } else {
        die("User not found.");
    }
} else {
    $userRole = '';
}

// Query to fetch food banks from foodbanks database
$queryFoodBanks = "SELECT * FROM food_banks";
$resultFoodBanks = mysqli_query($mysqli, $queryFoodBanks);

// Check if query executed successfully
if ($resultFoodBanks) {
    while ($row = mysqli_fetch_assoc($resultFoodBanks)) {
        // Output HTML for each food bank entry
        echo '<div class="col-lg-4 col-md-6 col-12">';
        echo '<div class="blog-box-inner">';
        echo '<div class="blog-img-box">';
        echo '<img class="img-fluid" src="images/blog-img-09.jpg" alt="" />';
        echo '</div>';
        echo '<div class="blog-detail">';
        echo '<h4>' . $row['name'] . '</h4>';
        echo '<ul>';
        echo '<li><span>Managed by: ' . $row['managed_by'] . '</span></li>';
        echo '<li>|</li>';
        echo '<li><span>Established: ' . $row['established'] . '</span></li>';
        echo '</ul>';
        echo '<p>' . $row['description'] . '</p>';

        // Output different buttons based on user role
        switch ($userRole) {
            case 'Donor':
                echo '<a class="btn btn-lg btn-circle btn-outline-new-white" href="/foodheredotcom/feedhope/donate.html">Donate</a>';
                break;
            case 'Volunteer':
                echo '<a class="btn btn-lg btn-circle btn-outline-new-white" href="/foodheredotcom/feedhope/volunteer.php">Volunteer</a>';
                break;
            case 'Community':
            case 'Student':
                echo '<a class="btn btn-lg btn-circle btn-outline-new-white" href="/foodheredotcom/feedhope/receive.html">Get Food</a>';
                break;
            case 'Admin':
                echo '<a class="btn btn-lg btn-circle btn-outline-new-white" href="http://localhost/foodheredotcom/feedhope/admin.php#foodbanks">Manage</a>';
                break;
            case '':
                echo '<a class="btn btn-lg btn-circle btn-outline-new-white" href="/foodheredotcom/feedhope/loginpage.php">Login for more</a>';
                break;
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No food banks found.';
}

// Close database connections
mysqli_close($mysqli);
?>