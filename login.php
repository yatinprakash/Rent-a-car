<?php
  session_start();
  if(isset($_SESSION['sess_name']))
  {
    header("Location: index.php");
    exit;
  }
  
  $password = $email = "";
  $con = mysqli_connect('localhost','root','root','car rental');

  if(isset($_POST['login_btn']))
  {
    if(empty($_POST["email"]) || empty($_POST["password"]))
    {
      header("Location: login.php");
    }
    else 
    {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $hashed_password = hash('sha256' , $password);
      
      if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) ) // if email is not valid
      {
        header("Location: login.php");
      }
      else //if email is valid ..db validation
      {
        if(!$con)
        {
          die('Could not connect: ' . mysqli_error($con));
          echo "DB Connection Fail";
        }
        else
        {
          $result ="";
         
          $sql="SELECT user_id,name,email,password from user where email= '". $email ."'";
            
          $result = mysqli_query($con,$sql);
          $row = mysqli_fetch_array($result);

          if (!empty($row))
          {
            //email exist
            if($row["password"] == $hashed_password)
            {
              $sql2="SELECT * from admin where a_id='".$row["user_id"]."' ";
              $result2 = mysqli_query($con,$sql2);
              $num_rows = mysqli_num_rows($result2);
               
              if ($num_rows == 1) //admin user
              {
                $_SESSION['sess_name'] = "admin";
                $_SESSION['sess_email'] = $email;
                $_SESSION['sess_user_id'] = $row["user_id"];
                session_write_close();
                header("Location: index.php");
              }
              else
              {
                $_SESSION['sess_name'] = $row["name"];
                $_SESSION['sess_email'] = $email;
                $_SESSION['sess_user_id'] = $row["user_id"];
                session_write_close();
                header("Location: index.php");
              }             
            }
            else//email exist but password is wrong
            {
              header("Location: login.php");                
            }
          }               
          else
          {
            //email does not exist
            header("Location: register.php");
          }
        }
      }
    }
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

        function validateemail() 
        {

            var sd = document.forms["LoginForm"]["email"].value;
            
            if (sd == "") {
                $( '#email_login_status' ).html("Enter Email");
                // alert("Zip code must be filled out");
                return false;
            }
            else
            {
                $( '#email_login_status' ).html("");
            }
        }

        function validateLogin() 
        {

            var sd = document.forms["LoginForm"]["email"].value;
            var ed = document.forms["LoginForm"]["password"].value;


            
            if (sd == "") {
                $( '#email_login_status' ).html("Enter Email");
                // alert("Zip code must be filled out");
                return false;
            }
            else
            {
                $( '#email_login_status' ).html("");
            }
        
            if (ed == "") {
                $( '#pass_login_status' ).html("Enter Password");
                // alert("Zip code must be filled out");
                return false;
            }
            else
            {
                $( '#pass_login_status' ).html("");
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
                                <li><a href="index.php">Home</a></li>
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
                                        echo "<li class='active'><a href=login.php>Login</a></li>";
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
                        <h2>Login</h2>
                        <span class="title-line"><i class="fa fa-car"></i></span>
                        <p>Find a car available at your location for your dates and book it instantly.</p>
                    </div>
                </div>
                <!-- Page Title End -->
            </div>
        </div>
    </section>
    <!--== Page Title Area End ==-->

    <!--== Login Page Content Start ==-->
    <section id="login-page-wrap" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-8 m-auto">
                	<div class="login-page-content">
                		<div class="login-form">
                			<h3>Welcome Back!</h3>
							<form method="post" name="LoginForm" onsubmit="return validateLogin()">
                                <div class="email">
                                    <input type="email" placeholder="Email" name="email" id="email" value="" onblur="validateemail()">
                                    <span id="email_login_status"></span>
                                </div>
                                <div class="password">
                                    <input type="password" placeholder="Password" name="password" id="password" value="" >
                                    <span id="pass_login_status"></span>
                                </div>
                                <div class="log-btn">
                                    <button type="submit" name="login_btn" id="login_btn"><i class="fa fa-sign-in"></i> Log In</button>
                                </div>
                            </form>
                		</div>
                		<div class="create-ac">
                			<p>Don't have an account?</p>
                            <p><a href="register.php">Sign Up</a></p>
                		</div>
                	</div>
                </div>
        	</div>
        </div>
    </section>
    <!--== Login Page Content End ==-->

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