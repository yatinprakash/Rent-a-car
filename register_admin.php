<?php
  session_start();
  if(isset($_SESSION['sess_name']))  //signout
  {
      session_destroy();
      session_start();  
  }

  $name = $phone = $dob = $password = $email = $lic_no = "";
  $con = mysqli_connect('localhost','root','root','car rental');
  if(!$con)
  {
    die('Could not connect: ' . mysqli_error($con));
    echo "DB Connection Fail";
  }

  if(isset($_POST['register_admin_btn']))
  {
    if(empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["name"]) || empty($_POST["phone"]) || empty($_POST["dob"]) || empty($_POST["lic_no"]))
    {
      header("Location: register_admin.php");
    }
    else 
    {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $name = $_POST["name"];
      $phone = $_POST["phone"];
      $dob = $_POST["dob"];
      $lic_no = $_POST["lic_no"];
      $hashed_password = hash('sha256' , $password);
      
      if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) || !preg_match('/^[0-9]{10}$/', $phone) || !preg_match('/^[0-9]{8}$/', $lic_no)) // If email is present DB
      {  
        header("Location: register_admin.php"); // Change to invalid input page.
      }
      else // If email is not in DB - Register new user
      { 
        if(!$con)
        {
          die('Could not connect: ' . mysqli_error($con));
        }
        else
        { 
          $sql="INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `phone`, `dob`, `lic_no`) VALUES (NULL, '".$name."', '". $email ."','". $hashed_password ."', '". $phone ."', '". $dob ."', '". $lic_no ."')";

          if(mysqli_query($con,$sql))
          {
            $id = mysqli_insert_id($con);
            
            $sql1 = "INSERT INTO `admin` VALUES('".$id."')";
            if(mysqli_query($con,$sql1))
            {
              session_regenerate_id();
              $_SESSION['sess_name'] = $name;
              $_SESSION['sess_email'] = $email;
              $_SESSION['sess_user_id'] = $id; 
              session_write_close();
              header("Location: index.php");
            }
            else
            {
              header("Location: register_admin.php");
            }
              
          }
        }        }
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">

            function checkall()
            {
             
              var name = document.forms["registerForm"]["name"].value;
              if (name == '')
              {
                $( '#name_status' ).html("Enter Name");   
                    return false;    
               }
               else
               {   
                $( '#name_status' ).html("");
                
               }

             var email = document.forms["registerForm"]["email"].value;
              // var email=document.getElementById( "email" ).value;

              if(email!='')
              {
                $.ajax({
                  dataType:'text',
                  type: 'post',
                  url: 'checkdata.php',
                  data: {
                    email:email,
                  },
                  success: function (response) {
                    var result = $.trim(response);
                    if(result==="Email Already Exist")
                    {
                      $( '#email_status' ).html(response);
                      return false;
                    }
                    else
                    {
                      $( '#email_status' ).html(response);
                      
                    }
                   }
                });
              }
              else
              {
                $( '#email_status' ).html("Enter Email");
                return false;
              }

             var password = document.forms["registerForm"]["password"].value;

             if(password!='')
             {                     
               var regex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})";  
             
               if (!password.match(regex))
               {
                 $( '#password_status' ).html("Password must be of 8 or more characters and must contain lowercase, uppercase and numbers");
                 return false;
               }
               else
               {   
                 $( '#password_status' ).html("");
                 
               } 
             }
             else
             {
               $( '#password_status' ).html("Enter Password");
               return false;
             }
             
             
              var phone = document.forms["registerForm"]["phone"].value;
                
             if(phone!='')
             {
              var regex =/^\d{10}$/;  // Change it.
               if (!phone.match(regex))
               {
                    $( '#phone_status' ).html("Phone number must have 10 digits");  
                    return false;     
               }
               else
               {   
                $( '#phone_status' ).html("");
                
               }
                    
              }
              else
              {
                $( '#phone_status' ).html("Enter Phone Number");
                return false;
              }

              var dob = document.forms["registerForm"]["dob"].value;

              if (dob == '')
              {
                $( '#dob_status' ).html("Enter DOB");   
                    return false;    
               }
               else
               {   
                $( '#dob_status' ).html("");
                
               }


               var lic_no = document.forms["registerForm"]["lic_no"].value;
              // var lic_no=document.getElementById( "lic_no" ).value;
                 
              if(lic_no!='')
              {
               var regex =/^\d{8}$/;
                if (!lic_no.match(regex))
                {
                     $( '#lic_no_status' ).html("License number must have 8 digits");   
                     return false;    
                }
                else
                {   
                 $( '#lic_no_status' ).html("");
                 
                }
                
              }
              else
                 {
                   $( '#lic_no_status' ).html("Enter Licence Number");
                   return false;
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
                                <li><a href="login.php">Login</a></li>
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
                        <h2>Register Admin User</h2>
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
    <section id="lgoin-page-wrap" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-8 m-auto">
            <div class="login-page-content">
              <div class="login-form">
                <h3>Register Admin User</h3>
                <form  method="post" name="registerForm" onsubmit="return checkall()">
                  <div class="name">
                      <input type="text" placeholder="Name" name="name"  id="name" value="">
                      <span id="name_status"></span>
                  </div>
                  <div class="username">
                      <input type="email"  placeholder="Email" name="email" id="email"  value="" >
                      <span id="email_status"></span>
                  </div>
                  <div class="password">
                      <input type="password" placeholder="Password" name="password" id="password"  value="">
                      <span id="password_status"></span>
                  </div>
                  <div class="phone">
                      <input type="text" placeholder="Phone No." name="phone" id="phone"  value="">
                      <span id="phone_status"></span>
                  </div>
                  <div class="DOB">
                    <input placeholder="DOB" class="textbox-n" type='date' max='<?php $time=strtotime("-18 year", time()); echo date("Y-m-d", $time);?>' id="dob" name="dob" value=''>
                    <span id="dob_status"></span>
                  </div>
                   <div class="Lno">
                      <input type="text" placeholder="License No." name="lic_no" id="lic_no"  value="">
                      <span id="lic_no_status"></span>
                  </div>
                  <div class="log-btn">
                      <button type="submit" name="register_admin_btn" id="register_admin_btn"><i class="fa fa-check-square"></i> Sign Up</button>
                  </div>
              </form>
              </div>
              <div class="create-ac">
                <p>Have an account?</p>
                <p><a href="login.php">Sign In</a></p>
              </div>
           </div>
          </div>
        </div>>
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

    <!--== Scroll Top Area Start ==-->


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