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


    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                          $password="root";
                          $conn = mysqli_connect($hostname, $username, $password,$database);
                          if (!$conn)
                          {
                            die("Connection failed: " . mysqli_connect_error());
                          }

                          if(isset($_GET['searchbutton']))
                          {
                            $cartype = $_SESSION['cartype'];
                            $locn = $_SESSION['locn'];
                          }

                          $_SESSION['cartype'] = $_GET['fil1'];
                          $_SESSION['locn'] = $_GET['fil2'];

                          if(isset($_GET['searchbutton']))
                          {
                            $_SESSION['cartype']=$cartype;
                            $_SESSION['locn']=$locn;
                          }


                          $car_name = $_GET['car_name'];
                          $_SESSION['car_name'] = $car_name;
                          // echo $car_name;
                          $q1 = 'car.type_id='.implode(' or car.type_id=', $_SESSION['cartype']);
                          //echo $q1;

                          $q2 = 'car_loc.loc_id='.implode(' or car_loc.loc_id=', $_SESSION['locn']);
                          //echo $q2;
                          
                          $query = "SELECT distinct car.* FROM car, car_loc where car.status='A'";//and ($q1) and ($q2)";
                          


                          if (isset($_SESSION['cartype']))
                          {
                            $query = $query.' and ('.$q1.')';
                          }
                          if (isset($_SESSION['locn']))
                          {
                            $query = $query.' and car.car_id = car_loc.car_id and ('.$q2.')';
                          }
                          
                          if ($car_name !='')
                          {
                            $query = $query." and car.name LIKE '".$car_name."'";
                          }


                          // echo $query.'<br>';
                          $result = $conn->query($query);
                          if(mysqli_num_rows($result) == 0)
                          {
                            echo '<h1>No car available<h1>';
                          }


                          while($row = $result->fetch_assoc()) 
                          {
                            // foreach ($row as $r) {
                            //   echo $r.' ';
                            // }
                            
                            $sql1 = "SELECT * from car_type where type_id =" . $row["type_id"] ."";
                                    $result1 = $conn->query($sql1);
                                    $row1 = mysqli_fetch_array($result1);

                            $sql2="SELECT location.* from car_loc, location, car where car_loc.car_id=car.car_id and location.loc_id=car_loc.loc_id and car.car_id='".$row["car_id"]."'";
                            $result2= $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            $city = $row2["city"];
                            // echo $city.' <br>';

                            $innerText='<div class="single-car-wrap">';
                            $innerText=$innerText.'<div class="row">';
                            $innerText=$innerText.'<div class="col-lg-7">';
                            $innerText=$innerText.'<div><img src="assets/img/images/' . $row["Image"]. '"></div></div>';
                            $innerText=$innerText.'  <div class="col-lg-5">
                                  <div class="display-table">
                                      <div class="display-table-cell">
                                          <div class="car-list-info">
                                              <h2>'.$row["name"].' - '.$row2["city"].'</h2>
                                              <hr>
                                              <h5> Car Type: '.$row1["type"].'</h5>
                                              <h5> Seating Capacity: '.$row1["seating_cap"].'</h5>
                                              <h5>Rent per day: $'.$row1["cost"].'</h5>
                                              <a href="index.php" class="rent-btn">Book It</a>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>';
                            echo $innerText;
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
                                <div>
                                <input type="text" name="car_name" class="form-control" style="margin-bottom: 12px" <?php if(isset($_SESSION['car_name'])) echo 'value='.$_SESSION['car_name']; else echo 'placeholder=Search.. value='; ?> >
                                </div>
                                <div class="book-button text-center">
                                    <button type="submit" name="searchbutton" class="book-now-btn" id="searchbutton">Search</button>
                                </div>
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
                                      <?php
                                      if(!isset($_GET['SubmitButton'])){
                                      $_GET['fil1']=[];
                                      } ?>

                                    <table class="table table-bordered">
                                    <thead><th colspan="2">Car Type</th></thead>
                                    <tbody>
                                    <tr><td>Sedan</td><td><input type="checkbox" id="fil1" name="fil1[]" value="2" <?php if ( in_array('2',$_SESSION['cartype'])) echo 'checked' ?>></td></tr>
                                    <tr><td>Economy</td><td> <input type="checkbox" id="fil1" name="fil1[]" value="1" <?php if (in_array('1',$_SESSION['cartype'])) echo 'checked' ?>></td></tr>
                                    <tr><td>Premium</td><td> <input type="checkbox" id="fil1" name="fil1[]" value="4" <?php if (in_array('4',$_SESSION['cartype'])) echo 'checked' ?>></td></tr>
                                    <tr><td>SUV</td><td> <input type="checkbox" id="fil1" name="fil1[]" value="3" <?php if ( in_array('3',$_SESSION['cartype'])) echo 'checked' ?>></td></tr>
                                  </tbody>
                                  </table>
                                <!-- </div>
                                <div class="social-icons text-center"> -->
                                  <br>

                                  <table class="table table-bordered">
                                    <thead><th colspan="2">Location</th></thead>
                                    
                                      <?php
                                      if(!isset($_GET['SubmitButton'])){
                                      $_GET['fil2']=[];
                                    }
                                       ?>
                                    <tbody>
                                    <tr><td>Dallas</td><td> <input type="checkbox" id="fil2" name="fil2[]" value="3" <?php if ( in_array('3', $_SESSION['locn'])) echo 'checked' ?>></td></tr>
                                    <tr><td>Plano</td><td> <input type="checkbox" id="fil2" name="fil2[]" value="1" <?php if ( in_array('1', $_SESSION['locn'])) echo 'checked' ?>></td></tr>
                                    <tr><td>Richardson</td><td> <input type="checkbox" id="fil2" name="fil2[]" value="2" <?php if( in_array('2', $_SESSION['locn'])) echo 'checked' ?>></td></tr>
                                    <tr><td>Frisco</td><td> <input type="checkbox" id="fil2" name="fil2[]" value="4" <?php if ( in_array('4', $_SESSION['locn'])) echo 'checked' ?>></td></tr>
                                  </tbody>
                                  </table>

                                  </table>
                                    <div class="book-button text-center">
                                        <button type="submit" name="SubmitButton" class="book-now-btn" id="SubmitButton">Filter</button>
                                    </div>
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
                            echo "<a href=Updatecar.php>Update Location</a><br>";
                            echo "<a href=Updatephoto.php>Update Photo</a><br>";
                            echo "</div></div>";
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
