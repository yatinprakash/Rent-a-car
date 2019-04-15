<?php
session_start();
$_SESSION["Car_id"]=$_GET["car_id"];
if(isset($_POST['submitbutton']))
{
$hostname="localhost";
$database="car rental";
$username="root";
$password="";
$conn = mysqli_connect($hostname, $username, $password,$database);
if (!$conn)
{
die("Connection failed: " . mysqli_connect_error());
}
$datetime1 = strtotime($_SESSION['sess_sdate']);
$datetime2 = strtotime($_SESSION['sess_edate']);

$secs = $datetime2 - $datetime1;// == <seconds between the two times>
$days = $secs / 86400;
$sql1 = "SELECT * from car_type where type_id =" .   $_SESSION["sess_cartype"] ."";
$result1 = $conn->query($sql1);
$row1 = mysqli_fetch_array($result1);
$finalcost= $days *$row1["cost"];
$sql = "INSERT INTO `booking` (`book_id`, `user_id`, `loc_id`, `car_id`, `pick_up`, `return_date`, `status`, `amt`) VALUES (NULL, '".$_SESSION["sess_id"]."', '".$_SESSION["sess_finallocation"]."', '".$_SESSION["Car_id"]."', '".$_SESSION["sess_sdate"]."', '".$_SESSION["sess_edate"]."', 'Paid', '$finalcost' )";
$result = $conn->query($sql);
header("location:myaccountash.php");
}
 ?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>

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
     <!-- <script type="text/javascript">
     $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");
            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }
            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });
            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
        function deletebooking(booking_id)
        {
            $ans=confirm("Do you want to delete booking?");
            if($ans)
            {
                window.location= 'cancelbooking.php?booking_id='+booking_id;

            }
        }
    </script> -->
    <!-- <script>
function validateForm() {
    var x = document.forms["myForm"]["NameOnCard"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
    var y = document.forms["myForm"]["ZIPCode"].value;
    if (y == "") {
        alert("Zip code must be filled out");
        return false;
    }
    var z = document.forms["myForm"]["CreditCardNumber"].value;
    if (z == "") {
        alert("Credit Crad must be filled out");
        return false;
    }
    var z1 = document.forms["myForm"]["CreditCardNumber"].value;
    if (z1.length < 16) {
        alert("Credit Crad must be min 16 digits");
        return false;
    }
    var w = document.forms["myForm"]["SecurityCode"].value;
    if (w == "") {
        alert("CVV number must be filled out");
        return false;
    }
     var w1 = document.forms["myForm"]["SecurityCode"].value;
    if (w1 .length < 3 || w1 .length > 3) {
        alert("CVV number must be 3 digit only");
        return false;
    }
}
</script> -->
</head>

<body class="loader-active">


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
                        <i class="fa fa-map-marker"></i>University of Texas at Dallas
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
                        <a href="index.html" class="logo">
                            <img src="assets/img/logo.png" alt="JSOFT">Car Rental
                        </a>
                    </div>
                    <!--== Logo End ==-->

                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>
                                <li class="active"><a href="index.html">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="car-right-sidebar.html">Cars</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <!-- <li><a href="login2.php">Login</a></li> -->
                                <?php

                                if(isset($_SESSION['sess_name']))
                                  {
                                    echo $_SESSION['sess_id'];
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
                        <h2>Make Your Payment</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>

                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Contact Page Area Start ==-->
    <div class="section group">
                <div class="col span_2_of_3">
            <span class="text2" id= 'findCars'><h5>Payment:</h5></span>
            <hr>
                  <div class="my bookings">

                    <form name="myForm" method="POST" action="#" onsubmit="return validateForm()" >
    <table width=518 border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
 <tr bgcolor="#E5E5E5">
   <td height="22" colspan="3" align="left" valign="middle"><strong>&nbsp;Billing Information (required)</strong></td>
 </tr>
 <tr>
   <td height="22" width="180" align="right" valign="middle">Name on the Card:</td>
   <td colspan="2" align="left"><input name="NameOnCard" type="text" size="50"></td>
 </tr>
 <tr>
   <td height="22" align="right" valign="middle">Zip/Postal Code:</td>
   <td colspan="2" align="left"><input name="ZIPCode" type="text" value="" size="50"></td>
 </tr>
 <tr>
   <td height="22" align="right" valign="middle">Credit Card Number:</td>
   <td colspan="2" align="left"><input name="CreditCardNumber" type="text" value="" size="19" maxlength="40"></td>
 </tr>
 <tr>
   <td height="22" align="right" valign="middle">Expiry Date:</td>
   <td colspan="2" align="left">
     <SELECT NAME="CCExpiresMonth" >
       <OPTION VALUE="" SELECTED>--Month--
       <OPTION VALUE="01">January (01)
       <OPTION VALUE="02">February (02)
       <OPTION VALUE="03">March (03)
       <OPTION VALUE="04">April (04)
       <OPTION VALUE="05">May (05)
       <OPTION VALUE="06">June (06)
       <OPTION VALUE="07">July (07)
       <OPTION VALUE="08">August (08)
       <OPTION VALUE="09">September (09)
       <OPTION VALUE="10">October (10)
       <OPTION VALUE="11">November (11)
       <OPTION VALUE="12">December (12)
     </SELECT> /
     <SELECT NAME="CCExpiresYear">
       <OPTION VALUE="" SELECTED>--Year--
       <OPTION VALUE="04">2004
       <OPTION VALUE="05">2005
       <OPTION VALUE="06">2006
       <OPTION VALUE="07">2007
       <OPTION VALUE="08">2008
       <OPTION VALUE="09">2009
       <OPTION VALUE="10">2010
       <OPTION VALUE="11">2011
       <OPTION VALUE="12">2012
       <OPTION VALUE="13">2013
       <OPTION VALUE="14">2014
       <OPTION VALUE="15">2015
     </SELECT>
   </td>
 </tr>
 <tr>
   <td height="22" align="right" valign="middle">CVV:</td>
   <td colspan="2" align="left"><input name="SecurityCode" type="text" value="" size="19" maxlength="40"></td>
 </tr>
</table>
<p><input name="submitbutton" id="submitbutton" type="submit" value="PAY &gt;&gt;"></p>
</form>
                  </div>
                </div>

              </div>
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
                                <img src="assets/img/logo.png" alt="JSOFT">
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
