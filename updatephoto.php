<?php
    session_start();
    if (isset ($_POST['submitb']))
    {
        $hostname="localhost";
        $database="car rental";
        $username="root";
        $password="root";

        $conn = mysqli_connect($hostname, $username, $password,$database);
        $image = $_POST['image'];

        $name = $_POST['cname'];
        $sql2="UPDATE `car` set image='$image' where car_id=$name";
        $result = $conn->query($sql2);
        header("location: cars.php");
    }
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

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
                                <li><a href="index.php">Home</a></li>
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
                        <h2>Update Photo</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>

                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->


    <section id="lgoin-page-wrap" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-8 m-auto">
                    <form action="#" method="POST">
                        <div class="login-page-content">
                            <div class="login-form">
                                <select  class="custom-select" style="width: 100%; margin-bottom: 12px " id="cname" name="cname">
                                    <option value="%" selected>CarID - Car - Location</option>
                                    <?php
                                       $hostname="localhost";
                                       $database="car rental";
                                       $username="root";
                                       $password="root";

                                       $conn = mysqli_connect($hostname, $username, $password,$database); 
                                       
                                       $sql="SELECT * from car where status='A'";
                                       $result = $conn->query($sql);

                                       if ($result->num_rows > 0) 
                                       {
                                           while($row = $result->fetch_assoc()) 
                                           {
                                             $nm = $row["name"];
                                             $car_id = $row["car_id"];
                                             $sql1="SELECT location.* from car_loc, location, car where car_loc.car_id=car.car_id and location.loc_id=car_loc.loc_id and car.name='$nm'";
                                             $result1= $conn->query($sql1);
                                             $row1 = $result1->fetch_assoc();
                                             
                                             $city = $row1["city"];   
                                             echo "<option value=$car_id>$car_id - $nm - $city</option>";
                                           }
                                        }
                                    ?>                                
                                </select>
                                <!-- <select  class="custom-select" style="width: 100%; margin-bottom: 5px" id="loc" name="loc">
                                    <option value="%" selected>New Location</option>
                                    <option value=1>Plano</option>
                                    <option value=3>Dallas</option>
                                    <option value=2>Richardson</option>
                                    <option value=4>Frisco</option>
                                </select>
 -->
                                <div class="img-input">
                                    <input type="file" name="image" id="image" placeholder="Add Image">
                                </div>
                            
                                

                                <div class="log-btn">
                                    <button type="submit" name="submitb" id="submitb"> Update Photo </button>
                                </div>
                            </div>     
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--== Contact Page Area End ==-->
    

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


                    <!-- Single Footer Widget Start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <h2>get in touch</h2>
                            <div class="widget-body">
                                <p>Contact us for any query. We are happy to help.</p>

                                <ul class="get-touch">
                                    <li><i class="fa fa-map-marker"></i>University of Texas at Dallas</li>
                                    <li><i class="fa fa-mobile"></i> +1 800 345 678</li>
                                    <li><i class="fa fa-envelope"></i> carrental@utdallas.edu</li>
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
