<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Site Metas -->
  <title>Home - Feed Hope</title>
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

  <!-- Start slides -->
  <div id="slides" class="cover-slides">
    <ul class="slides-container">
      <li class="text-center">
        <img src="images/slider-01.jpg" alt="" />
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20">
                <strong>Welcome To <br />
                  Feed Hope.</strong>
              </h1>
              <p class="m-b-40">
                See how your users experience your website in realtime or view
                <br />
                trends to see any changes in performance over time.
              </p>
              <p>
                <a class="btn btn-lg btn-circle btn-outline-new-white" href="receive.html">Get Food</a>
              </p>
            </div>
          </div>
        </div>
      </li>
      <li class="text-center">
        <img src="images/slider-02.jpg" alt="" />
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20">
                <strong>Let us help those<br />
                  who needs it more.</strong>
              </h1>
              <p class="m-b-40">
                See how your users experience your website in realtime or view
                <br />
                trends to see any changes in performance over time.
              </p>
              <p>
                <a class="btn btn-lg btn-circle btn-outline-new-white" href="donate.html">Donate</a>
              </p>
            </div>
          </div>
        </div>
      </li>
      <li class="text-center">
        <img src="images/slider-03.jpg" alt="" />
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="m-b-20">
                <strong>Volunteer now, <br />
                  help now.</strong>
              </h1>
              <p class="m-b-40">
                See how your users experience your website in realtime or view
                <br />
                trends to see any changes in performance over time.
              </p>
              <p>
                <a class="btn btn-lg btn-circle btn-outline-new-white" href="volunteer.html  ">Volunteer</a>
              </p>
            </div>
          </div>
        </div>
      </li>
    </ul>
    <div class="slides-navigation">
      <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
      <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
  </div>
  <!-- End slides -->

  <!-- Start About -->
  <div class="about-section-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-9 col-sm-12">
          <img src="images/index_story.jpg" alt="" class="img-fluid" />
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 text-center">
          <div class="inner-column">
            <h1>Combating food insecurity with <span>Feedhope</span></h1>
            <h4>A Little Story About Us</h4>
            <p>
              feedhope.com, a web application designed for Segamat, Malaysia,
              aims to revolutionize how food assistance is delivered. This
              innovative platform functions as a central hub, connecting all
              local food banks with donors, recipients, and volunteers.
            </p>
            <p>
              Ultimately, the Food Bank System bridges the gap between
              Segamat's food banks and the community, fostering a more
              efficient and centralized approach to simplify giving and
              receiving aid, helping more people in need
            </p>
            <a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Get Started</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End About -->

  <!-- Start QT -->
  <div class="qt-box qt-background">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-left">
          <p class="lead" style="color:#eee">
            “Good food is very often, even most often, simple food.”
          </p>
          <span class="lead">-Anthony Bourdain-</span>
        </div>
      </div>
    </div>
  </div>
  <!-- End QT -->
  <!--Compaigns
  <div id="campaign-placeholder"></div>

  <script>
    $(function () {
      $("#campaign-placeholder").load("campaign.html");
    });
  </script>
  end of Campaign-->

  <!--Start Gallery-->
  <div id="g-placeholder"></div>

  <script>
    $(function () {
      $("#g-placeholder").load("galleryy.html");
    });
  </script>
  <!--end of Galleryr-->

  <!-- Start Customer Reviews -->
  <div class="customer-reviews-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading-title text-center">
            <h2>Our Team Leaders</h2>
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 mr-auto ml-auto text-center">
          <div id="reviews" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner mt-4">
              <div class="carousel-item text-center active">
                <div class="img-box p-1 border rounded-circle m-auto">
                  <img class="d-block w-100 rounded-circle" src="images/adam.jpg" alt="" />
                </div>
                <h5 class="mt-4 mb-0">
                  <strong class="text-warning text-uppercase">Adam Fitri</strong>
                </h5>
                <h6 class="text-dark m-0">Web Developer</h6>
                <p class="m-0 pt-3">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                  eu sem tempor, varius quam at, luctus dui. Mauris magna
                  metus, dapibus nec turpis vel, semper malesuada ante. Idac
                  bibendum scelerisque non non purus. Suspendisse varius nibh
                  non aliquet.
                </p>
              </div>
              <div class="carousel-item text-center">
                <div class="img-box p-1 border rounded-circle m-auto">
                  <img class="d-block w-100 rounded-circle" src="images/dzarief.jpg" alt="" />
                </div>
                <h5 class="mt-4 mb-0">
                  <strong class="text-warning text-uppercase">Dzarief Iman</strong>
                </h5>
                <h6 class="text-dark m-0">Web Designer</h6>
                <p class="m-0 pt-3">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                  eu sem tempor, varius quam at, luctus dui. Mauris magna
                  metus, dapibus nec turpis vel, semper malesuada ante. Idac
                  bibendum scelerisque non non purus. Suspendisse varius nibh
                  non aliquet.
                </p>
              </div>
              <div class="carousel-item text-center">
                <div class="img-box p-1 border rounded-circle m-auto">
                  <img class="d-block w-100 rounded-circle" src="images/syafiqah.jpg" alt="" />
                </div>
                <h5 class="mt-4 mb-0">
                  <strong class="text-warning text-uppercase">Syafiqah</strong>
                </h5>
                <h6 class="text-dark m-0">Seo Analyst</h6>
                <p class="m-0 pt-3">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                  eu sem tempor, varius quam at, luctus dui. Mauris magna
                  metus, dapibus nec turpis vel, semper malesuada ante. Idac
                  bibendum scelerisque non non purus. Suspendisse varius nibh
                  non aliquet.
                </p>
              </div>
            </div>
            <a class="carousel-control-prev" href="#reviews" role="button" data-slide="prev">
              <i class="fa fa-angle-left" aria-hidden="true"></i>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#reviews" role="button" data-slide="next">
              <i class="fa fa-angle-right" aria-hidden="true"></i>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Customer Reviews -->

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