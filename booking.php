<?php
  session_start();
  $location = $_POST["location"];
  echo $location;
  $sdate = $_POST["sdate"];
  echo $sdate;
  $edate = $_POST["edate"];
  echo $edate;
  $ctype = $_POST["ctype"];
  echo $ctype;
  $_SESSION['sess_finallocation'] = $location;
  $_SESSION['sess_sdate'] = $sdate;
  $_SESSION['sess_edate'] = $edate;
  $_SESSION['sess_cartype'] = $ctype;
  $hostname="localhost";
  $database="car rental";
  $username="root";
  $password="root";
  $conn = mysqli_connect($hostname, $username, $password,$database);
  if (!$conn)
  {
    die("Connection failed: " . mysqli_connect_error());
  }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Rent-a-Car</title>

    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="style.css" rel="stylesheet">
    <!--=== Responsive CSS ===-->
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>

<body class="loader-active">
    <!--== Preloader Area Start ==-->
    
    <!--== Preloader Area End ==-->

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">
        <!--== Header Top Start ==-->
        <div id="header-top" class="d-none d-xl-block">
            <div class="container">
                <div class="row">
                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-4 text-left">
                        <i class="fa fa-map-marker"></i> University of Texas at Dallas
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-4 text-center">
                        <i class="fa fa-mobile"></i> +1 800 345 678
                    </div>
                    

                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-4 text-right">
                        <i class="fa fa-clock-o"></i> Mon-Fri 09.00 - 17.00
                    </div>

                    <!--== Social Icons End ==-->
                </div>
            </div>
        </div>
        <!--== Header Top End ==-->

        <!--== Header Bottom Start ==-->
        <div id="header-bottom">
            <div class="container">
                <div class="row">
                    <!--== Logo Start ==-->
                    <div class="col-lg-4">
                        <a href="index.php" class="logo">
                            <img src="assets/img/logo.png" alt="JSOFT">
                        </a>
                    </div>
                    <!--== Logo End ==-->

                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>
                                <li ><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li class="active"><a href="cars.php">Cars</a></li>
                                <?php
                                  if(isset($_SESSION['sess_name']))
                                  {
                                    echo "<li><a href=myaccount.php>My Account</a></li>";
                                    echo "<li><a href=logout.php>Sign Out</a></li>";
                                  }
                                  else
                                  {
                                    echo "<li><a href=login.php>Login</a></li>";
                                  }
                                ?>
                            </ul>
                        </nav>
                    </div>
                    <!--== Main Menu End ==-->
                </div>
            </div>
        </div>
        <!--== Header Bottom End ==-->
    </header>
    <!--== Header Area End ==-->

    <!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Cars Available</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <section id="slider-area">
        <!--== slide Item One ==-->
        <div class="single-slide-item overlay">
            <div class="section-title  text-center">
                <h2>Booking List</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="book-a-car">



<!--     <section id="car-list-area" class="section-padding">
        <div class="container">
            <div class="row">
              <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="car-list-content"> -->
                        <?php 
                          
                          $sql = "select car.* from car where car.type_id=$ctype and car.status='A' and car.car_id in (select DISTINCT car_loc.car_id from car_loc where car_loc.loc_id = $location and car_loc.car_id not in (select car_id from booking where not (('$sdate' > return_date and '$edate' > return_date) or ('$sdate' < pick_up and '$edate' < pick_up))))";
                          // echo $sql;

                          $result = $conn->query($sql);
                          if ($result->num_rows > 0) 
                          {    
                            while($row = $result->fetch_assoc()) 
                            {
                              $sql1 = "SELECT * from car_type where type_id =" . $row["type_id"] ."";
                              $result1 = $conn->query($sql1);
                              $row1 = mysqli_fetch_array($result1);

                              $sql2="SELECT location.* from car_loc, location, car where car_loc.car_id=car.car_id and location.loc_id=car_loc.loc_id and car.car_id='".$row["car_id"]."'";
                              $result2= $conn->query($sql2);
                              $row2 = $result2->fetch_assoc();
                              $city = $row2["city"];

                              $innerText='<div class="single-car-wrap">';
    	                        $innerText=$innerText.'<div class="row">';
                              $innerText=$innerText.'<div class="col-lg-7">';
                              $innerText=$innerText.'<div><img src="assets/img/images/' . $row["Image"]. '"></div></div>';
                              $innerText=$innerText.'  <div class="col-lg-5">
                                    <div class="display-table">
                                        <div class="display-table-cell">
                                            <div class="car-list-info">
                                                <h2>'.$row["name"].' - '.$row2["city"].'</h2>
                                                <h5> Car Type: '.$row1["type"].'</h5>
                                                <h5> Seating Capacity: '.$row1["seating_cap"].'</h5>
                                                <h5>Rent per day: $'.$row1["cost"].'</h5>
                                                <a href="payment.php?car_id='.$row["car_id"].'" class="rent-btn">Book It</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>';
                              echo $innerText;
                            }
                          } 
                          else 
                          {
                            echo "<h4>No Car Available.</h4>";
                          }
                          $conn->close();
                    	  ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--== slide Item One ==-->
    </section>
    <!--== Car List Area End ==-->

    <!--== Footer Area Start ==-->
    <section id="footer-area">
        <!-- Footer Widget Start -->
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>About Us</h2>
                            <div class="widget-body">
                                <h2>Rent-a-Car</h2>
                                <p>Find a car available at your location for your dates and book it instantly.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->



                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>get in touch</h2>
                            <div class="widget-body">
                                <p>Contact us for any query. We are happy to help.</p>

                                <ul class="get-touch">
                                    <li><i class="fa fa-map-marker"></i>University of Texas at Dallas</li>
                                    <li><i class="fa fa-mobile"></i> +1 800 345 678</li>
                                    <li><i class="fa fa-envelope"></i>carrental@utdallas.edu</li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Widget End -->
                </div>
            </div>
        </div>
        <!-- Footer Widget End -->
    </section>
    <!--== Footer Area End ==-->


    <!--=======================Javascript============================-->
    <!--=== Jquery Min Js ===-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!--=== Jquery Migrate Min Js ===-->
    <script src="assets/js/jquery-migrate.min.js"></script>
    <!--=== Popper Min Js ===-->
    <script src="assets/js/popper.min.js"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--=== Gijgo Min Js ===-->
    <script src="assets/js/plugins/gijgo.js"></script>
    <!--=== Vegas Min Js ===-->
    <script src="assets/js/plugins/vegas.min.js"></script>
    <!--=== Isotope Min Js ===-->
    <script src="assets/js/plugins/isotope.min.js"></script>
    <!--=== Owl Caousel Min Js ===-->
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <!--=== Waypoint Min Js ===-->
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <!--=== CounTotop Min Js ===-->
    <script src="assets/js/plugins/counterup.min.js"></script>
    <!--=== YtPlayer Min Js ===-->
    <script src="assets/js/plugins/mb.YTPlayer.js"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="assets/js/plugins/magnific-popup.min.js"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="assets/js/plugins/slicknav.min.js"></script>

    <!--=== Mian Js ===-->
    <script src="assets/js/main.js"></script>

</body>

</html>
