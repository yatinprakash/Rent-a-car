<?php
session_start();

$password = $email = "";
$con = mysqli_connect('localhost','root','','car rental');

if($_SERVER["REQUEST_METHOD"]=="POST")
{

    if(empty($_POST["email"]) || empty($_POST["password"]))
    {

      header("Location: login.html");
    }
    else 
    {
       
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) ) // if email is not valid
         {
           
           header("Location: login.html");

         }
         else{ //if email is valid ..db validation
            

            if (!$con)
           {
              die('Could not connect: ' . mysqli_error($con));
              echo "DB Connection Fail";
           }
          else{

            $result ="";
            
             $sql="SELECT name,email,password from user
                    where email= '". $email ."'";
                    
              $result = mysqli_query($con,$sql);

              $row = mysqli_fetch_array($result);
              if (! empty($row))
              {
                 //email exist
                if($row["password"] == $password)
                {
                  //valid password & redirect to 
                  $_SESSION['sess_name'] = $row["name"];
                   $_SESSION['sess_email'] = $email;
                   session_write_close();
                  header("Location: index.html");

                }
                else{//email exist bt password is wrong
                  echo "Invalid Password";
                  header("Location: login.html");                
                }
              }            
              
              else{
                //email does not exist

                header("Location: register.html");

              }

                   }
                   

          }
        }
      }
?>