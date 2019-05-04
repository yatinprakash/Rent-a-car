<?php
	session_start();
	$name = $phone = $dob = $password = $email = $lic_no = "";
	$con = mysqli_connect('localhost','root','root','car rental');

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

	if(isset($_POST['email']))
	{
		$emailId=$_POST['email'];

		$sql=" SELECT * FROM user WHERE email='$emailId' ";

		$result = mysqli_query($con,$sql);
		$num_rows = mysqli_num_rows($result);

		if($num_rows == 1)
		{
			echo "Email Already Exist";
			
		}
		else
		{
			echo "";
			
		}
		exit();
	}
	}
?>