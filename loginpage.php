<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Feed Hope</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .login-register-section {
            display: flex;
            align-items: center;
        }

        .login-form-container {
            width: 50%;
            /* Take half of the container width */
            margin: 0 auto;
            /* Center align horizontally */
            margin-bottom: 150px;
            margin-top: 100px;
        }

        .login-form-container .welcome-text-item {
            margin-bottom: 10px;
            /* Adjust margin as needed */
        }

        .login-form-container img {
            width: 100%;
            /* Make the image responsive */
            max-width: 300px;
            /* Limit maximum width of the image */
            display: block;
            /* Prevent inline block issues */
            margin-bottom: 10px;
            /* Add space below the image */
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .tab-content {
            min-height: 60px;
            /* Adjust this value based on the larger form */
        }
    </style>
</head>

<body>
    <!-- Return Back to Home Page Button -->
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary" style="background: #f1606d;"
            onclick="return confirm('Are you sure you want to go back to the homepage?');">Return Back to Home Page</a>
    </div>
    <!-- Login/Register Section -->
    <div class="container mt-5">
        <div class="row login-register-section">
            <!-- Image Section -->
            <div class="col-md-6">
                <img src="images/loginlogo.png" alt="Image Description" />
            </div>
            <!-- Login/Register Form -->
            <div class="col-md-6 login-form-container">
                <div class="modal-content">
                    <div class="signin-form-part">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#login">Log In</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#register">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Login -->
                            <div class="tab-pane container active" id="login">
                                <div class="welcome-text-item mt-3">
                                    <h3>Welcome Back, Sign in to Continue</h3>
                                    <span>Don't Have an Account? <a href="#register" class="register-tab"
                                            data-toggle="tab">Sign Up!</a></span>
                                </div>
                                <form method="post" id="login-form" action="./login.php">
                                    <div class="form-group">
                                        <label for="login-category">Account Type</label>
                                        <select class="form-control" id="login-category" name="acctype">
                                            <option value="Recipient">Recipient</option>
                                            <option value="Donor">Donor</option>
                                            <option value="Volunteer">Volunteer</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="login-email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="login-email"
                                            placeholder="Email Address" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="login-password">Password</label>
                                        <input type="password" class="form-control" name="password" id="login-password"
                                            placeholder="Password" required minlength="6" />
                                    </div>
                                    <?php if (isset($_GET['error'])): ?>
                                        <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
                                    <?php endif; ?>
                                    <button class="btn btn-primary btn-block" type="submit" form="login-form"
                                        name="loginbtn" style="margin-bottom:20px">Log In</button>
                                </form>
                            </div>
                            <!-- Register -->
                            <div class="tab-pane container fade" id="register">
                                <div class="welcome-text-item mt-3">
                                    <h3>Create your Account!</h3>
                                    <span>Already Have an Account? <a href="#login" class="login-tab"
                                            data-toggle="tab">Log In!</a></span>
                                </div>
                                <form method="post" id="register-account-form" action="./register.php">
                                    <div class="form-group">
                                        <label for="register-category">Account Type</label>
                                        <select class="form-control" id="register-category" name="acctype">
                                            <option value="Recipient">Recipient</option>
                                            <option value="Donor">Donor</option>
                                            <option value="Volunteer">Volunteer</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname"
                                            placeholder="Full Name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="register-email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="register-email"
                                            placeholder="Email Address" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="icnumber">IC Number:</label>
                                        <input type="text" class="form-control" id="icnumber" name="icnumber" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="register-password">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            id="register-password" placeholder="Password" required minlength="6" />
                                    </div>
                                    <div class="form-group">
                                        <label for="register-passwordrepeat">Repeat Password</label>
                                        <input type="password" class="form-control" name="passwordrepeat"
                                            id="register-passwordrepeat" placeholder="Repeat Password" required
                                            minlength="6" />
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit" id="regisbtn"
                                        name="registerbtn" style="margin-bottom:20px">Create an Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--End bar-->
    <div id="end-placeholder"></div>

    <script>
        $(function () {
            $("#end-placeholder").load("end.html");

            // Handle tab switching
            $('.register-tab').on('click', function () {
                $('.nav-tabs a[href="#register"]').tab('show');
            });

            $('.login-tab').on('click', function () {
                $('.nav-tabs a[href="#login"]').tab('show');
            });
        });
    </script>
    <!--end of End bar-->

</body>

</html>