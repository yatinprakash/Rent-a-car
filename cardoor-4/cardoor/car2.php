<?php
session_start();
 ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Car Rental Service</title>

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


    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loader-active">

    <!--== Preloader Area Start ==-->
    <div class="preloader">
        <div class="preloader-spinner">
            <div class="loader-content">
                <img src="assets/img/preloader.gif" alt="JSOFT">
            </div>
        </div>
    </div>
    <!--== Preloader Area End ==-->

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">
        <!--== Header Top Start ==-->
        <div id="header-top" class="d-none d-xl-block">
            <div class="container">
                <div class="row">
                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-3 text-left">
                        <i class="fa fa-map-marker"></i> University of Texas at Dallas
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-3 text-center">
                        <i class="fa fa-mobile"></i> +1 800 345 678
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Single HeaderTop Start ==-->
                    <div class="col-lg-3 text-center">
                        <i class="fa fa-clock-o"></i> Mon-Fri 09.00 - 17.00
                    </div>
                    <!--== Single HeaderTop End ==-->

                    <!--== Social Icons Start ==-->
                    <div class="col-lg-3 text-right">
                        <div class="header-social-icons">
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                        </div>
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
                                <li><a href="about.html">About</a></li>

                                <li class="active"><a href="car2.php">Cars</a></li>


                                <li><a href="contact.html">Contact</a></li>
                                <?php

                                if(isset($_SESSION['sess_name']))
                                  {

                                    echo "<li><a href=myaccount.php>My Account</a></li>";
                                    echo "<li><a href=login-test.php>Sign Out</a></li>";
                                  }
                                else{

                                    echo "<li><a href=login-test.php>Login</a></li>";
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
                        <h2>Our Cars</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Find a car available at your location for your dates and book it instantly.</p>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <section id="car-list-area" class="section-padding">
        <div class="container">
            <div class="row">
                <!-- Car List Content Start -->
                <div class="col-lg-8">
                    <div class="car-list-content">
                        <!-- Single Car Start -->
                        <?php

              						$hostname="localhost";
              						$database="car rental";
              						$username="root";
              						$password="";
              						$conn = mysqli_connect($hostname, $username, $password,$database);
              						if (!$conn)
              						{
              							die("Connection failed: " . mysqli_connect_error());
              						}
                          if(isset($_GET['SubmitButton']) || isset($_GET['searchbutton']) )
                          {
                            //if we dont click on any filter alert the user.
                            if(isset($_GET['SubmitButton'])){


                            if(!(isset($_GET['fil1']))  && !(isset($_GET['fil'])))
                            {

                              $sql="SELECT * from car";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {

                                  $sql1 = "SELECT * from car_type where type_id =" . $row["type_id"] ."";
                                  $result1 = $conn->query($sql1);
                                  $row1 = mysqli_fetch_array($result1);

                                  $innerText='<div class="single-car-wrap">';
                                  $innerText=$innerText.'<div class="row">';
                                  $innerText=$innerText.'<div class="col-lg-5">';
                                  $innerText=$innerText.'<div><img src="assets/img/images/' . $row["Image"]. '"></div></div>';
                                  $innerText=$innerText.'  <div class="col-lg-7">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <div class="car-list-info">
                                                    <h2>'.$row["name"].'</h2>
                                                    <h5>Rent per day: $'.$row1["cost"].'</h5>
                                                    <h5> Seating Capacity: '.$row1["seating_cap"].'</h5>
                                                    <a href="index.php" class="rent-btn">Book It</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>';
                            echo $innerText;
                            }
}}
                            //check individual filter
                            else{

                              //check for car type filter
                              if(isset($_GET['fil1'])){

                                $cartype = $_GET['fil1'];
                            //$carcap = $_GET['fil'];
                                foreach ($cartype as $ct){

                                    $sql = "SELECT * from car where type_id=".$ct."";
                                    $result = $conn->query($sql);
                                  }

                            if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {

                                $sql1 = "SELECT * from car_type where type_id =" . $row["type_id"] ."";
                                $result1 = $conn->query($sql1);
                                $row1 = mysqli_fetch_array($result1);

                              //  $innerText='<div class="single-car-wrap">';
                              $innerText='<div class="single-car-wrap">';
                                $innerText=$innerText.'<div class="row">';
                                $innerText=$innerText.'<div class="col-lg-5">';
                                $innerText=$innerText.'<div><img src="assets/img/images/' . $row["Image"]. '"></div></div>';
                                $innerText=$innerText.'  <div class="col-lg-7">
                                      <div class="display-table">
                                          <div class="display-table-cell">
                                              <div class="car-list-info">
                                                  <h2>'.$row["name"].'</h2>
                                                  <h5>Rent per day: $'.$row1["cost"].'</h5>
                                                  <h5> Seating Capacity: '.$row1["seating_cap"].'</h5>
                                                  <a href="index.php" class="rent-btn">Book It</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>';
                          echo $innerText;
                        }}}
                        if(isset($_GET['fil'])){
                          $carcap = $_GET['fil'];
                      //$carcap = $_GET['fil'];

                          foreach ($carcap as $cc){

                              $sql = "SELECT * from car_type where seating_cap=".$cc."";
                            
                              $result = $conn->query($sql);
                            }

                      if ($result->num_rows > 0) {
                        // output data of each row

                        while($row = $result->fetch_assoc()) {

                          $sql1 = "SELECT * from car where type_id =" . $row["type_id"] ."";
                          $result1 = $conn->query($sql1);
                          while($row1 = $result1->fetch_assoc())
                          {//$row1 = mysqli_fetch_array($result1);

                          $innerText='<div class="single-car-wrap">';
                          $innerText=$innerText.'<div class="row">';
                          $innerText=$innerText.'<div class="col-lg-5">';
                          $innerText=$innerText.'<div><img src="assets/img/images/' . $row1["Image"]. '"></div></div>';
                          $innerText=$innerText.'  <div class="col-lg-7">
                                <div class="display-table">
                                    <div class="display-table-cell">
                                        <div class="car-list-info">
                                            <h2>'.$row1["name"].'</h2>
                                            <h5>Rent per day: $'.$row["cost"].'</h5>
                                            <h5> Seating Capacity: '.$row["seating_cap"].'</h5>
                                            <a href="index.php" class="rent-btn">Book It</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>';
                    echo $innerText;
                  }}}}
                          // echo $innerText;

                          }
                        }

                        //search
                        elseif(isset($_GET['searchbutton']))
                        {


                          $query = $_GET['query'];
                                                          // makes sure nobody uses SQL injection
                              $sql="SELECT * from car WHERE name LIKE '%".$query."%'";

                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {

                                  $sql1 = "SELECT * from car_type where type_id =" . $row["type_id"] ."";
                                  $result1 = $conn->query($sql1);
                                  $row1 = mysqli_fetch_array($result1);

                                  $innerText='<div class="single-car-wrap">';
                                  $innerText=$innerText.'<div class="row">';
                                  $innerText=$innerText.'<div class="col-lg-5">';
                                  $innerText=$innerText.'<div><img src="assets/img/images/' . $row["Image"]. '"></div></div>';
                                  $innerText=$innerText.'  <div class="col-lg-7">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <div class="car-list-info">
                                                    <h2>'.$row["name"].'</h2>
                                                    <h5>Rent per day: $'.$row1["cost"].'</h5>
                                                    <h5> Seating Capacity: '.$row1["seating_cap"].'</h5>
                                                    <a href="index.php" class="rent-btn">Book It</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>';
                            echo $innerText;
                                }

                                }
                                else{ // if there is no matching rows do following
                                    echo "No results";
                                }

                          }
                          }
                          else {
                                    $sql="SELECT * from car";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                      // output data of each row
                                      while($row = $result->fetch_assoc()) {

                                        $sql1 = "SELECT * from car_type where type_id =" . $row["type_id"] ."";
                                        $result1 = $conn->query($sql1);
                                        $row1 = mysqli_fetch_array($result1);

                                        $innerText='<div class="single-car-wrap">';
								                        $innerText=$innerText.'<div class="row">';
                                        $innerText=$innerText.'<div class="col-lg-5">';
                                        $innerText=$innerText.'<div><img src="assets/img/images/' . $row["Image"]. '"></div></div>';
                                        $innerText=$innerText.'  <div class="col-lg-7">
                                              <div class="display-table">
                                                  <div class="display-table-cell">
                                                      <div class="car-list-info">
                                                          <h2>'.$row["name"].'</h2>
                                                          <h5>Rent per day: $'.$row1["cost"].'</h5>
                                                          <h5> Seating Capacity: '.$row1["seating_cap"].'</h5>
                                                          <a href="index.php" class="rent-btn">Book It</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                      </div>
                                  </div>';
                                  echo $innerText;

                                  }
                                  } else {
                                      echo "<h4>Results not found</h4>";
                                  }
                                  $conn->close();
                                  }


                                  	?>


                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-content-wrap m-t-50">
                        <!-- Single Sidebar Start -->
                         <div class="single-sidebar">
                            <h3>Search</h3>

                            <div class="sidebar-body">
                              <form action="#" method="GET">
                                <input type="text" name="query" placeholder="Search..">
                                <button type="submit" name="searchbutton">Search</button>
                              </form>
                            </div>
                        </div>
                        <!-- Single Sidebar End -->



                        <!-- Single Sidebar Start -->
                        <div class="single-sidebar">
                            <h3>Filter</h3>

                            <div class="sidebar-body">
                                <div class="social-icons text-center">
                                  <form action="#" method="get">
                                    Car Type:<br>
                                    Sedan <input type="checkbox" id="fil1" name="fil1[]" value="2"><br>
                                    Economy <input type="checkbox" id="fil1" name="fil1[]" value="1"><br>
                                    Premium <input type="checkbox" id="fil1" name="fil1[]" value="4"><br>
                                    SUV <input type="checkbox" id="fil1" name="fil1[]" value="3"><br>
                                <!-- </div>
                                <div class="social-icons text-center"> -->
                                  <br>
                                    Capacity:<br>
                                    2 <input type="checkbox" id="fil" name="fil[]" value="2"><br>
                                    4 <input type="checkbox" id="fil" name="fil[]" value="4"><br>
                                    5 <input type="checkbox" id="fil" name="fil[]" value="5"><br>
                                    6 <input type="checkbox" id="fil" name="fil[]" value="6"><br>
                                    <br>
                                    <button type="submit" name="SubmitButton">Apply Filter </button>
                                  </form>
                                </div>

                            </div>
                        </div>
                        <!-- Single Sidebar End -->
                        <?php
                        if($_SESSION['sess_name'] == "admin")
                          {
                            echo '<div class="single-sidebar"><h3>Admin</h3><div class="sidebar-body">';

                            echo "<a href=addcar.php>Add Car</a><br>";
                            echo "<a href=deletecar.php>Delete Car</a><br>";
                            echo "<a href=Updatecar.php>Update Car</a><br>";
                            echo "   </div></div>";
                          }

                       ?>
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
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
                                <img src="assets/img/logo.png" alt="JSOFT">
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
                                <p>Find a car available at your location for your dates and book it instantly.</p>

                                <ul class="get-touch">
                                    <li><i class="fa fa-map-marker"></i>University of Texas at Dallas</li>
                                    <li><i class="fa fa-mobile"></i> +1 800 345 678</li>
                                    <li><i class="fa fa-envelope"></i>carrental@utdallas.edu</li>
                                </ul>
                                <a href="https://goo.gl/maps/b5mt45MCaPB2" class="map-show" target="_blank">Show Location</a>
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

    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="assets/img/scroll-top.png" alt="JSOFT">
    </div>
    <!--== Scroll Top Area End ==-->

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
