<?php
    session_start();
    if(!isset($_SESSION['sess_name']))
    {
        header("location: login.php");
        exit;
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>     
    <script type="text/javascript">

        function validateIndexForm() 
        {

            var sd = document.forms["index_form"]["startDate"].value;
            var ed = document.forms["index_form"]["endDate"].value;

            var start= new Date(sd);
            var end= new Date(ed);
            
            if (sd == "") {
                $( '#sdate_index_status' ).html("Select Pickup Date");
                // alert("Zip code must be filled out");
                return false;
            }
            else
            {
                $( '#sdate_index_status' ).html("");
            }
        
            if (ed == "") {
                $( '#edate_index_status' ).html("Select Return Date");
                // alert("Zip code must be filled out");
                return false;
            }
            else
            {
                $( '#edate_index_status' ).html("");
            }

            if(end <= start)
            {   
                $( '#edate_index_status' ).html("Return Date must be after Start Date");
                return false;
            }
            else
            {
                $( '#edate_index_status' ).html("");
            }
        }
    </script>
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
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="cars.php">Cars</a></li>
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

    <!--== Slider Area Start ==-->
    <section id="slider-area">
        <!--== slide Item One ==-->
        <div class="single-slide-item overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="book-a-car">
                            <form onsubmit="return validateIndexForm()" action="booking.php" method="POST" name="index_form" >
                                <!--== Pick Up Location ==-->
                                <div class="pickup-location book-item">
                                    <h4>PICK-UP LOCATION:</h4>
                                    <select class="custom-select" id="location" name="location" required>
                                      <option value=''>Location</option>
                                      <option value="1">Plano</option>
                                      <option value="2">Richardson</option>
                                      <option value="3">Dallas</option>
                                      <option value="4">Frisco</option>
                                    </select>
                                </div>
                                <!--== Pick Up Location ==-->

                                <!--== Pick Up Date ==-->
                                <div class="pick-up-date book-item">
                                    <h4>PICK-UP DATE:</h4>
                                    <input type="date" id="startDate" min="<?php echo date('Y-m-d');?>" placeholder="Pick Up Date" name="sdate" id="sdate" value=""/>
                                    <span id="sdate_index_status"></span>

                                    <div class="return-car">
                                        <h4>Return DATE:</h4>
                                        <input type="date" id="endDate" min="<?php echo date('Y-m-d');?>" placeholder="Return Date" name="edate" id="edate" value=""/>
                                        <span id="edate_index_status"></span>
                                    </div>
                                </div>
                                <!--== Pick Up Location ==-->

                                <!--== Car Choose ==-->
                                <div class="choose-car-type book-item">
                                    <h4>CHOOSE CAR TYPE:</h4>
                                    <select class="custom-select" name="ctype" id="ctype" required>
                                      <option value='' >Type</option>
                                      <option value="1">Economy</option>
                                      <option value="2">Sedan</option>
                                      <option value="3">SUV</option>
                                      <option value="4">Premium</option>
                                    </select>
                                </div>
                                <!--== Car Choose ==-->

                                <div class="book-button text-center">
                                    <button class="book-now-btn" id="book">Book Now</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-7 text-right">
                        <div class="display-table">
                            <div class="display-table-cell">
                                <div class="slider-right-text">
                                    <h1>RENT-A-CAR</h1>
                                    <p>FOR AS LOW AS $30</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== slide Item One ==-->
    </section>
    <!--== Slider Area End ==-->
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
