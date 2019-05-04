<?php
    session_start();
    $_SESSION["Car_id"]=$_GET["car_id"];
    if(isset($_POST['submitbutton']))
    {
    $hostname="localhost";
    $database="car rental";
    $username="root";
    $password="root";
    $conn = mysqli_connect($hostname, $username, $password,$database);
    if (!$conn)
    {
    die("Connection failed: " . mysqli_connect_error());
    }
    $datetime1 = strtotime($_SESSION['sess_sdate']);
    $datetime2 = strtotime($_SESSION['sess_edate']);

    $secs = $datetime2 - $datetime1;// == <seconds between the two times>
    $days = $secs / 86400;
    $sql1 = "SELECT * from car_type where type_id =" .$_SESSION["sess_cartype"] ."";
    $result1 = $conn->query($sql1);
    $row1 = mysqli_fetch_array($result1);
    $finalcost= $days *$row1["cost"];
    $sql = "INSERT INTO `booking` (`book_id`, `user_id`, `loc_id`, `car_id`, `pick_up`, `return_date`, `status`, `amt`) VALUES (NULL, '".$_SESSION["sess_user_id"]."', '".$_SESSION["sess_finallocation"]."', '".$_SESSION["Car_id"]."', '".$_SESSION["sess_sdate"]."', '".$_SESSION["sess_edate"]."', 'Paid', '$finalcost' )";
    
    $result = $conn->query($sql);

    header("location: myaccount.php");
}
 ?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    

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




    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>     
    <script type="text/javascript">
        function validateForm() 
        {
            var x = document.forms["myForm"]["NameOnCard"].value;
            if (x == "") {
                $( '#name_card_status' ).html("Enter Name");
                //alert("Name must be filled out");
                return false;
            }
            else
            {
                $( '#name_card_status' ).html("");
            }
            var z = document.forms["myForm"]["CreditCardNumber"].value;
            if (z == "") {
                $( '#num_card_status' ).html("Enter Card Number");
                // alert("Credit Crad must be filled out");
                return false;
            }
            else
            {
                $( '#num_card_status' ).html("");
            }
            var z1 = document.forms["myForm"]["CreditCardNumber"].value;
            if (z1.length < 16) {
                $( '#num_card_status' ).html("Card Number must be 16 digits");
                // alert("Credit Crad must be min 16 digits");
                return false;
            }
            else
            {
                $( '#num_card_status' ).html("");
            }

            var y = document.forms["myForm"]["ZIPCode"].value;
            if (y == "") {
                $( '#zip_card_status' ).html("Enter Zipcode");
                // alert("Zip code must be filled out");
                return false;
            }
            else
            {
                $( '#zip_card_status' ).html("");
            }

            var ccm = document.forms["myForm"]["CCExpiresMonth"].value;
            if (ccm == "") {
                $( '#month_card_status' ).html("Select Month");
                
                return false;
            }
            else
            {
                $( '#month_card_status' ).html("");
            }

            if (ccy == "") {
                $( '#year_card_status' ).html("Select Year");
                
                return false;
            }
            else
            {
                $( '#year_card_status' ).html("");
            }

            
            var w = document.forms["myForm"]["SecurityCode"].value;
            if (w == "") {
                $( '#cvv_card_status' ).html("Enter CVV");
                
                return false;
            }
            else
            {
                $( '#cvv_card_status' ).html("");
            }

            
            if (w.length != 3) {
                $( '#cvv_card_status' ).html("CVV must be 3 digits");
                
                return false;
            }
            else
            {
                $( '#cvv_card_status' ).html("");
            }

        }
    </script>
</head>

<body class="loader-active">


    
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
                            <img src="assets/img/logo.png" alt="JSOFT">Car Rental
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

    <!--== Page Title Area Start ==-->
    <section id="page-title-area" class="section-padding overlay">
        <div class="container">
            <div class="row">
                <!-- Page Title Start -->
                <div class="col-lg-12">
                    <div class="section-title  text-center">
                        <h2>Make Your Payment</h2>
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
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="book-a-car">
                            <form name="myForm" method="POST" action="#" onsubmit="return validateForm()" >                            
                                <div class="pickup-location book-item">
                                    <!-- <h4>Name on Card:</h4> -->
                                    <input type="text" placeholder="    Name on Card" class="custom-text" name="NameOnCard" id="NameOnCard" value="">
                                    <span id="name_card_status"></span>
                                </div>     
                                <div class="pickup-location book-item">
                                    <!-- <h4>Card Number:</h4> -->
                                    <input type="text" placeholder="    Card Number" name="CreditCardNumber" id="CreditCardNumber" value="">
                                    <span id="num_card_status"></span>
                                </div>      
                                <div class="pickup-location book-item">
                                    <!-- <h4>Zipcode:</h4> -->
                                    <input type="text" placeholder="    Zip" name="ZIPCode" value="">
                                    <span id="zip_card_status"></span>
                                </div>     
                                
                                            <!-- <td colspan="2" align="left"><input name="NameOnCard" type="text" size="50"></td> -->
                                <div class="choose-car-type book-item">
                                    <!-- <h4>Expiry:</h4> -->
                                    <select class="custom-select" name="CCExpiresMonth" id="CCExpiresMonth">          
                                       <OPTION VALUE="" SELECTED>Month</OPTION>
                                       <OPTION VALUE="01">Jan</OPTION>
                                       <OPTION VALUE="02">Feb</OPTION>
                                       <OPTION VALUE="03">Mar</OPTION>
                                       <OPTION VALUE="04">Apr</OPTION>
                                       <OPTION VALUE="05">May</OPTION>
                                       <OPTION VALUE="06">Jun</OPTION>
                                       <OPTION VALUE="07">Jul</OPTION>
                                       <OPTION VALUE="08">Aug</OPTION>
                                       <OPTION VALUE="09">Sep</OPTION>
                                       <OPTION VALUE="10">Oct</OPTION>
                                       <OPTION VALUE="11">Nov</OPTION>
                                       <OPTION VALUE="12">Dec</OPTION>
                                    </select>
                                    <span id="month_card_status"></span>
                                </div>
                                <div class="choose-car-type book-item">
                                    <select class="custom-select" name="CCExpiresYear" id="CCExpiresYear">          
                                       <OPTION VALUE="" SELECTED>Year</OPTION>
                                       <OPTION VALUE="19">2019</OPTION>
                                       <OPTION VALUE="20">2020</OPTION>
                                       <OPTION VALUE="21">2021</OPTION>
                                       <OPTION VALUE="22">2022</OPTION>
                                       <OPTION VALUE="23">2023</OPTION>
                                    </select>
                                    <span id="year_card_status"></span>
                                </div>
                                <div class="name">
                                    <!-- <h4>CVV:</h4> -->
                                    <input type="password" placeholder="    CVV" name="SecurityCode" id="SecurityCode" value="">
                                    <span id="cvv_card_status"></span>
                                </div>
                                <br>
                                            
                                <div class="book-button text-center">
                                    <button class="book-now-btn" type="submit" name="submitbutton" id="submitbutton">Pay</button>  
                                </div>       
                        </form>
                    <!-- Single Footer Widget End -->
                </div>
            </div>
        </div>
        <!-- Footer Widget End -->


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
