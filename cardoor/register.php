<?php
session_start();

$name = $phone = $dob = $password = $email = $lic_no = "";
$con = mysqli_connect('localhost','root','','car rental');

if($_SERVER["REQUEST_METHOD"]=="POST")
{

    if(empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["name"]) || empty($_POST["phone"]) || empty($_POST["dob"]) || empty($_POST["lic_no"]))
    {

      header("Location: register.html");
    }
    else 
    {
       
        $email = $_POST["email"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $dob = $_POST["dob"];
        $lic_no = $_POST["lic_no"];
        
        
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) || !preg_match('/^(?=.\d)(?=.[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password) || !preg_match('/^[0-9]{10}$/', $phone) || !preg_match('/^[0-9]{8}$/', $lic_no)) // if email is not valid
         {
           
           header("Location: register.html");

         }
         else{ //if email is valid ..db validation
            

            if (!$con)
           {
              die('Could not connect: ' . mysqli_error($con));
              echo "DB Connection Fail";
           }
          else{

            $result ="";
            
             $sql="INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `phone`, `dob`, `lic_no`) VALUES (NULL, '".$name."', '". $email ."','". $password ."', '". $phone ."', '". $dob ."', '". $lic_no ."')";
                    
              if( mysqli_query($con,$sql)){
                session_regenerate_id();
               $_SESSION['sess_name'] = $name;
                $_SESSION['sess_email'] = $email; 
                session_write_close();
                header("Location: index.html");
              }
              else{
                echo "Failed";
                 header("Location: test1.html");
              }
            }
}
}
}
             
                
?>