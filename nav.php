<?php
session_start();

?>

<header class="top-navbar">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo1.png" alt="" height="13%" width="13%" />
        <img src="images/logo.png" alt="" height="20%" width="60%" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food"
        aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbars-rs-food">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/foodbanks.html">Foodbanks</a>
          </li>
          <?php if (isset($_SESSION['user_id']) && isset($_SESSION['acctype']) && $_SESSION['acctype'] == 'Admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="admin.php">Manage</a>
            </li>
          <?php endif; ?>
          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"
                onclick="return confirm('Are you sure you want to logout?');">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="/loginpage.php">Register Now</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="loginpage.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>