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
$stmt->bind_result($fullname, $email, $acctype, $phonenumber, $icnumber);
$stmt->fetch();
$stmt->close();

// Fetch food bank details from the database
$foodbanks = [];
$query = "SELECT food_bank_id, name FROM food_banks"; // Adjust table and column names as necessary
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
  $foodbanks[] = $row;
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
  <title>Volunteer</title>
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
  <!--Navigation bar-->
  <div id="nav-placeholder"></div>

  <script>
    $(function () {
      $("#nav-placeholder").load("nav.php");
    });
  </script>
  <!--end of Navigation bar-->

  <!-- Start All Pages -->
  <div class="all-page-title page-breadcrumb">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-12">
          <h1>Volunteer</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Pages -->

  <!-- Start Menu -->
  <div class="menu-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading-title text-center">
            <h2>Want to help by volunteering?</h2>
            <p>
              Confirm your details and choose the food bank you want to volunteer for.
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="special-menu text-center">
            <div class="button-group filter-button-group">
              <button id="volunteerbtn">Yes, I want to Volunteer</button>
            </div>
          </div>
        </div>
      </div>

      <!-- VOLUNTEER -->
      <div class="row special-list">
        <div class="reservation-box special-grid" id="volunteer" style="width: 100%">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="contact-block">
                  <form action="form-process.php" method="POST">
                    <div class="row">
                      <div class="col-md-12">
                        <h3>
                          Confirm your details to volunteer:
                        </h3>
                        <div class="col-md-12">
                          <h3>Volunteer Details</h3>
                          <div id="mehmeh" class="form-group">
                            <select id="foodbank" name="foodbank" class="form-control" required>
                              <option value="">Select Foodbank</option>
                              <?php foreach ($foodbanks as $foodbank): ?>
                                <option value="<?php echo $foodbank['food_bank_id']; ?>"><?php echo $foodbank['name']; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="help-block with-errors"></div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <h3>Contact Details</h3>
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Your Name"
                                value="<?php echo $fullname; ?>" disabled />
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="email" placeholder="Your Email" id="email" class="form-control" name="email"
                                value="<?php echo $email; ?>" disabled />
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="text" placeholder="Your Phone Number" id="phone" class="form-control"
                                name="phone" value="<?php echo $phonenumber; ?>" disabled />
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="text" placeholder="Your IC Number" id="ic" class="form-control" name="ic"
                                value="<?php echo $icnumber; ?>" disabled />
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="submit-button text-center">
                            <button class="btn btn-common" id="submit" type="submit" name="volunteer_submit">
                              Apply
                            </button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Menu -->

  <!--End bar-->
  <div id="end-placeholder"></div>

  <script>
    $(function () {
      $("#end-placeholder").load("end.html");
    });
  </script>
  <!--end of End bar-->
  <script>
    $(document).ready(function () {
      $("#volunteerbtn").click(function () {
        $("#volunteer").show();
      });
      $("#volunteer").hide();
    });
  </script>
</body>

</html>
